var formsAdminService = ( function () {

	var containerEdit = $('#edit_form_box');
	var containerAdd = $('#create_form_box');

	function showCreateForm() {
		$('#create_new_form').trigger('reset');
		containerAdd.slideDown();
		containerEdit.hide();
	}

	function hideCreateForm() {
		containerAdd.slideUp();
	}

	function showEditForm() {
		containerEdit.slideDown();
	}

	function hideEditForm() {
		containerEdit.slideUp();
	}

	function bindListEvents() {
		$( ".form-item" ).off('click').on( "click", function() {
			var id = $(this).attr('id').split("_")[1];
			containerAdd.hide();
			$( ".form-item" ).removeClass('selected');
			$(this).addClass('selected');
			containerEdit.hide();
			loadFormEdit(id);
		});
	}

	function clearFormEdit() {
		containerEdit.hide(function () {
			containerEdit.slideUp();
		})
	}

	function loadFormEdit(id) {

		var url = "/admin/ajax/forms/edit/?form_id=" + id;
		$.ajax({
			type: "GET",
			url: url,
			success: function(data) {
				containerEdit.html( data );
				containerEdit.slideDown();
			}
		});
	}

	function bindSearchEvent() {
		$('#search_forms').keyup(function() {
			delay(function(){
				loadFormList(0);
			}, 500 );
		});
	}

	function loadFormList( selectedItem )
	{
		selectedItem = selectedItem || 0;
		var url = "/admin/ajax/forms/list/";
		var filter = $('#search_forms').val();
		if(filter.trim().length > 0)
			url += '?filter='+filter.trim();
		$.ajax({
			type: "GET",
			url: url,
			success: function(data) {
				$('#list_of_forms').html( data );
				$('#'+'form_'+selectedItem).addClass('selected');
			}
		});


	}

	function afterCreateForm( data ) {

		$(".form-control").removeClass("is-invalid");
		var dataObject = JSON.parse(data);
		var lastId = parseInt(dataObject['lastId']);
		var errors = dataObject['errors'];
		if( lastId > 0 ) {
			hideCreateForm();
			loadFormList(lastId);
			loadFormEdit(lastId);
		}
		if(countProperties(errors)){
			console.log(errors);
			for (var prop in dataObject) {
				var el = $('#'+prop);
				el.addClass('is-invalid');
				el.addClass('is-invalid').parent().find('.invalid-feedback').html(dataObject[prop]);
			}
		}
	}

	function countProperties(obj) {
		var count = 0;
		for(var prop in obj) {
			if(obj.hasOwnProperty(prop))
				++count;
		}
		return count;
	}

	return {
		'showCreateForm':showCreateForm,
		'hideCreateForm':hideCreateForm,
		'bindListEvents':bindListEvents,
		'loadFormList':loadFormList,
		'bindSearchEvent':bindSearchEvent,
		'afterCreateForm':afterCreateForm
	}

})();

var delay = (function(){
	var timer = 0;
	return function(callback, ms){
		clearTimeout (timer);
		timer = setTimeout(callback, ms);
	};
})();

$( document ).ready(function() {

	formsAdminService.loadFormList();
	formsAdminService.bindSearchEvent();

	$("#create_new_form").submit(function(e) {
		var url = "/admin/ajax/forms/new/";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#create_new_form").serialize(),
			success: function(data) {
				//$('#result_submit').html( data );
				//registerService.markErrors(data);
				formsAdminService.afterCreateForm(data);
			}
		});
		e.preventDefault();
	});

});