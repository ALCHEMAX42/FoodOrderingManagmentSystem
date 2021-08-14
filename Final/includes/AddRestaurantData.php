<?php
	session_start();
		
	//$ownerId = $_SESSION['user_id'];
	$ownername = $_SESSION['name'];
	include 'dbh.inc.php';
	if(isset($_POST['addrestaurant'])){
		//$image =  $_FILES['rest_image'];
		//print_r($image);
		$name = mysqli_real_escape_string($conn,$_POST['restaurantname']);
		$uname = mysqli_real_escape_string($conn,$_POST['username']);
		$pass = mysqli_real_escape_string($conn,$_POST['pass']);
		$address = mysqli_real_escape_string($conn,$_POST['restaurantaddress']);
		$cuisine='';
		if(!empty($_POST['cuisine']))
			foreach ($_POST['cuisine'] as $key) {
				$cuisine.=','.$key;
		}
		$cuisine = substr($cuisine, 1);
		$email = mysqli_real_escape_string($conn,$_POST['restaurantemail']);
		$open = mysqli_real_escape_string($conn,$_POST['open']);
		$close = mysqli_real_escape_string($conn,$_POST['close']);
		if(isset($_FILES['image'])){
		$image =  $_FILES['image'];
		print_r($image);
		$imagename = $_FILES['image']['name'];
		$fileExtension = explode('.', $imagename);
		$fileCheck = strtolower(end($fileExtension));
		$fileExtensionStored = array('png','jpg','jpeg');
		if(in_array($fileCheck, $fileExtensionStored)){
			$destinationFile = '../rest_images/'.$imagename;
			$exact = 'rest_images/'.$imagename;
			move_uploaded_file($_FILES['image']['tmp_name'], $destinationFile);
			$sqlInsert = "INSERT INTO restaurants(rest_username,rest_password,rest_ownername,rest_name,rest_address,rest_email,rest_open,rest_close,rest_cuisine,rest_rating,rest_image) 
			values('$uname','$pass','$ownername','$name','$address','$email','$open','$close','$cuisine','0','$exact');";
			mysqli_query($conn,$sqlInsert);
			$restname = str_replace(' ','',$name);
			$addRest="CREATE table $restname(
				dish_id int(100) Auto_increment primary key,
				cuisine varchar(50),
				type varchar(50),
				cost int(100),
				image varchar(250)
			)";
			/*$restname='../restaurant/'.$restname.'.php';
			echo $restname;
			$fh = fopen($restname, 'a');*/
			if(!mysqli_query($conn,$addRest))
			echo mysqli_error($conn);
			header("Location: ../RestaurantDetails.php?RestaurantAdded");
		}
	}
		
	}

?>





