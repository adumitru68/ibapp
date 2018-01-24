var registerService = (function () {


	function loadSelect2Data(select2Id, apiUrl) {
		var element = jQuery('#'+select2Id);
		element.undelegate('select2');
		$.post( apiUrl, function(data) {
			element.select2({
				data: data.results
			});
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

	$("#register_form").submit(function(e) {
		var url = "/register/";
		$.ajax({
			type: "POST",
			url: url,
			data: $("#register_form").serialize(),
			success: function(data) {
				$('#result_submit').html( data );
				console.log(data);
			}
		});
		e.preventDefault();
	});

});