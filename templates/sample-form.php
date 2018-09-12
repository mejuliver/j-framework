
<html>
<head>
	<meta charset="UTF-8">
	<title>Welcome</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link href="https://fonts.googleapis.com/css?family=Roboto:400,500" rel="stylesheet">
	<style>
		body{
			background: #0099ff;
			color: #FFF;
			padding: 0px;
			margin: 0px;
		}
		#main-wrapper{
			min-height: 100vh;
			width: 100%;
			display: flex;
			align-items: center;
			justify-content: center;
		}
		input{
			color: #000;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="co-md-12">
				<div id="main-wrapper">
					<form action="<?php echo $this->config('url'); ?>/sample-form/input" method="post">
						<fieldset>
							<label for="">Name</label>
							<input type="text" name="name" value="<?php echo isset($input_name) ? $input_name : ''; ?>">
							<button class="btn btn-success">Submit</button>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>