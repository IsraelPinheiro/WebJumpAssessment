$(function(){
	//Buttons
	//Button New
	$('.btn-categories-add').on("click", function(){
		$.get("/pages/categories/new.php", function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

	//Button Edit
	$(document).on("click", ".btn-categories-edit",function(event){
		$.get("/pages/categories/edit.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
    });

    //Button Show
	$(document).on("click", ".btn-categories-show",function(event){
		$.get("/pages/categories/show.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Store
	$(document).on("click", ".btn-categories-store",function(){
		if($("#FormModal").valid()){
			let formData = $("#FormModal").serialize();
			$.post({
				url: "/pages/categories/index.php",
				data:{
					_data:formData,
					_method: 'POST'
				},
				dataType: 'json'
			}).done(function(data){

			}).fail(function(data){
				
			}).always(function(data){
				location.reload();
			})
		}
	});

    //Button Update
	$(document).on("click", ".btn-categories-update",function(event){
		if($("#FormModal").valid()){
			let id = $(event.target).data("id")		
			let formData = $("#FormModal").serialize();
			$.post({
				url: "/pages/categories/index.php",
				data:{
					_id:id,
					_data:formData,
					_method: 'PUT'
				},
				dataType: 'json'
			}).done(function(data){

			}).fail(function(data){
				
			}).always(function(data){
				location.reload();
			})
		}
	});

	//Button Delete
	$(document).on("click", ".btn-categories-delete",function(event){
		swal({
			title: "Delete",
			text: "Do you want to delete this category ?",
			icon: "warning",
			buttons: ["Cancel", "Delete"],
			dangerMode: true
		}).then((willDelete) => {if(willDelete){
				let id = $(event.target).parent().data("id")
				$.post({
					url: "/pages/categories/index.php",
					data:{
						_id:id,
						_method: 'DELETE'
					}
				}).done(function(data){
					
				}).fail(function(data){

				}).always(function(data){
					location.reload();
				})
			}
		});
	});
});