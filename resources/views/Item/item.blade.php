@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<style type="text/css">
</style>
    <h1 align="center">Item List</h1>
    <button type="button" class="btn btn-primary" id="create_item" data-toggle="modal" data-target="#exampleModal">
    Create Item
    </button>
    <br><br>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Item</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <input type="hidden" id="item_id">
        <div class="modal-body">
            <div id="row">
               <div class="col-md-6">
                   <label>Name</label>
               </div>
               <div class="col-md-12">
                   <input type="text" id="name" class="form-control">
               </div>
               <br>
               <div id="validation-errors-name" class="col-md-12">
                   
               </div>
            </div>
            <div id="row">
               <div class="col-md-6" style="margin-top: 15px;">
                   <label>Price</label>
               </div>
               <div class="col-md-12" style="margin-top: 15px;">
                  <input type="number" id="price" class="form-control">
               </div>
               <br>
               <div id="validation-errors-price" class="col-md-12">
                   
               </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary save" id="add_item">Save</button>
        </div>
        </div>
      </div>
    </div>
    <!-- /*********/ -->
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
