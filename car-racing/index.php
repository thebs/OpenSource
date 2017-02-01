<?php

session_start();

$thislink = $_SERVER['PHP_SELF'];
$_SESSION['index'] = $thislink;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Car Racing</title>

	<link rel="stylesheet" type="text/css" href="asset/bootstrap.min.css">
	<script type="text/javascript" src="asset/bootstrap.min.js"></script>
	<script type="text/javascript" src="asset/jquery.js"></script>

	<link rel="stylesheet" href="asset/style.css">

</head>
<body>

<?php 

// request register or login
if (!isset($_SESSION['register'])){
	include 'login-register.html';
}else{
	// login with admin
	if($_SESSION['register'] == 'admin'){
		include 'index_admin.php';
		
	// login with user
	}else{
		include 'index_user.php';
	}
}

// logout
if (isset($_REQUEST['logout'])){

	unlink("online/".$_SESSION['register']);
	unset($_SESSION['register'], $_SESSION['fullname']);

	// refresh this page
	header("Location: $thislink");    
	exit(); 
}

// for edit user 
if (isset($_REQUEST['list'])){
	$_SESSION['list'] = "list";

	// goto manager.php
	header("Location: manage.php");    
	exit(); 
}

?>

</body>
</html>