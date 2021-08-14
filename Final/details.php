<?php
session_start();
$name = $_SESSION['name'];
$email = $_SESSION['email'];
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
				<li><a class="dropdown-item" href="RestaurantDetails.php">Home</a></li>
				<li><a class="dropdown-item" href="AddRestaurant.php">Add Restaurant</a></li>
				<li><a class="dropdown-item" href="DeleteRestaurant.php">Delete Restaurant</a></li>
				<li><a class="dropdown-item" href="logout.php">Logout</a></li>
			</ul>
		</div><img class="logo" src="./rest_images/logo.png" alt="LOGO">
	</header>
	<div class="container">
		<h2 style="font-weight:700;margin-top: 1%;text-align:center;">Restaurant Details</h2>


		<?php
		include 'includes/dbh.inc.php';
		$nam = "SELECT * FROM restaurants";
		$res = mysqli_query($conn, $nam);
		echo "<table bgcolor=#f4f4f2 border='2px solid black' cellspacing=20px cellpadding=10px><tr><th>Username</th><th>Password</th><th>ID</th><th>Owner</th><th>Name</th><th>Address</th><th>Email</th><th>Open timings</th><th>Close timings</th><th>Rating</th><th>Cuisine</th></tr>";
		while ($result = mysqli_fetch_row($res)) {
			echo "<tr>";
			echo "<td>$result[0]</td><td>$result[1]</td><td>$result[2]</td><td>$result[3]</td><td>$result[4]</td><td>$result[5]</td><td>$result[6]</td><td>$result[7]</td><td>$result[8]</td><td>$result[9]</td><td>$result[11]</td> </tr>";
		}
		echo "</table>";

		?>
	</div>
</body>

</html>