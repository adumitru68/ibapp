var formsAdminService = ( function () {

	function hideElement( textSelector ) {
		$( '' + textSelector ).hide();
	}

	function showElement( textSelector ) {
		$( '' + textSelector ).show();
	}

	function slideUpElement( textSelector ) {
		$( '' + textSelector ).slideUp();
	}

	function slideDownElement( textSelector ) {
		$( '' + textSelector ).slideDown();
	}

	function showCreateForm() {
		$('#btn_show_create_form').slideUp(function () {
			$('#create_form_box').slideDown();
		});
	}

	function hideCreateForm() {
		$('#create_form_box').slideUp(function () {
			$('#btn_show_create_form').slideDown();
		});
	}

	return {
		'hide':hideElement,
		'show':showElement,
		'slideUp': slideUpElement,
		'slideDown':slideDownElement,
		'showCreateForm':showCreateForm,
		'hideCreateForm':hideCreateForm
	}

})();

$( document ).ready(function() {

	$("#create_new_form").submit(function(e) {
		var url = "/admin/ajax/forms/new/";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#create_new_form").serialize(),
			success: function(data) {
				$('#result_submit').html( data );
				//registerService.markErrors(data);
				console.log(data);
			}
		});
		e.preventDefault();
	});

});