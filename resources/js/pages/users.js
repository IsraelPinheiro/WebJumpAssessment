$(function(){
	//Buttons
	//Button New
	$('.btn-users-add').on("click", function(){
		$.get("/pages/users/new.php", function(data){
			$("body").append(data);
            $(".modal").modal("toggle")
		});
	});

	//Button Edit
	$(document).on("click", ".btn-users-edit",function(event){
		$.get("/pages/users/edit.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data)
            $(".modal").modal("toggle")
		});
    });

    //Button Show
	$(document).on("click", ".btn-users-show",function(event){
		$.get("/pages/users/show.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Activities
	$(document).on("click", ".btn-users-activities",function(event){
        console.log("activities")
		$.get("/pages/users/activities.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Accesses
	$(document).on("click", ".btn-users-accesses",function(event){
        console.log("accesses")
		$.get("/pages/users/accesses.php?id="+$(event.target).parent().data("id"), function(data){
			$("body").append(data);
            $(".modal").modal("toggle");
		});
	});

    //Button Store
	$(document).on("click", ".btn-users-store",function(){
        $("#FormModal").validate({
            rules : {
                password : {
                    minlength : 6
                },
                password_confirm : {
                    minlength : 6,
                    equalTo : "#password"
                }
            }
        })
        if($("#FormModal").valid()){
            let formData = $("#FormModal").serialize();
            $.post({
                url: "/pages/users/index.php",
                data:{
                    _data:formData,
                    _method: 'POST'
                },
                dataType: 'json'
            }).done(function(data){

            }).fail(function(data){
                
            }).always(function(data){
                location.reload()
            })
        }
	});

    //Button Update
	$(document).on("click", ".btn-users-update",function(event){
        function isPasswordPresent() {
            return $("#password").val().length > 0;
        }
        $("#FormModal").validate({
            rules : {
                password : {
                    required: isPasswordPresent,
                    minlength : 6
                },
                password_confirm : {
                    required: isPasswordPresent,
                    minlength : 6,
                    equalTo : "#password"
                }
            }
        })
        if($("#FormModal").valid()){
            let id = $(event.target).data("id")		
            let formData = $("#FormModal").serialize();
            $.post({
                url: "/pages/users/index.php",
                data:{
                    _id:id,
                    _data:formData,
                    _method: 'PUT'
                },
                dataType: 'json'
            }).done(function(data){

            }).fail(function(data){
                
            }).always(function(data){
                location.reload()
            })
        }
	});

	//Button Delete
	$(document).on("click", ".btn-users-delete",function(event){
		swal({
			title: "Delete",
			text: "Do you want to delete this category ?",
			icon: "warning",
			buttons: ["Cancel", "Delete"],
			dangerMode: true
		}).then((willDelete) => {if(willDelete){
				let id = $(event.target).parent().data("id")
				$.post({
					url: "/pages/users/index.php",
					data:{
						_id:id,
						_method: 'DELETE'
					}
				}).done(function(data){
					
				}).fail(function(data){

				}).always(function(data){
					location.reload()
				})
			}
		});
	});

    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test( $email );
      }
});