<?php
session_start();
$name = $_SESSION['name'];
$email = $_SESSION['email'];
?>
<?php
include 'includes/dbh.inc.php';
$sqlRest = "SELECT * from restaurants";
$result = mysqli_query($conn, $sqlRest);

?>
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

<body>
	<header>

		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name; ?>
				<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="administrator.php">Home</a></li>
				<li><a class="dropdown-item" href="AddRestaurant.php">Add Restaurant</a></li>
				<li><a class="dropdown-item" href="DeleteRestaurant.php">Delete Restaurant</a></li>
				<li><a class="dropdown-item" href="details.php">Get full details</a></li>
				<li><a class="dropdown-item" href="logout.php">Logout</a></li>
			</ul>
		</div><img class="logo" src="./rest_images/logo.png" alt="LOGO">
	</header>
	<div class="container">
		<h2 class="tagline"style="width:100%;margin-top: 1%;text-align:center;">Currently Restaurants which are working with us.🤝</h2>
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
		<?php if ($c % 2 == 1) {
					$offset = '<div class="row"><div class="offset-2 card mt-5 mr-4"  style="height:350px"><div class="row">
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
			</div>';
					echo $offset;
				} else {
					$normal = '<div class="card mt-5" style="height:350px"><div class="row">
					<div class="col-sm-3 "><img src="' . $image . '"></div>
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
				</div></div>';
					echo $normal;
				}
			}
		}
		?>

	</div>
</body>