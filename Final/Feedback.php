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
		<img class="logo" src="./rest_images/logo.png" alt="LOGO">
		<div class="dropdown">
			<button class="btn btn-secondary dropdown-toggle" type="button" data-toggle="dropdown"><?php echo $name; ?>
				<span class="caret"></span></button>
			<ul class="dropdown-menu">
				<li><a class="dropdown-item" href="userLoggedIn.php">Home</a></li>
				<li><a class="dropdown-item" href="Feedback.php">Feedback</a></li>
				<li><a class="dropdown-item" href="logsignup/logout.php">Logout</a></li>
			</ul>
		</div>
	</header>
	<div class="container">
		<h2 style="font-weight: 900;font-size:60px;">Feedback</h2>
		<form action="" method="post">
			<select name="Restaurant">
				<?php $querry1 = "SELECT rest_name from restaurants";
				$res = mysqli_query($conn, $querry1);
				while ($row = mysqli_fetch_row($res)) {
					echo "<option>$row[0]</option>";
				} ?>
			</select>
			<div style="font-weight: 900;font-size:40px;">Rating</div>
			<input type="number" name="rating" placeholder="1-10" min="1" max="10">
			<input class="btn btn-secondary dropdown-toggle" style="color: #2D2D2D !important;" type="submit" value="Submit" name="submit">
		</form>
		<?php
		if (isset($_POST['submit'])) {
			$nameof = $_REQUEST['Restaurant'];
			$rating = $_REQUEST['rating'];
			if (($rating >= 0) && ($rating <= 10)) {
				$querry1 = "UPDATE orders set Rating='$rating' where rest_name='$nameof' and order_id=(select MAX(order_id) from orders where rest_name='$nameof')";
				$res = mysqli_query($conn, $querry1);
				if ($res) {
					echo '<div style="margin-top:2px;"><b>Rated Successfully<b><div>';
				}
				$querry2 = "UPDATE restaurants set rest_rating=(SELECT avg(Rating) from orders where rest_name='$nameof') where rest_name='$nameof'";
				$result = mysqli_query($conn, $querry2);
			}
		}


		?><img class="intro" src="./rest_images/feed.jpg">
		<h2 style="color:#f4f4f2;font-weight:500;font-size:30px;margin-top:50px">Your feedback matter a lot 🙏🏼! It helps us understand our customers and provide better services</h2>
		<h2 style="color:#f4f4f2;font-weight:500;font-size:30px;margin-top:50px"><a style="text-decoration:none;color:#2D2D2D;" href="mailto:praful.garg2019@vitstudent.ac.in">Contact Us </a>for Resturant related complaints
		</h2>
	</div>
</body>