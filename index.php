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

	<script src="js/main.min.js"></script>
</body>
</html>