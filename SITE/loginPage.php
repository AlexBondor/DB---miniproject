<html>
	<head>
	 	<title>Login</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<!-- BODY -->
		<div class = "row">
			<div class = "col-lg-10 col-lg-offset-1 col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1 col-xs-10 col-xs-offset-1">
				<br><br><br><br><br>
				<h1 class = "text-center">Watches Store <small><i><br>Database management</i></small></h1>
				<div class="row">
					<div class = "col-lg-4 col-lg-offset-4 col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1" style="background:#dfdfdf; border-radius:4px;">
						<form action="login.php" method="post" class="form-signin" role="form">
							<br>
							<input type="text" class="form-control" name="username" placeholder="Username">
							<br>
							<input type="password" class="form-control" name="password" placeholder="Password">
							<br>
							<button type="submit" name="submit" class="btn btn-success btn-block">Login</button>
						</form>
						<h5 class="text-center"><strong>OR</strong></h5>
						<button type="button" class="btn btn-info btn-block" onclick="location.href='home.php'">Back to store</button>
						<br>
					</div>
				</div>
			</div>
		</div>


	</body>
</html>