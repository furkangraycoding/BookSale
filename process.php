<?php
	session_start();

	$_SESSION['err'] = 1;
	foreach($_POST as $key => $value){
		if(trim($value) == ''){
			$_SESSION['err'] = 0;
		}
		break;
	}

	if($_SESSION['err'] == 0){
		header("Location: purchase.php");
	} else {
		unset($_SESSION['err']);
	}

	require_once "./functions/database_functions.php";
	// print out header here
	$title = "Purchase Process";
	require "./template/header.php";
	// connect database
	$conn = db_connect();
	extract($_SESSION['ship']);

	$card_number = $_POST['card_number'];
	$card_PID = $_POST['card_PID'];
	$card_expire = strtotime($_POST['card_expire']);
	$card_owner = $_POST['card_owner'];

	$name = $_POST['name'];
	$address = $_POST['address'];
	$city = $_POST['city'];
	$zip_code = $_POST['zip_code'];
	$country = $_POST['country'];
	$date = date("Y-m-d H:i:s");
	$total_price=$_SESSION['total_price'];
	

	
	$customerid = getCustomerId($name, $address, $city, $zip_code, $country);
	
	$orderid = getOrderId($conn, $customerid);
	
	foreach ($_SESSION['cart'] as $orderid) {
		# code...
	
	$query = "INSERT INTO orders VALUES 
		('$orderid' ,'$customerid', '$total_price', '$date', '$name', '$address', '$city', ' $zip_code ', '$country ')";
		mysqli_query($conn, $query);

	}
	

	
	

	foreach($_SESSION['cart'] as $isbn => $qty){
		$bookprice = getbookprice($isbn);
		$query = "INSERT INTO order_items VALUES 
		('$orderid', '$isbn', '$bookprice', '$qty')";
		mysqli_query($conn, $query);
		
	}

	session_unset();
?>
	<p class="lead text-success">Your order has been processed sucessfully. Please check your email to get your order confirmation and shipping detail!. 
	Your cart has been empty.</p>

<?php
	if(isset($conn)){
		mysqli_close($conn);
	}
	require_once "./template/footer.php";
?>