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

});