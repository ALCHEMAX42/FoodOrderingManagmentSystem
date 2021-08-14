<?php
session_start();
$name = $_SESSION['user_name'];
$email = $_SESSION['user_email'];
$haverest = 0;
include 'includes/dbh.inc.php';
$sqlRest = "SELECT * from restaurants";
$result = mysqli_query($conn, $sqlRest);
$checkhaveRes = "Select * from users where user_name = '$name'";
$have = mysqli_query($conn, $checkhaveRes);
$row = mysqli_fetch_array($have);
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
<script type="text/javascript">
	function sortByRating() {

	}

	function Order(name) {
		//name = name.replace(/ /gi,'');
		window.location.href = "order.php?name=" + name;
	}
</script>

<body>
	<header>

		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name; ?>
				<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="userLoggedIn.php">Home</a></li>
				<li><a class="dropdown-item" href="Feedback.php">Feedback</a></li>
				<li><a class="dropdown-item" href="logsignup/logout.php">Logout</a></li>
			</ul>
		</div><img class="logo" src="./rest_images/logo.png" alt="LOGO">
	</header>
	<div class="container">
		<?php
		$sql = "SELECT * from orders where user_name='$name' and order_id=(select MAX(order_id) from orders)";
		$res = mysqli_query($conn, $sql);
		if (mysqli_num_rows($res) > 0) {
			while ($rows = mysqli_fetch_array($res)) {
				$rest_name = $rows['rest_name'];
				$item = $rows['order_item'];
				$cost = $rows['cost'];
				$status = $rows['order_status'];
				$arr = array();
				$arr = explode(',', $item); ?>
				<div class="card" style="border-radius:20px;padding-right:240px;margin-top:5px !important;width: 50%;">
					<h3><?php echo $rest_name; ?></h3><?php
														for ($i = 0; $i < sizeof($arr); $i++) {
															$x = $arr[$i];
															$rest_name = str_replace(' ', '', $rest_name);
															$sqlr = "SELECT * from $rest_name where dish_id='$x'";
															$dish = mysqli_query($conn, $sqlr);
															if (mysqli_num_rows($dish) > 0) {
																while ($rows1 = mysqli_fetch_array($dish)) {
																	$cuisine = $rows1['cuisine'];
																	$image = $rows1['image'];
														?>
								<div class="row">
									<div class="col-sm-8">
										<h5><?php echo $cuisine; ?></h5>
									</div>
									<div class="col-sm-4">
										<img src="<?php echo $image; ?>" style="height: 120px;width:120px;border-radius:1em;border: 1px solid #2d2d2d;">
									</div>
								</div>
					<?php	}
															}
														}
														echo "Total=" . $cost . "<span style='display:block;font-weight:700;top:20px;color:green;'>Status=" . $status . "</span>" ?>
				</div><?php
					}
				}else{echo "<h2>Your Cart is empty<img src='rest_images/Cart.png' height='50px' width='50px'></h2>";}
						?>
	</div>
</body>