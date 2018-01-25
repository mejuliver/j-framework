<html>
<head>
	<meta charset="UTF-8">
	<title>Error Page</title>
	<link href="https://fonts.googleapis.com/css?family=Quicksand:400,500" rel="stylesheet">
	<style>
		img{
			display:block;
			margin:50px auto 30px auto;
		}
		body{
			font-family: 'Quicksand', sans-serif;
			color:#000;
			text-align:center;
			font-weight 400;
			color:red;
		}
	</style>
</head>
<body>
	<img src="assets/img/error.gif">
	<h1>Error Page: <?php echo $error_name; ?></h1>
</body>
</html>