<html>
<head>
	<meta charset="UTF-8">
	<title>Error Page</title>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet">
	<style>
		img{
			display:block;
			margin:0px auto 30px auto;
		}
		body{
			padding:0px;
			font-family: 'Quicksand', sans-serif;
		}
		#main-container{
			display: flex;
			align-items:center;
			justify-content:center;
			height: 100vh;
		}
		#main-container h1{
			letter-spacing: 2px;
			text-transform: uppercase;
			font-weight: 300;
		}
	</style>
</head>
<body>
	<div id="main-container">
		<div>
			<h1><?php echo $error_name; ?></h1>
		</div>
	</div>
</body>
</html>