@extends('layouts.master')

@section('title', 'Page Title')
@section('content')
<h1 align="center">Set Menu</h1>
<button type="button" class="btn btn-primary" id="create_set" data-toggle="modal" data-target="#exampleModal">
Create Set
</button>
<br><br>
<!-- Modal -->
<div class="modal fade set" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Create Set</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <input type="hidden" id="item_id">
            <div class="modal-body">
                <div class="container">
                    <div id="row" class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Item Set Name:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="name" class="form-control set_name">
                        </div>
                        <br>
                        <br>
                        <div id="validation-errors-name" class="col-md-12">
                   
                        </div>
                    </div>
                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-4" >
                            <label class="col-form-label">Choose Menus:</label>
                        </div>
                        <div class="col-md-8 checkitem">
                
                        </div>
                    </div>
                    <div id="row" class="row">
                        <div class="col-md-4">
                            <label class="col-form-label">Price:</label>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="price" value="0" class="form-control set_price">
                        </div>
                        <br>
                        <br>
                        <div id="validation-errors-price" class="col-md-12">
                   
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary save" id="save">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- /*********/ -->
<table class="table table-hover" id="set_table">
    <thead class="thead">
        <tr>
          <th scope="col">#</th>
          <th scope="col">Name</th>
          <th scope="col">Price</th>
          <th scope="col">Action</th>
        </tr>
    </thead>
    @foreach($setitem as $set_menu)
    <tbody>
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$set_menu->name}}</td>
            <td>{{$set_menu->price}}</td>
            <td style="width:300px;">  
                <button class="btn btn-primary set_item_button" setid="{{$set_menu->id}}" id='set_item' type="button" data-toggle="collapse" data-target="#collapseExample{{ $loop->iteration }}" aria-expanded="false" aria-controls="collapseExample">
                    Detail
                </button>
                <div class="collapse card" id="collapseExample{{ $loop->iteration }}" style="margin-top: 10px;">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <label>name</label>
                            </div>
                            <div class="col-md-4">
                                <label>price</label>
                            </div>
                        </div>
                        <div class="row ">
                        <table class="table">
                            <tbody class="set_menu">
                           
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div> 
            </td>
        </tr>
    </tbody>
    @endforeach
</table>
<script type="text/javascript">
   $("#set_table").delegate('.set_item_button','click',function(){
        var _this = $(this);
        $tr = _this.closest('tr');
        $set_menu = $tr.find('.set_menu');        
        var set_id= _this.attr("setid");        
        $.ajax({
            type:'get',
            url:'/api/set/show',
            datatype:'json',
            data:{
                id:set_id,
            },
            success:function(result){
                console.log(result);
                //$('.set_menu').empty();
                var menu = "";
                result.map(function(e){
                    menu = menu + "<tr class='set'>"+"<td class='set_name'>"+e.name+"</td>"+"<td class='set_price'>"+e.price+"</td>"+"</tr>";
                    
                })
                $set_menu.html(menu);
            }
        })
    })
    //add set Menu
    var sum=0;
    var index = [];
    $('#create_set').click(function(){
        $.ajax({
            type:'get',
            url:'/api/setmenu',
            datatype:'json',
            success:function(result){
                $(".checkitem").empty();
                result.map(function(e){
                    var check ="<div class='form-group form-check'><input type='checkbox' name='"+e.name+"' price='"+e.price+"' id='checkbox1' class='form-check-input' value='"+ e.id +"'><label class='form-check-label' for='checkbox'>"+e.name+"</label></div>";
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
            url:'/api/set',
            datatype:'json',
            data:{
                check_id:index,
                name:set_name,
                price:set_price,
            },
            success:function(result){
                alert('successfully save');
                $('#exampleModal').modal('toggle');
                location.reload();
            },
            error:function(result){
                $('#validation-errors-name').html('');
                $('#validation-errors-price').html('');
                $('#validation-errors-name').append('<div class="alert alert-danger">'+result.responseJSON.errors.name+'</div');
                if (result.responseJSON.errors.price==undefined) {
                $('#validation-errors-price').append('<div class="alert alert-danger">'+'please select menu'+'</div');
                }
            
            }

        })
    })
</script>
@stop