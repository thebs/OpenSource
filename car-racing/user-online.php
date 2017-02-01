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

session_start();

$home = "index.php";

if ($_SESSION['register'] != "admin"){
	header("Location: index.php"); 
	exit();	
}

$html = "<div align='center'><div style='font-size: 20px; font-weight: bold; margin-top: 20px;'>
			All User Online</div><br>
			<table class='tbonline' align='center'>
				<tr>
					<th>No.</th>
					<th>Username</th>
				</tr>
		";		

# Count online users
$n = trim(`cd online; find *;`);
$z = explode("\n", $n);
$cnt = count($z);

$no = 1;

for($a = 0; $a < $cnt; $a++){
	$d = $z[$a];

	if($d == 'admin' or $d == '') continue;
	
	$html .= "<tr>
				<td align='center'>$no</td>
				<td align='center' style='padding: 8px;'>$d</td>
			</tr>
			";	

	$no++;
}

$html .= "	</table><br>
				<a href='$home'><button id='home'>Home</button></a>	
			";

echo $html;
?>

</body>
</html>