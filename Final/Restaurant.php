<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/index.css">
</head>

<body>
	<header>
		<img class="logo" src="./rest_images/logo.png" alt="LOGO">
		<a href="login.php" style="right: 3%;
	top: 5%;" class="loginbutton btn" data-toggle="modal" data-target="#login">Restaurant Login</a>
	</header>
	<form method="post" action="RestaurantLogin.php">
		<div class="modal fade" id="login" role="dialog">
			<div class="modal-dialog">
				<div class="modal-content" style="border-radius:30px">
					<div class="modal-header" style="background-color: #2D2D2D; color: #fff;">
						<h4 class="modal-title">Login to FoodUp</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Username</label>
							<input type="text" name="username" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" class="form-control" required>
						</div>
					</div>
					<div class="modal-footer">
						<button type="submit" name="login" class="btn btn-success">Login</button>
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					</div>
				</div>
			</div>
		</div>
	</form>
	<div class="cc">
		<div class="container">
			<div class="row">
				<div class="col-sm">
					<div class="tagline">Change the way you deliver happiness 😀</div>
				</div>
				<div class="col-sm pasta">
					<img style="left:30%;width:30vw;  height:35vw; border-radius:20px" class="intro" src="./rest_images/pasta.jpg" alt="background_pasta">
				</div>
				<img style="left:10%;top:220px;width:500px;height:320px;border-style:none;" class=" intro" src="./rest_images/cook.jpg" alt="cook">
			</div>
		</div>
	</div>
</body>

</html>