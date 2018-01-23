var registerService = (function () {

	function loadSelect2Data(select2Id, apiUrl) {
		var element = jQuery('#'+select2Id);
		element.undelegate('select2');
		element.select2({
			//minimumInputLength: 2,
			ajax: {
				type: "POST",
				url: apiUrl,
				dataType: 'json'
			}
		});
	}

	function submitForm() {

	}

	return {
		'loadOptions': loadSelect2Data,
		'submitForm': submitForm
	};

})();




$( document ).ready(function() {
	registerService.loadOptions('user_country', '/api/location/countries/');

	$( "#user_country" ).change(function() {
		$('#user_city')
			.empty()
			.append('<option selected="selected" value="0">Please select your city...</option>');
		var apiUrl = '/api/location/cities/'+ $(this).val() +'/';
		registerService.loadOptions('user_city', apiUrl);
	});
});