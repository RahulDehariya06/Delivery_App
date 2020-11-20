/* On category selected */

$(document).on('click', '.tabbutton', function (e) {
	$(".tab-button").removeClass("active");
	$(".tabbutton").addClass("active");

	$('#deliveryBoy').hide();
	$('#datatable').show();
});

$(document).on('click', '.tab-button', function (e) {
	$(".tabbutton").removeClass("active");
	$(".tab-button").addClass("active");

	$('#datatable').hide();
	$('#deliveryBoy').show();
});

// setTimeout(function(){ 
// 	$(".alert").hide();
//  }, 6000);


$(document).ready(function() {
	

    // Default Datatable
    $('#datatable').DataTable();

    
} );
       
$(document).ready(function () {
	
	/* CSRF Protection */
	var token = $('meta[name="csrf-token"]').attr('content');
	if (token) {
		$.ajaxSetup({
			headers: {'X-CSRF-TOKEN': token},
			async: true,
			cache: false
		});
	}

	$(document).on('click', '.delete-store', function (e) {
		var confirmation = confirm("Are you sure want to delete this");
			
			if (confirmation) {
				if( $(this).is('a') ){
					var url = $(this).attr('href');
					if (url !== 'undefined') {
						location.href = url;
					}
				} else {
					/* Make ajax call */
				$.ajax({
					method: 'GET',
					url: 'http://localhost/Delivery_app/deleteStore',
					data: {
						'_token': $('input[name=_token]').val(),
						'storeId':  $(this).attr("data-store")
					}
				}).done(function (obj) {
					if(obj){
						
					}
				});
				}
				
			}
			
		return false;
	});
  $(document).on('click', '.delete-driver', function (e) {
		var confirmation = confirm("Are you sure want to delete this");
			
			if (confirmation) {
				if( $(this).is('a') ){
					var url = $(this).attr('href');
					if (url !== 'undefined') {
						location.href = url;
					}
				} else {
					/* Make ajax call */
				$.ajax({
					method: 'GET',
					url: 'http://localhost/Delivery_app/deliveryboy/updateimage',
					data: {
						'_token': $('input[name=_token]').val(),
						'storeId':  $(this).attr("data-store")
					}
				}).done(function (obj) {
					if(obj){
						
					}
				});
				}
				
			}
			
		return false;
	});

	$("#fileupdate").change(function(){
		/* Make ajax call */
			 $('#profilepic').submit();
	});
	$("#updatephoto").change(function(){
		/* Make ajax call */
			 $('#profileupdate').submit();
	});


});
	