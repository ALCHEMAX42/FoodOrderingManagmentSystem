<?php
session_start();
@$name = $_SESSION['user_name'];
@$email = $_SESSION['user_email'];
include 'includes/dbh.inc.php';
$criteria = $_GET['criteria'];
$sql = "SELECT * from restaurants";
$result = mysqli_query($conn, $sql);
$id = '';
$ans = array();
if (mysqli_num_rows($result) > 0) {
	while ($row = mysqli_fetch_array($result)) {
		$cuisineAvail = $row['rest_cuisine'];
		$ans = explode(',', $cuisineAvail);
		for ($i = 0; $i < sizeof($ans); $i++) {
			if ($ans[$i] == $criteria) {
				$id .= 'rest_id = "' . $row['rest_id'] . '" OR ';
			}
		}
	}
}
if (strlen($id) > 0) {
	$id = substr($id, 0, -4);
	$sqlRest = "SELECT * from restaurants where " . $id;
} else {
	$sqlRest = "SELECT * from restaurants";
}
$result = mysqli_query($conn, $sqlRest);
?>
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
	<link rel="stylesheet" type="text/css" href="css/user.css">
</head>
<script type="text/javascript">
	function sortByRating() {

	}

	function cuisinefilter(val) {
		window.location.href = "filter.php?criteria=" + val;
	}
</script>

<body>
	<header>

		<?php if ($name == "") { ?>
			<a href="logsignup/login.php" class="loginbutton btn" data-toggle="modal" data-target="#login">Login</a>
			<a href="logsignup/signup.php" class="btn signupbutton" data-toggle="modal" data-target="#signup">Create an account</a>
		<?php } else { ?>
			<div class="dropdown">
				<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name; ?>
					<span class="caret"></span></button>
				<ul class="dropdown-menu">
					<li><a class="dropdown-item" href="userLoggedIn.php">Home</a></li>
					<li><a class="dropdown-item" href="orderHistory.php">Order History</a></li>
					<li><a class="dropdown-item" href="AddRestaurant.php">Add Restaurant</a></li>
					<li><a class="dropdown-item" href="<?php if ($haverest == 1) {
															echo "ManageRestaurant.php";
														} else {
															echo "#";
														} ?>">Manage Restaurant</a></li>
					<li>
						<a class="dropdown-item" href="logsignup/logout.php">Logout</a>
					</li>
				</ul>
			</div>

		<?php } ?>
		<img class="logo" src="./rest_images/logo.png" alt="LOGO">
	</header>
	<div class="container">
		<h2 class="tagline" style="margin-top: 1%;">Order Food Online from your favourite outlet 🍛🍔🌯🍜🍧🎂</h2>
		<?php
		$c = 0;
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_array($result)) {
				$name =  $row['rest_name'];
				$image = $row['rest_image'];
				$rating = $row['rest_rating'];
				$cuisine = $row['rest_cuisine'];
				$c++;
		?>
				<div class="filters col-sm-2">
					<h4 style="font-weight: 900;">Filters</h4>
					<h5 style="font-weight: 900;color: #E23744;">Sort by</h5>
					<ul>
						<li><a href="" style="border: none; background-color: #fff; cursor: pointer; color:black;" onclick="sort('popularity')">Popularity</a></li>
						<li><a href="" style="border: none; background-color: #fff; cursor: pointer; color:black;" onclick="sort('rating')">Rating</a></li>
					</ul>
					<h5 style="font-weight: 900;color: #E23744;">Cuisine</h5>
					<ul>
						<li><button onclick="cuisinefilter('North Indian')" style="border: none; background-color: #fff; cursor: pointer; color:black;">North Indian</button></li>
						<li><button onclick="cuisinefilter('Fast Food')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Fast Food</button></li>
						<li><button onclick="cuisinefilter('Chinese')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Chinese</button></li>
						<li><button onclick="cuisinefilter('Dessert')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Dessert</button></li>
						<li><button onclick="cuisinefilter('Icecream')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Ice Cream</button></li>
						<li><button onclick="cuisinefilter('Pizza')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Pizza</button></li>
						<li><button onclick="cuisinefilter('South Indian')" style="border: none; background-color: #fff; cursor: pointer; color:black;">South Indian</button></li>
						<li><button onclick="cuisinefilter('Cafe')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Cafe</button></li>
					</ul>
				</div>

		<?php if ($c % 2 == 1) {
					$offset = '<div class="row"><div style="left:10%;" class=" offset-2 card mt-5 mr-4"><div class="row">
					<div class="col-sm-3"><img src="' . $image . '"></div>
				
					<div class="col-sm-9">
						<div class="row">
							<div class="col-sm-10"><h5>' . $name . '</h5></div>
							<div class="col-sm-2"><button class="btn btn-success">' . $rating . '</button></div>
						</div>
						<div class="row">
							<div class="cus col-sm-12">' . $cuisine . '</div>
						</div>
					</div>
				</div>
				<hr>
				<button class="btn order btn-success" onclick="Order(\'' . $name . '\')">Order Online</button></div>';
					echo $offset;
				} else {
					$normal = '<div class=" card mt-5"><div class="row">
					<div class="col-sm-3"><img src="' . $image . '"></div>
					
						<div class="col-sm-9">
							<div class="row">
								<div class="col-sm-10"><h5>' . $name . '</h5></div>
								<div class="col-sm-2"><button class="btn btn-success">' . $rating . '</button></div>
							</div>
							<div class="row">
								<div class="cus col-sm-12">' . $cuisine . '</div>
							</div>
						</div>
					</div>
					<hr>
					<button class="btn order btn-success" onclick="Order(\'' . $name . '\')">Order Online</button>
				</div></div>';
					echo $normal;
				}
			}
		}
		?>
		<div class="filters col-sm-2">
			<h4 style="font-weight: 900;">Filters</h4>
			<h5 style="font-weight: 900;color: #E23744;">Sort by</h5>
			<ul>
				<li><a href="" style="border: none; background-color: #fff; cursor: pointer; color:black;" onclick="sort('popularity')">Popularity</a></li>
				<li><a href="" style="border: none; background-color: #fff; cursor: pointer; color:black;" onclick="sort('rating')">Rating</a></li>
			</ul>
			<h5 style="font-weight: 900;color: #E23744;">Cuisine</h5>
			<ul>
				<li><button onclick="cuisinefilter('North Indian')" style="border: none; background-color: #fff; cursor: pointer; color:black;">North Indian</button></li>
				<li><button onclick="cuisinefilter('Fast Food')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Fast Food</button></li>
				<li><button onclick="cuisinefilter('Chinese')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Chinese</button></li>
				<li><button onclick="cuisinefilter('Dessert')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Dessert</button></li>
				<li><button onclick="cuisinefilter('Icecream')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Ice Cream</button></li>
				<li><button onclick="cuisinefilter('Pizza')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Pizza</button></li>
				<li><button onclick="cuisinefilter('South Indian')" style="border: none; background-color: #fff; cursor: pointer; color:black;">South Indian</button></li>
				<li><button onclick="cuisinefilter('Cafe')" style="border: none; background-color: #fff; cursor: pointer; color:black;">Cafe</button></li>
			</ul>
		</div>
		<form method="post" action="logsignup/signup.php">
			<div class="modal fade" id="signup" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background-color: red; color: #fff;">
							<h4 class="modal-title">SignUp to FoodUp</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Full Name</label>
								<input type="text" name="user_name" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="user_email" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="user_password" class="form-control" required>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" name="signup" class="btn btn-success">Sign Up</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						</div>
					</div>
				</div>
			</div>
		</form>
		<form method="post" action="logsignup/login.php">
			<div class="modal fade" id="login" role="dialog">
				<div class="modal-dialog">
					<div class="modal-content">
						<div class="modal-header" style="background-color: red; color: #fff;">
							<h4 class="modal-title">Login to FoodUp</h4>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<label>Email</label>
								<input type="email" name="user_email" class="form-control" required>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" name="user_password" class="form-control" required>
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
	</div>
</body>