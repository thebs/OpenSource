<?php

session_start();

$server = $_SERVER['PHP_SELF'];
$_SESSION['index'] = $server;

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

if (!isset($_SESSION['register'])){
	include 'login-register.html';
}else{
	if($_SESSION['register'] == 'admin'){
		include 'index_admin.php';
	}else{
		include 'index_user.php';
	}
}

if (isset($_REQUEST['logout'])){

	unlink("online/".$_SESSION['register']);
	//unlink("result/".$_SESSION['register']);

	unset($_SESSION['register'], $_SESSION['fullname']);

	header("Location: $server");    
	exit(); 
}

?>

</body>
</html>