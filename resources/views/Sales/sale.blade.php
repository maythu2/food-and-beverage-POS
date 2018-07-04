@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<style type="text/css">
    .select2-container{
        width: 260px !important;
    }
    h2{
        text-align: center;
        margin-bottom: 50px;
    }
    .select2-container--default .select2-selection--single {
        background-color: #fff;
        border: 1px solid #aaa;
        border-radius: 4px;
        height: 36px !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 26px;
        position: absolute;
        top: 5px !important;
        right: 1px;
        width: 20px;
    }
</style>
    <div class="col-sm" id="invoice">
    </div>
    <div class="col-sm" id="sale">
        <h2>Food and Beverage Point of Sales Systems</h2>
        <div class="container">
            <div class="row">
                <div class="col-4">
                    <div class="row">
                        Invoice Name: 
                        <div class="col-8">
                        <input type="text" value="" class="form-control" id="invoice_name">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <select class="js-example-basic-single item" name="state">
                        <option value=""></option>
                    </select>
                </div>
                <div class="col">
                    <form action="{{url('api/item/create')}}" method="get">
                        <button class="btn btn-success" >Create Item
                        </button>
                    </form>
                </div>
                <div class="col">
                    <form action="{{url('api/set')}}" method="get">
                        <button class="btn btn-success" >Create Item Set
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <div id="row" style="padding-top: 30px;">
            <table class="table table-bordered main_table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Item Name</th>
                        <th>Qty</th>
                        <th>Price</th>
                        <th>Total</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="t_body">
                    <input type="hidden" name="_token"  id="ctr_token" value="<?php echo csrf_token() ?>">
                </tbody>
                <tfoot class="t_foot">
                    <tr>
                        <td colspan="4" style="text-align: right;"> Sub Total</td>
                        <td><input type="text" value="0" class="form-control item_subtotal"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">Discount %</td>
                        <td><input type="text" value="0" class="form-control item_discount"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">Grand Total</td>
                        <td><input type="text" value="0" class="form-control item_grandtotal" disabled="true"></td>
                    </tr>
                    <tr>
                        <td colspan="4" style="text-align: right;">Cash</td>
                        <td><input type="text" value="0" class="form-control item_cash" disabled="true"></td>
                    </tr>
                </tfoot>
            </table>
            <button class="btn btn-success save" style="margin-left: 80%;"> Save</button> 
        </div>
    </div>
<script type="text/javascript">
    var j=1;
    var index=[];
    $('document').ready(function(){
        $('.save').prop('disabled', true);
    })
    $('body').delegate('.item_qty','keyup',function(){
            var x=$(this).parent().parent();
            var textValue1 = x.find('.item_qty').val();
            var textValue2 =x.find('.item_price').val();
            calc =textValue1*textValue2;
            x.find('.item_total').val(calc);
            subtotal();
            discount();
        });
    function subtotal(){
            var sum = 0;
            $('.item_total').each(function(){
            sum += +$(this).val();                           
            });                       
            $('.item_subtotal').val(sum);      
    }
    // for delete item row
    $('#t_body').delegate('.delete_row','click',function(){
        var del_row=$(this).closest('tr');
        del_row.remove();
        var del_id = del_row.find('td .item_name').attr('item_id');
        var del_index = index.indexOf(parseInt(del_id));
        index.splice(del_index,1);
        if (index.length==0){
            $('.save').prop('disabled',true);
        }
        refresh_Table();
    }); 
    // // for item discount
    $('.t_foot').delegate('.item_discount','keyup',function(){
       discount();
    });
    function discount(){
        var discount= $('.item_discount').val();
        var sub_total=$('.item_subtotal').val();
        var grandtotal=sub_total *(1-(discount/100));
        $('.item_grandtotal').val(grandtotal);
        $('.item_cash').val(grandtotal);
    }
    // for product with select2-container
    $('.item').select2({
         ajax: {
            type: 'get',
            url: "/api/item_autocomplete",
            dataType : 'json',
            processResults: function (data) {
                // console.log(data);
                var arr = [];
                data.map(function(e){
                    var obj = {
                        'id':e.id,
                        'text':e.name
                    }
                    arr.push(obj); 
                })
                return {
                   results: arr
                };
           }
         }
    });
    // for retrieve item
    $('.item').change(function(){
        var id=$(this).val();
        $.ajax({
            type:'get',
            url:'/api/item/'+id,
            dataType:'json',
            success:function(results){
                var name = results.name;
                var price = results.price;
                var tr ="<tr class='tr_clone'>"
                        +
                        "<td class='item_id' indexof= '"+j+"'>"+j+"</td>"+
                        "<td><input type='text' class='form-control item_name' item_id='"+ results.id+"'value='"+ name +"'></td>"+
                        "<td><input type='text' class='form-control item_qty'></td>"+
                        "<input type='hidden' class='form-control itemset' value='"+results.is_itemset+"'>"+
                        "<td><input type='text' class='form-control item_price' disabled=true value='"+ price +"'></td>"+
                        "<td><input type='text' class='form-control item_total' disabled=true></td>"+
                        "<td><button class='btn btn-danger delete_row'>Remove</button></td>"
                        +
                        "</tr>";
                if (index.length>0) {
                    console.log(index);
                    if (index.indexOf(results.id) == -1) {
                        $('#t_body').append(tr);
                        index.push(results.id);
                        j++;
                        refresh_Table(); 
                    }else{
                        alert('item already selected');
                    }
                }else{  
                    console.log(index);
                    $('#t_body').append(tr);
                    index.push(results.id);
                    j++;
                    refresh_Table();  
                }
                
            }
        })
        $('.save').prop('disabled', false);
    });
    function refresh_Table(){
        var i=1;
        $('.main_table >tbody>tr').each(function(){
            // var item_id=$(this).find('.item_id').text();
            var item_name=$(this).find('.item_name').val();
            var item_qty=$(this).find('.item_qty').val();
            var item_price=$(this).find('.item_price').val();
            var item_total=$(this).find('.item_total').val();
            $(this).find('.item_id').html(i);
            $(this).find('.item_name').val(item_name);
            $(this).find('.item_qty').val(item_qty);
            $(this).find('.item_price').val(item_price);
            $(this).find('.item_total').val(item_total);
            i++;
        });
    }   
    $('.save').click(function(){
        items = [];
        $('.tr_clone').each(function(){
            arr={
                item_id: $(this).find('.item_name').attr('item_id'),
                qty: $(this).find('.item_qty').val(),
                item_name: $(this).find('.item_name').val(),
                item_price: $(this).find('.item_price').val(),
                is_itemset: $(this).find('.itemset').val(),
            };
            items.push(arr);
        });
        var invoice_name=$('#invoice_name').val();
        if (invoice_name==''){
            alert("Please Insert Invoice name");
            return false;
        }
        var subtotal =$('.item_subtotal').val();
        var grandtotal =$('.item_grandtotal').val();
        var discount = $('.item_discount').val();
        var cash = $('.item_cash').val();
        $.ajax({
            url : "/api/stockout",
            type : "POST",
            data : {
                    invoice_name:invoice_name,
                    item : items,
                    grandtotal:grandtotal,
                    discount:discount,
                    subtotal:subtotal,
                    cash:cash,
                    _token : $('#ctr_token').val() 
                    },
            dataType: "html",
            success:function(result){
                alert('Successfully save Invoice');
                $("#sale").hide();
                $("#invoice").html(result);
            },
            error: function(result){
               console.log(result);
            }

        });
    });
</script>
@stop
