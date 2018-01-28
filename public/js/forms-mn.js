var formsAdminService = ( function () {

	function showCreateForm() {
		$('#create_form_box').slideDown();
	}

	function hideCreateForm() {
		$('#create_form_box').slideUp();
	}

	function bindListEvents() {
		$( ".form-item" ).off('click').on( "click", function() {
			$('#create_form_box').hide();
			$( ".form-item" ).removeClass('selected');
			$(this).addClass('selected');
		});
	}

	function loadFormList( selectedItem )
	{
		selectedItem = selectedItem || 0;

		var url = "/admin/ajax/forms/list/";

		$.ajax({
			type: "GET",
			url: url,
			success: function(data) {
				$('#list_of_forms').html( data );
			}
		});
	}

	return {
		'showCreateForm':showCreateForm,
		'hideCreateForm':hideCreateForm,
		'bindListEvents':bindListEvents,
		'loadFormList':loadFormList
	}

})();

$( document ).ready(function() {

	formsAdminService.loadFormList();
	formsAdminService.bindListEvents();

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