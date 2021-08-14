<?php
session_start();
include 'includes/dbh.inc.php';
$name = $_SESSION['name'];
$sql = "SELECT * from restaurants where rest_username='$name'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$rest_name = $row['rest_name'];
if (isset($_POST['addcuisine'])) {
	$cuisinename = $_POST['dish'];
	$type = $_POST['type'];
	$cost = $_POST['cost'];
	$restname = str_replace(' ', '', $rest_name);


	if (isset($_FILES['image'])) {
		$image =  $_FILES['image'];
		$imagename = $_FILES['image']['name'];
		$fileExtension = explode('.', $imagename);
		$fileCheck = strtolower(end($fileExtension));
		$fileExtensionStored = array('png', 'jpg', 'jpeg');
		if (in_array($fileCheck, $fileExtensionStored)) {
			$destinationFile = 'rest_images/' . $imagename;
			$exact = 'rest_images/' . $imagename;
			move_uploaded_file($_FILES['image']['tmp_name'], $destinationFile);
		}
	}


	$insertdish = "INSERT into $restname(cuisine,type,cost,image) values ('$cuisinename','$type','$cost','$exact')";
	mysqli_query($conn, $insertdish);
	header("Location: ManageRestaurant.php?Cuisine Added");
}

?>
<html>

<head>
	<title>Manage-<?php echo $rest_name; ?></title>
	<link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/manage.css">
</head>

<body>
	<header>
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name; ?>
				<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="Restaurant.php">Home</a></li>
				<li><a class="dropdown-item" href="RestaurantOrder.php">Orders</a></li>
				<li><a class="dropdown-item" href="RestaurantLogout.php">Logout</a></li>
			</ul>
		</div>
		<img class="logo" src="./rest_images/logo.png" alt="LOGO">

	</header>
	<div class="container">
		<div class="card">
			<div class="row">
				<h2 class="col-sm-11"><?php echo $rest_name; ?></h2>
				<div class="col-sm-1"><button class="btn btn-success"><?php echo $row['rest_rating']; ?></button></div>
			</div>
			<p><?php echo $row['rest_address']; ?></p>
		</div>
		<div>
			<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
				<div class="card">
					<h3>Add a Cuisine</h3>
					<div class="form-row">
						<div class="form-group col-sm-4">
							<label>Cuisine Name</label>
							<input type="text" name="dish" class="form-control">
						</div>
						<div class="form-group col-sm-2">
							<label>Cuisine type</label>
							<input type="text" name="type" class="form-control">
						</div>
						<div class="form-group col-sm-2">
							<label>Cuisine Cost</label>
							<input type="integer" name="cost" class="form-control">
						</div>
						<div class="form-group col-sm-2">
							<label>Cuisine Image</label>
							<input type="file" name="image">
						</div>
					</div>
					<div><button class="btn btn-success" name="addcuisine">Add</button></div>
				</div>
			</form>
		</div>
		<div>
			<?php
			$restname = str_replace(' ', '', $rest_name);
			$findDish = "SELECT * from $restname";
			$dishes = mysqli_query($conn, $findDish);
			if (mysqli_num_rows($dishes) > 0) {
				while ($rows = mysqli_fetch_array($dishes)) {
			?>
					<div class="card">
						<div class="form-row">
							<div class="form-group col-lg-3">
								<label>Cuisine Name</label>
								<input type="text" name="dish" class="form-control" value="<?php echo $rows['cuisine']; ?>">
							</div>
							<div class="form-group col-lg-3">
								<label>Cuisine type</label>
								<input type="text" name="type" class="form-control" value="<?php echo $rows['type']; ?>">
							</div>
							<div class="form-group col-lg-2">
								<label>Cuisine Cost</label>
								<input type="integer" name="cost" class="form-control" value="<?php echo $rows['cost']; ?>">
							</div>
							<div class="form-group col-lg-4">

								<img src="<?php echo $rows['image']; ?>" style="margin-left:90px;height: 120px;width:120px;border-radius:20px;border: 2px solid #2d2d2d;">
							</div>
						</div>
					</div>
			<?php
				}
			}
			?>
		</div>
	</div>
</body>

</html>