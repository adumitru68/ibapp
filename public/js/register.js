var registerService = (function () {


	function loadSelect2Data(select2Id, apiUrl) {
		var element = $('#'+select2Id);
		element.undelegate('select2');
		$.post( apiUrl, function(data) {
			element.select2({
				data: data.results
			});
		});
	}


	function changeWindowUrl(){
		var url = '/login/';
		history.pushState('', '', url);
	}


	function markErrors( errors ) {

		$(".form-control").removeClass("is-invalid");
		var dataObject = JSON.parse(errors);

		if(countProperties(dataObject)===0) {
			$('#congratulations_block').slideDown();
			$('#register_div').hide();
			changeWindowUrl();
			$(this).delay(10000).queue(function() {
				window.location.href = '/login/';
				$(this).dequeue();

			});
		}

		for (var prop in dataObject) {
			var el = $('#'+prop);
			el.addClass('is-invalid');
			el.addClass('is-invalid').parent().find('.invalid-feedback').html(dataObject[prop]);
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
		'loadOptions': loadSelect2Data,
		'countProperties': countProperties,
		'markErrors':markErrors
	};

})();


$( document ).ready(function() {

	registerService.loadOptions('user_country', '/api/location/countries/');

	$('#user_city').select2();

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
				//$('#result_submit').html( data );
				registerService.markErrors(data);
			}
		});
		e.preventDefault();
	});

});