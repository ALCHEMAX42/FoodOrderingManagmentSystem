<?php
session_start();
include 'includes/dbh.inc.php';
$name = $_SESSION['name'];
$sql = "SELECT * from restaurants where rest_username='$name'";
$res = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($res);
$rest_name = $row['rest_name'];
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
				<li><a class="dropdown-item" href="ManageRestaurant.php">Home</a></li>
				<li><a class="dropdown-item" href="RestaurantOrder.php">Orders</a></li>
				<li><a class="dropdown-item" href="RestaurantLogout.php">Logout</a></li>
			</ul>
		</div>
		<img class="logo" src="./rest_images/logo.png" alt="LOGO">
	</header>
	<div class="container">
	<br>
	<br>
	<div class="card col-sm-12">
			<?php
			$users = "SELECT DISTINCT user_name from orders where rest_name='$rest_name'";
			$condition = mysqli_query($conn, $users);
			$arr = array();
			if (mysqli_num_rows($condition) > 0) {
				echo "<table cellspacing='15px' cellpadding='15px'>
			<tr style='color:blue;'>
				<th>Order ID</th>
				<th>User</th>
				<th>Total amount</th>
				<th>Items</th>
				<th>Placed on</th>
				<th>Order Status</th>
			</tr>";
				while ($row = mysqli_fetch_array($condition)) {
					$use = $row['user_name'];
					$findorders = "SELECT * from orders where rest_name='$rest_name' and order_id=(select MAX(order_id) from orders where rest_name='$rest_name' and user_name='$use')";
					$order = mysqli_query($conn, $findorders);
					if (mysqli_num_rows($order) > 0) {
						while ($rows = mysqli_fetch_array($order)) {
			?>

							<tr>
								<td><?php array_push($arr, $rows['order_id']);
									echo $rows['order_id']; ?></td>


								<td><?php echo $rows['user_name']; ?></td>



								<td><?php echo $rows['cost']; ?></td>


								<td><?php $item = $rows['order_item'];
									$pattern = '/[,]/';
									$comp = preg_split($pattern, $item);
									$restname = str_replace(' ', '', $rest_name);
									for ($i = 0; $i < sizeof($comp) - 1; $i++) {
										$it = $comp[$i];
										$querry1 = "SELECT cuisine from $restname where dish_id=$it";
										$res = mysqli_query($conn, $querry1);
										if ($res) {
											$result = mysqli_fetch_row($res);
											echo "$result[0], ";
										} else {
											echo mysqli_errno($conn);
										}
									} ?></td>

								<td><?php echo $rows['Time_of_order']; ?></td>
								<td><?php $status = $rows['order_status'];
									echo '<span style="color:#0fbf20;font-size:20px;"> '.$status.'</span>'; ?></td>
							</tr>

				<?php
						}
					}
				}
			}else{echo "<h2>No orders yet&#128532</h2>";}
				?>
		</table>
		</div>
		<br>
		<div class="card col-sm-4">
		<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
			<select name="OrderId" style="border-radius: 1em;padding-left:3px">
				<?php for ($i = 0; $i < sizeof($arr); $i++) {
					echo "<option>$arr[$i]</option>";
				} ?>
			</select>
			<select style="border-radius: 1em;padding-left:3px" name="status">
				<option value="Accepted">Accepted</option>
				<option value="Preparing..">Preparing</option>
				<option value="Ready to Deliver">Ready to Deliver</option>
				<option value="Delivered">Delivered</option>
				<option value="Out of Service">Out of Service</option>
			</select>
			<br><br>
			<input style="border-radius: 1em;" type="submit" name="submit" value="Update Status"><br>
		</form>
		<?php
		if (isset($_POST['submit'])) {
			$val = $_REQUEST['status'];
			$id = $_REQUEST['OrderId'];
			$querry1 = "UPDATE orders set order_status='$val' where order_id='$id'";
			if (mysqli_query($conn, $querry1)) {
				echo '<br><p style="color:#f4f4f2;background-color:#0fbf20;width:70%;font-family:Gilroy;">Updated successfully!!</p>';
			}
		} ?>
		</div>
	</div>
</body>

</html>