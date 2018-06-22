@extends('layouts.master')

@section('title', 'Page Title')

@section('content')

<style type="text/css">
    .select2-container{
        width: 260px !important;
    }
    .invoice{
	    width: 400px !important;
    }
    .container {
    	width: 400px !important;
	}
	h5{
	    margin-top: 10px !important;
	    margin-bottom: 2px !important;
	    text-align: center;
	}
	p {
    	margin: 0 0 2px !important;
    	text-align: center;
	}
	.table {
	    width: 100%;
	    max-width: 100%;
	    margin-bottom: 12px;
	    font-size: 1em;
	}
	.table .thead{
		border-top-style: dotted;
		border-bottom-style: dotted;
	}
	.table .tfoot{
		border-top-style: dotted;
	}
	.table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
	    padding: 8px !important;
	    line-height: 1.42857143 !important;
	    vertical-align: top !important;
	    border: none !important;
	}
	label {
	    display: inline-block;
	    max-width: 100%;
	    margin-bottom: 5px;
	    font-weight: 1 !important;
	}
	.table>tbody+tbody {
    	border-top: none !important;
	}
</style>
<div class="col-md-12 invoice">
    <h5>LIBRASUN SNACKS</h5>
    <p>Mid Valley City,</p> 
    <p>Lingkaran Syed Putra,</p>
    <p>59200 Kuala Lumpur</p>
    
    <div>
    	<label>Receipt No {{$invoice_id}}</label>
    	<p style="text-align: left;float: right;">Temp- Temp_01</p>
    </div>
    <div>	
    	<label>Shift No.1</label>
    	<p style="text-align: left;float: right;">{{date("d/m/Y")}}</p>
    </div>
    <div>
    	<label>Cashier:SUPPORT</label>
    	<p style="text-align: left;float: right;"> {{date("d/m/Y")}} {{date("h:i:s")}}</p>
    </div>
    <div>DINE-IN</div>
    <div>
    	<div align="center">
        	<table class="table table-hover">
        		<thead class="thead">
        			<tr>
        				<td>QTY</td> 
        				<td>ITEM</td> 
        				<td>AMOUNT</td> 
        			</tr>
        		</thead>
        		@foreach($items['item'] as $item)
        		<tbody>
        		 	<tr>
    		 			<td>{{$item['qty']}}</td>
        		 		<td>{{$item['item_name']}}</td> 
        		 		<td>{{$item['item_price']}}</td> 
        		 	</tr>
        		</tbody> 
    			@endforeach
        		<tfoot class="tfoot">
        		  	<tr>
        		  		<td colspan="1"></td> 
        		  		<td>Subtotal</td> 
        		  		<td>{{$items['subtotal']}}</td>
        		  	</tr> 
        		  	<tr>
        		  		<td colspan="1"></td> 
        		  		<td>Discount %</td> 
        		  		<td>{{$items['discount']}}</td>
        		  	</tr> 
        		  	<tr>
        		  		<td colspan="1"></td> 
        		  		<td>Grand Total</td> 
        		  		<td>{{$items['grandtotal']}}</td>
        		  	</tr> 
        		  	<tr>
        		  		<td colspan="1"></td> 
        		  		<td>CASH</td> 
        		  		<td>{{$items['cash']}}</td>
        		  	</tr>
    		  </tfoot>
    		</table>
    	</div>
	</div>

@stop
