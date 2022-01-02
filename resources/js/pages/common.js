/**
 * Common functions used by all pages
 */
$(function(){
	/**
	 * Options -> My Activities Button
	 * Shows the "My Activities" page modal
	 */
	$(".btn-options-activities").on("click", function(){
		$.get("/pages/options/activities.php", function(data){
			$("body").append(data)
			$(".modal").modal("toggle")
		});
	})

	/**
	 * Options -> About Button
	 * Shows the "About" page modal
	 */
	$(".btn-options-about").on("click", function(){
		$.get("/pages/options/about.php", function(data){
			$("body").append(data)
			$(".modal").modal("toggle")
		});
	});

	/**
	 * Options -> Help Button
	 * Shows the "Help" page modal
	 */
	$(".btn-options-help").on("click", function(){
		$.get("/pages/options/help.php", function(data){
			$("body").append(data)
			$(".modal").modal("toggle")
		});
	});
	
	 /**
	 * Options -> Logout Button
	 * Logout's the current user
	 */
	$(".btn-options-logout").on("click", function(){
		swal({
			title: "Logout",
			text: "Are you sure you want to logout ?",
			icon: "info",
			buttons: ["Cancel", "Logout"],
		})
		.then((logout) => {
			if(logout) {
				$.get("/pages/auth/logout.php");
			}
		});
	});

	/**
	 * Remove modal on close
	 */
	$(document).on("hidden.bs.modal", ".modal", function(){
		$(this).remove()
	});
});