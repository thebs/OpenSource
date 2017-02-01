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

$home = $_SESSION['index'];

// make pass dir if not exists
if(!is_dir('pass')) {
	// keep register user and password
	`mkdir pass;chmod 700 pass`;
	`echo 'deny from all' > pass/.htaccess`;
}

if(!is_dir('online')) {
	// keep online status
	`mkdir online;chmod 700 online`;
	`echo 'deny from all' > online/.htaccess`;
}

if(!is_dir('result')) {
	// keep selection result
	`mkdir result;chmod 700 result`;
	`echo 'deny from all' > result/.htaccess`;
}

if(!is_dir('image')) {
	// keep selection image
	`mkdir image;chmod 700 image`;
	`echo 'deny from all' > image/.htaccess`;
}


// admin if not exists
if(!file_exists('pass/admin.php')){
	if(isset($user)) unset($user);
	// add admin with pass = admin
	$p = md5('admin');
	$str = "<?php\n\$fullname = 'Suphakrit Nakhabat';\n\$pass = '$p';\n?>";
	file_put_contents('pass/admin.php', $str);
}

// register 
if(isset($_REQUEST['username']) and isset($_REQUEST['password']) and isset($_REQUEST['register'])){

	if(isset($_SESSION['register'])) unset($_SESSION['register']);

	// take submitted data
	$u = trim($_REQUEST['username']);
	$fullname = trim($_REQUEST['name']);
	$p = trim($_REQUEST['password']);

	if($u == '' or $p == '' or $fullname == '') {
		//if empty do nothing
		if(isset($_SESSION['register'])) unset($_SESSION['register']);
		if(isset($_REQUEST['username'])) unset($_REQUEST['username']);
		if(isset($_REQUEST['fullname'])) unset($_REQUEST['fullname']);
		if(isset($_REQUEST['password'])) unset($_REQUEST['password']);
	}else{
		if(isset($user)) unset($user);
	    $filename = 'pass/'.$u.'.php';
		if(!file_exists($filename)){
			// add new user
			$p = md5($p);
			$str = "<?php\n\$fullname = '$fullname';\n\$pass = '$p';\n?>";
			file_put_contents($filename, $str);
			$_SESSION['register'] = $u;
			$_SESSION['fullname'] = $fullname;
			include 'image.php';
		}else{            
			include($filename);
			if($pass != md5($p)){
				// not same pass
				echo "<font color=red>Name: $u exists.</font><br>";
				echo "If you try to register,choose a new name.<br>";
				echo "If you try to login,give new password.<br>";
				echo "<a href='$server'>Go back</a>";
				exit();
			}else{				
				$_SESSION['register'] = $u;
				$_SESSION['fullname'] = $fullname;
				include 'image.php';
			}
		}
	}
}

// login
if(isset($_REQUEST['username']) and isset($_REQUEST['password']) and isset($_REQUEST['login'])){

	unset($_SESSION['register'], $_SESSION['fullname']);

	if(isset($_SESSION['login'])) unset($_SESSION['login']);

	// take submitted data
	$u = trim($_REQUEST['username']);
	$p = trim($_REQUEST['password']);

	// username or password empty
	if($u == '' or $p == '') {

		$html = "<div align='center' style='margin-top: 40px;'>
					<div style='font-size: 25px; font-weight: bold; color: #f44336'>
						Username or Passwors invalid.
					</div><br>
					<div style='font-size: 16px;'>
						If you try to register, choose a new username.<br>
						If you try to login, give new password.<br>
					</div><br>
					<a href='$home'>
						<button id='home'>Back</button></a>
				</div>";

		echo $html;
		echo "<script>window.alert('Username or Passwors invalid.')</script>";

		//if empty do nothing
		if(isset($_SESSION['register'])) unset($_SESSION['register']);
		if(isset($_REQUEST['username'])) unset($_REQUEST['username']);
		if(isset($_REQUEST['fullname'])) unset($_REQUEST['fullname']);
		if(isset($_REQUEST['password'])) unset($_REQUEST['password']);

		exit();

	}else{
        $filename = 'pass/'.$u.'.php';
		if(!file_exists($filename)){

			$html = "<div align='center' style='margin-top: 40px;'>
						<div style='font-size: 25px; font-weight: bold; color: #f44336'>
							Username: $u does not exist.
						</div><br>
						<div style='font-size: 16px;'>
							If you try to register, choose a new username.<br>
						</div><br>
						<a href='$home'>
							<button id='home'>Back</button></a>
					</div>";

			echo $html;
			echo "<script>window.alert('Username does not exists')</script>";
				
			if(isset($_SESSION['register'])) unset($_SESSION['register']);
			if(isset($_REQUEST['username'])) unset($_REQUEST['username']);
			if(isset($_REQUEST['fullname'])) unset($_REQUEST['fullname']);
			if(isset($_REQUEST['password'])) unset($_REQUEST['password']);

			exit();

		}else{            
			include($filename);
			if($pass == ''){

				$html = "<div align='center' style='margin-top: 40px;'>
							<div style='font-size: 25px; font-weight: bold; color: #4CAF50'>
								New password for username: $u has set to $p
							</div><br><br>
							<a href='$home'>
								<button id='home'>Continue</button></a>
						</div>";

				echo $html;

				$_SESSION['register'] = $u;
				$_SESSION['fullname'] = $fullname;
				// write new pass to file
				$loginname = $u;
				$pass = md5($p);
				$str = "<?php\n\$fullname = '$fullname';\n\$pass = '$pass';\n?>";
				file_put_contents($filename, $str);        

				exit();

			}elseif($pass != md5($p)){
				// not same pass

				$html = "<div align='center' style='margin-top: 40px;'>
							<div style='font-size: 25px; font-weight: bold; color: #f44336'>
								Username: $u exists.
							</div><br>
							<div style='font-size: 16px;'>
								If you try to register, choose a new username.<br>
								If you try to login, give new password.<br>
							</div><br>
							<a href='$home'>
								<button id='home'>Back</button></a>
						</div>";

				echo $html;
				echo "<script>window.alert('Invalid password. Please try again.')</script>";

				exit();

			}else{				
				$_SESSION['register'] = $u;
				$_SESSION['fullname'] = $fullname;
				include 'image.php';
			}
		}
	}
}

$server = $_SESSION['index'];
header("Location: $server");    
exit(); 

?>

</body>
</html>