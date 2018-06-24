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
	    display: inline-block !important;
	    max-width: 100% !important;
	    margin-bottom: 5px !important;
	    font-weight: 1px solid !important;
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
                @foreach($set_all_data as $menu)
                
                    @if($menu["set_item"] == '0')
                        <tbody>
                            <tr>
                                <td>{{$menu["item"]["qty"]}}</td>
                                <td>{{$menu["item"]["item_name"]}}</td> 
                                <td>{{$menu["item"]["item_price"]}}</td> 
                            </tr>
                        </tbody>
                    @else
                        <tbody>
                            <tr>
                                <td>{{$menu["item"]["qty"]}}</td>
                                <td>{{$menu["item"]["item_name"]}}</td> 
                                <td>{{$menu["item"]["item_price"]}}</td> 
                            </tr>
                        </tbody>
                        @foreach($menu['set_item'] as $set_menu)
                        <tbody>
                            <tr>
                                <td></td>
                                <td style="padding-left: 25px !important;padding-top: 0px !important;color: #919FB1;">{{$set_menu->name}}</td> 
                                <td style="padding-left: 25px !important;padding-top: 0px !important;color: #919FB1;">{{$set_menu->price}}</td> 
                            </tr>
                        </tbody>
                        @endforeach
                    @endif
                @endforeach
        		@foreach($charges as $prices)
                    <tfoot class="tfoot">
                    <tr>
                        <td colspan="1"></td> 
                        <td>Subtotal</td> 
                        <td>{{$prices['subtotal']}}</td>
                    </tr> 
                    <tr>
                        <td colspan="1"></td> 
                        <td>Discount %</td> 
                        <td>{{$prices['discount']}}</td>
                    </tr> 
                    <tr>
                        <td colspan="1"></td> 
                        <td>Grand Total</td> 
                        <td>{{$prices['grandtotal']}}</td>
                    </tr> 
                    <tr>
                        <td colspan="1"></td> 
                        <td>CASH</td> 
                        <td>{{$prices['cash']}}</td>
                    </tr>
                    </tfoot>           
                @endforeach
    		</table>
    	</div>
	</div>
<script type="text/javascript">
    $('document').ready(function(){
        
    })
</script>
@stop
