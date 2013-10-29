<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Google Docs Converter</title>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/styles.css">
</head>
<body>
	<div id="wrapper">
		<h3 class="title">Google Docs Converter</h3>
		<div id="wrapper-content">
			Input the Google Docs <strong>page key</strong> to convert to JSON.

			<textarea class="form-control" id="json-response" rows="12"></textarea>

			<form role="form" class="form">
				<div class="form-group">
					<input type="text" class="form-control" id="key" name="key" placeholder="Enter value for ?key=">
				</div>
				<button type="submit" class="btn btn-success">Submit</button>
				<div id="loading" class="spin-1"></div>
			</form>

			<a href="#" class="restart">
				<small>Enter a new value</small>
			</a>
		</div>
	</div>

	<script>
		;(function($) {
			$('input').focus();

			var request;

			$('form').submit(function(event){
			    if (request) {
			        request.abort();
			    }
			    // setup some local variables
			    var $form = $(this),
			    	$loading = $('#loading'),
			    	$response = $('#json-response');
			    
			    var $inputs = $form.find("input, select, button, textarea");
			    
			    var serializedData = $form.serialize();

			    // fire off the request to /form.php
			    request = $.ajax({
			        url: "converter.json.php",
			        type: "post",
			        data: serializedData,
			        beforeSend: function(xhr) {
			        	$loading.fadeIn(100);
			        }
			    });

			    // callback handler that will be called on success
			    request.done(function (response, textStatus, jqXHR) {
			        // log a message to the console
			        console.log("Hooray, it worked!");

			        $form.hide();

			        $response.slideDown('fast', function() {
			        	$(this).html(response);
			        });

			        // Click link to go back to enter new value
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

			    // callback handler that will be called regardless
			    // if the request failed or succeeded
			    request.always(function () {
			        // reenable the inputs
			        $inputs.prop("disabled", false);
			        $loading.fadeOut(100);
			    });

			    // prevent default posting of form
			    event.preventDefault();
			});
		})(jQuery);
	</script>
</body>
</html>