$(function(){
	//Buttons
	//Button New - DONE
	$('.btn-products-add').on("click", function(){
		$.get("/pages/products/new.php", function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

	//Button Edit - DONE
	$(document).on("click", ".btn-products-edit",function(event){
		$.get("/pages/products/edit.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
    });

    //Button Show 
	$(document).on("click", ".btn-products-show",function(event){
		$.get("/pages/products/show.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Store
	$(document).on("click", ".btn-products-store",function(){
		$(document).find('#categories_selected').prop('multiple', true);
		$(document).find('#categories_selected option').prop('selected', true);
		let formData = $("#FormModal").serialize();
		$.post({
			url: "/pages/products/index.php",
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
	});

    //Button Update
	$(document).on("click", ".btn-products-update",function(event){
		$(document).find('#categories_selected').prop('multiple', true);
		$(document).find('#categories_selected option').prop('selected', true);
        let id = $(event.target).data("id")		
		let formData = $("#FormModal").serialize();
		$.post({
			url: "/pages/products/index.php",
			data:{
				_id:id,
				_data:formData,
				_method: 'PUT'
			},
			dataType: 'json'
		}).done(function($data){

		}).fail(function($data){
			
		}).always(function($data){
			location.reload();
		})
	});

	//Button Delete
	$(document).on("click", ".btn-products-delete",function(event){
		swal({
			title: "Delete",
			text: "Do you want to delete this category ?",
			icon: "warning",
			buttons: ["Cancel", "Delete"],
			dangerMode: true
		}).then((willDelete) => {if(willDelete){
				let id = $(event.target).parent().data("id")
				$.post({
					url: "/pages/products/index.php",
					data:{
						_id:id,
						_method: 'DELETE'
					}
				}).done(function($data){
					
				}).fail(function($data){

				}).always(function($data){
					location.reload();
				})
			}
		});
	});

	//Category list switch
	$(document).on("click","#categories_available option", function(event){
		$(document).find("#categories_available").remove(event.target)
		$(document).find("#categories_selected").append(event.target)
		alphabetizeList('#categories_available')
		alphabetizeList('#categories_selected')

	})
	$(document).on("click","#categories_selected option", function(event){
		$(document).find("#categories_selected").remove(event.target)
		$(document).find("#categories_available").append(event.target)
		alphabetizeList('#categories_available')
		alphabetizeList('#categories_selected')
	})
	function alphabetizeList(list) {
		let selection = $(document).find(list)
		let values = selection.val();
		let opts_list = selection.find('option')
		opts_list.sort(function(a, b){
		   return $(a).text() > $(b).text() ? 1 : -1;
		})
		selection.html('').append(opts_list)
		selection.val(values)
	 }
});