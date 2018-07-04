var Item = function(){
    init = function(){ 
	 	$("#add_item").click(function(){
	 		saveItem();
	 	}); 
	 	getItem(); 
        $("#show_output").delegate('#edit_btn','click',function(){
           Edit(this);
        });
        $("#show_output").delegate('#delete_btn','click',function(){
            Delete(this);
        })
        $("#create_item").click(function(){
            cleardata();
        })
    },
    saveItem= function(){
	    var name=$("#name").val(); 		
 		 var price=$("#price").val();
        console.log(price);
        var id=$('#item_id').val();
        if(id==''){
     		$.ajax({
     			type : 'post',
     			url : "/api/item",
     			dataType : 'json',
     			data : {
     				name : name,
     				price : price,
     			},
     			success:function(data){
    	 			if(data==1){
    	 				alert("Successfully Saved!");
                        $('#exampleModal').modal('toggle');
                        getItem();
    	 			}			
     			},
                error:function(result){
                    $('#validation-errors-name').html('');
                    $('#validation-errors-price').html('');
                    $('#validation-errors-name').append('<div class="alert alert-danger">'+result.responseJSON.errors.name+'</div');
                    $('#validation-errors-price').append('<div class="alert alert-danger">'+result.responseJSON.errors.price+'</div');
                }
      		});
        }else{
            $.ajax({
               type : 'put',
               url : "/api/item/"+id,
               dataType : 'json',
               data :{
                   id : id,
                   name : name,
                   price : price
               },
               success : function(data){
                   if(data==1){
                       alert("Successfully updated!");
                       getItem();
                   }
                   else{
                       alert("Please Try Again!");
                   }      
               }
            });
        }
    }
    getItem=function(){
    	$.ajax({
    		type: 'get',
    		url : "/api/item",
    		dataType : 'json',
    		success : function(result){
                $("#show_output").html('');
	           result.forEach(function(e){
                $("#show_output").append("<tr><td>"+e['name']+"</td><td>"+e['price']+"</td><td><button class='btn btn-primary' id='edit_btn' edit_id='"+e['id']+"'>Edit</button></td><td><button class='btn btn-danger' id='delete_btn' delete_id='"+e['id']+"'>DELETE</button></td></tr>");
                });	  
    		}
    	});
    }
    Edit=function(obj){
    id=$(obj).attr("edit_id");
    $.ajax({
            type: 'get',
            url : "/api/item/"+id+"/edit",
            dataType : 'json',
            success : function(result){
            console.log(result);
            $("#myModal").modal('show');
            $("#item_id").val(result.id);
            $("#name").val(result.name);
            $("#price").val(result.price);
           }
       });
    }
    Delete=function(obj){
    var del_confirm =  confirm("Are you sure you want to delete?");
    if (del_confirm == false){
        return false;
    }
    id=$(obj).attr("delete_id");
    $.ajax({
           type: 'delete',
           url : "/api/item/"+id,
           dataType : 'json',
           success : function(result){
               alert("Successfully Deleted!");
               getItem();             
           }
       });
    }
    cleardata=function(){
        $("#name").val('');
        $("#price").val('');
        $('#validation-errors-name').html('');
        $('#validation-errors-price').html('');
    }
    return{
        init : init,
    }
}();

$(document).ready(function(){
    Item.init();
    $('.js-example-basic-single').select2();
});