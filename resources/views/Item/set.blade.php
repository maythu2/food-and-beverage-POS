@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
<style type="text/css">
	li{
		 list-style:none;
	}
	.inner{
		padding-top: 30px;
	}
</style>
<div class="setlist">
	
</div>
<div class="inner"> 
		<div>
			<label>Item Set Name:</label>
			<input type="text" value="" class="set_name">
		</div> 
	    <div class="checkitem">
			<h5>Choose Items</h5>
	    </div>
	    <div>
			<label>Price</label>
			<input type="text" value="0" class="set_price">
	    </div>
	    <button class="btn btn-success save"> Save</button> 
</div>
<script type="text/javascript">
	var sum=0;
	var index = [];
	$('document').ready(function(){
		alert("maythu");
		$.ajax({
			type:'get',
			url:'/api/set',
			datatype:'json',
			success:function(result){
				console.log(typeof(result));
				result.map(function(e){
					var check ="<input type='checkbox' name='"+e.name+"' price='"+e.price+"' id='checkbox1' value='"+ e.id +"'>"+e.name+"<br>";
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
		alert("save");
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
					console.log(result);
					alert('Successfully Save Set');
					$(".inner").hide();
                	$(".setlist").html(result);
			}
		})
	})
	
</script>
@stop