;(function($) {
	$('input').focus();

	var request;

	$('form').submit(function(event) {

		event.preventDefault();

	    if (request) {
	        request.abort();
	    }

	    var $form = $(this),
	    	$loading = $('#loading'),
	    	$response = $('#json-response');

	    var $inputs = $form.find("input, select, button, textarea");

	    var serializedData = $form.serialize();

	    request = $.ajax({
        url: "converter.json.php",
        type: "post",
        data: serializedData,
        beforeSend: function(xhr) {
        	$loading.fadeIn(100);
        }
	    });

	    request.done(function (response, textStatus, jqXHR) {

        $form.hide();

        $response.slideDown('fast', function() {
        	$(this).html(response).select();
        });

        $('.restart').show().on('click', function(e) {
					e.preventDefault();

					if ( ! $(this).is(':hidden')) {
						$form.show().find('input').val('').focus();
						$response.hide();
						$(this).hide();
					}
				});
	    });

	    request.fail(function (jqXHR, textStatus, errorThrown) {
        console.error(
            "The following error occured: "+
            textStatus, errorThrown
        );

        alert('There was a problem');
	    });

	    request.always(function () {
	    	$loading.fadeOut(100);
	    });
	});

})(jQuery);
