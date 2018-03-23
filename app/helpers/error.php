<html>
<head>
	<meta charset="UTF-8">
	<title>Error Page</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet">
	<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<style>
		img{
			display:block;
			height:450px;
		}
		body{
			padding:0px;
			font-family: 'Quicksand', sans-serif;
			text-align:center;
		}
		#main-container{
			display: flex;
			align-items:center;
			justify-content:center;
			height: 100vh;
		}
		#main-container h1{
			letter-spacing: 3px;
			text-transform: uppercase;
			font-weight: 300;
			margin-top:55px;
			font-weight:600;
			line-height: 50px;
		}
		@media (max-width:767px){
			
			img{
				width: 80%;
				height:initial;
			}
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<div id="main-container">
					<div>
						<div class="col-sm-6">
							<img src="<?php $base_url?>/app/helpers/assets/img/j-man.png" alt="Error Image">
						</div>
						<div class="col-sm-6">
							<h1><?php echo $error_name; ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</body>
</html>