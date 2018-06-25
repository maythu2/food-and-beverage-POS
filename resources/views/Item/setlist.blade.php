@extends('layouts.master')

@section('title', 'Page Title')

@section('content')

<style type="text/css">
    .set{
        margin-top: 20px;
    }
    .container {
        width: 100% !important;
    }
    .modal-body {
        height: 456px;
        margin-left: 20px;
        margin-right: 46px;
    }
    .modal-dialog {
        width: 70%;
        margin: 30px auto;
    }
    .table {
        width: 100%;
        max-width: 100%;
        font-size: 1em;
        margin-bottom: 20px;
    }
    table{
        width: 100%;
    }
    #create_set{
        margin-left: 965px;
    }
    .checkitem{
        margin-right: 508;
    }
    h5{
        margin-right: 511px;
    }
    .checkbox_design{
        margin-left: 10px;
    }
</style>
<div class="col-md-12 set">
    <div>
        <div align="center" class="modal-dialog">
            <h4 class="modal-title">Set Menu</h4>
            <button class="btn btn-success" data-toggle="modal" data-target="#set" id="create_set" >Create Set
            </button>
            <br><br>
           <!-- modal box -->
           <div class="modal fade" id="set" role="dialog">
              <div class="modal-dialog">    
                 <!-- Modal content-->
                 <div class="modal-content">
                    <div class="modal-header">
                       <button type="button" class="close" data-dismiss="modal">&times;</button>
                       <h4 class="modal-title">Create Set</h4>
                    </div>
                    <input type="hidden" id="item_id">
                    <div class="modal-body">
                        <div class="setlist">
    
                        </div>
                        <div id="row">
                           <div class="col-md-6">
                               <label>Item Set Name:</label>
                           </div>
                           <div class="col-md-6">
                               <input type="text" id="name" class="form-control set_name">
                           </div>
                        </div>
                            <h5><label>Choose Items</label></h5>
                            <div class="checkitem">
                            </div>
                        <div id="row">
                           <div class="col-md-6" style="margin-top: 15px;">
                               <label>Price:</label>
                           </div>
                           <div class="col-md-6" style="margin-top: 15px;">
                              <input type="text" id="price" value="0" class="form-control set_price">
                           </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                       <button type="button" class="btn btn-success save" data-dismiss="modal" id="save">Save</button>
                    </div>
                 </div>      
              </div>
           </div>
           <!-- ************ -->
            <table class="table table-hover">
                <thead class="thead">
                    <tr>
                        <td>Set Menu Name</td> 
                        <td>Action</td> 
                    </tr>
                </thead>
                <tbody id="set_name">
                </tbody>
            </table>
        </div>
        <div class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">    
                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Set Menu</h4>
                    </div>
                    <input type="hidden" id="item_id">
                    <div class="modal-body">
                    <table class="main_table">
                        <thead>
                            <tr>
                                <th>Menu Name</th>
                                <th>Price</th>
                            </tr>
                        </thead>
                        <tbody class="set_menu">
                            
                        </tbody>
                    </table>
                    </div>
                </div>      
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $.ajax({
            type:'get',
            url:Config.apiurl+'set',
            datatype:'json',
            success:function(result){
                console.log(result);
                result.map(function(e){
                    var data = "<tr class='set'>"+"<td class='set_names'>"+e.name+"</td>"+"<td><button class='btn btn-success' data-toggle='modal' data-target='#myModal' setid='"+e.id+"' id='set_item'>+</button></td>"+"</tr>";
                    $("#set_name").append(data);
                })
            }
        })
    })
   $("#set_name").delegate('#set_item','click',function(){
        var set_id=$(this).attr("setid");
        $.ajax({
            type:'get',
            url:Config.apiurl+'set/show',
            datatype:'json',
            data:{
                id:set_id,
            },
            success:function(result){
                console.log(result);
                $('.set_menu').empty();
               result.map(function(e){
                var menu = "<tr class='set'>"+"<td class='set_name'>"+e.name+"</td>"+"<td class='set_price'>"+e.price+"</td>"+"</tr>";
                   $('.set_menu').append(menu);
                })
            }
        })
    })
    //add set Menu
    var sum=0;
    var index = [];
    $('#create_set').click(function(){
        $.ajax({
            type:'get',
            url:Config.apiurl+'setmenu',
            datatype:'json',
            success:function(result){
                $(".checkitem").empty();
                result.map(function(e){
                    var check ="<input type='checkbox' name='"+e.name+"' price='"+e.price+"' id='checkbox1' value='"+ e.id +"'><p>"+e.name+"</p>";
                    $(".checkitem").append(check);
                })
            }
        })
    })
    $('.checkitem').delegate('input:checkbox', 'change', function(){ 
        var price = $(this).attr('price');
        var id = parseInt($(this).val());
        var name = $(this).attr('name');
        if($(this).is(":checked") ) {
            sum += parseInt(price);
            index.push(id+':'+name);
        }else{
            sum = parseInt(sum)- parseInt(price);
            var uncheck_id = index.indexOf(id+':'+name);
            index.splice(uncheck_id , 1);
        }
        $(".set_price").val(sum);
    });
    $('.save').click(function(){
        var set_name = $('.set_name').val();
        var set_price = $('.set_price').val();
        console.log(index);
        $.ajax({
            type:'post',
            url:Config.apiurl+'set',
            datatype:'json',
            data:{
                check_id:index,
                name:set_name,
                price:set_price,
            },
            success:function(result){
                location.reload();
                alert('Successfully Save Set');
            },
            error:function(result){
                alert('Please Insert Require Data!');
            }

        })
    }) 
</script>
@stop