@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<style type="text/css">
	.modal-body {
        height: 125px;
        margin-left: 20px;
        margin-right: 46px;
    }
    .pagination {
      display: inline-block;
    }
    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ddd;
    }
    .pagination a.active {
        background-color: #4CAF50;
        color: white;
        border: 1px solid #4CAF50;
    }
    .pagination a:hover:not(.active) {background-color: #ddd;}
</style>
   <h1 align="center">Create Item</h1>
   <button class="btn btn-success" data-toggle="modal" data-target="#myModal" id="create_item">Create Item
   </button>
   <br><br>
   <!-- modal box -->
   <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">    
         <!-- Modal content-->
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal">&times;</button>
               <h4 class="modal-title">Create Item</h4>
            </div>
            <input type="hidden" id="item_id">
            <div class="modal-body">
                <div id="row">
                   <div class="col-md-6">
                       <label>Name</label>
                   </div>
                   <div class="col-md-6">
                       <input type="text" id="name" class="form-control">
                   </div>
                </div>
                <div id="row">
                   <div class="col-md-6" style="margin-top: 15px;">
                       <label>Price</label>
                   </div>
                   <div class="col-md-6" style="margin-top: 15px;">
                      <input type="number" id="price" class="form-control">
                   </div>
                </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-success" data-dismiss="modal" id="add_item">Add</button>
            </div>
         </div>      
      </div>
   </div>
   <!-- ************ -->
   	<table class="table table-hover">
   	<tr>
	  <th>Name</th>
      <th>Prices</th>
      <th colspan="2">Action</th>
   	</tr>
   	<tbody id="show_output">
    </tbody>
   </table>
   <script src="{{ asset('js/app/item.js') }}"></script>
@stop
