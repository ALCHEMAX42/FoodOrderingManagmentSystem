<?php
session_start();
$name = $_SESSION['name'];
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
	<link rel="stylesheet" type="text/css" href="css/Addrestaurants.css">
</head>
<script type="text/javascript">
	function sortByRating() {

	}
</script>

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
		<h3 style="font-weight: 900;font-size:60px;">Delete a restaurant</h3>
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			Restaurant Id: <input type="text" name="rid">
			<input class="secondary" type="submit" value="Delete">
		</form>
		<?php
		include 'includes/dbh.inc.php';
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$ID = $_REQUEST['rid'];
			if (!empty($ID)) {
				$qur = "DELETE FROM restaurants WHERE rest_id=$ID";
				$nam = "SELECT rest_name FROM restaurants WHERE rest_id=$ID";
				$res = mysqli_query($conn, $nam);
				while ($result = mysqli_fetch_row($res)) {
					echo "$result[0] ";
				}
				if (mysqli_query($conn, $qur)) {
					echo '<div style="font-weight: 600;font-size:20px;">restaurant deleted successfully</div>';
				} else {
					echo "Some problem while deleting";
				}
			}
		}
		?>
	</div>
</body>