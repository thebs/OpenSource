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
$page = "manage.php";

// take new edit user data
if(isset($_REQUEST['edit_data']) and isset($_SESSION['register']) and $_SESSION['register'] == 'admin' ){

    $loginname = trim($_REQUEST['username']);
	$fname = 'pass/'.$loginname.'.php';
    $newname = trim($_REQUEST['name']);

	if(file_exists($fname) and $newname != ''){
		include($fname);
		$str = "<?php\n\$fullname = '$newname';\n\$pass = '$pass';\n?>";
		file_put_contents($fname, $str);      

		$html = "<div align='center' style='margin-top: 40px;'>
					<div style='font-size: 25px; font-weight: bold; color: #4CAF50'>
						Full name for User: $loginname is changed.
					</div><br>
					<a href='$page?list'>
						<button id='home'>Back</button></a>
				</div>";


		echo $html;

		exit();
	}else{
		$_REQUEST['edit'] = 'y';
	}
}

// edit user data
if(isset($_REQUEST['edit']) and isset($_SESSION['register']) and $_SESSION['register'] == 'admin' ){

        $loginname = trim($_REQUEST['username']);
		$fname = 'pass/'.$loginname.'.php';

        include($fname);
        // gen form to edit
        include 'edit.php';

        exit();
}

// clear user password
if(isset($_REQUEST['clear']) and isset($_SESSION['register']) and $_SESSION['register']=='admin' ){
        $loginname = trim($_REQUEST['username']);
		$fname = 'pass/'.$loginname.'.php';

        include($fname);

		$str = "<?php\n\$fullname = '$fullname';\n\$pass = '';\n?>";
		file_put_contents($fname,$str);        

		$html = "<div align='center' style='margin-top: 40px;'>
					<div style='font-size: 25px; font-weight: bold; color: #4CAF50'>
						Password for User: $loginname $fullname is clear.
					</div><br>
					<a href='$page?list'>
						<button id='home'>Back</button></a>
				</div>";


		echo $html;

		exit();
}

//delete user
if(isset($_REQUEST['delete']) and isset($_SESSION['register']) and $_SESSION['register']=='admin' ){

        $loginname = trim($_REQUEST['username']);
		$fname = 'pass/'.$loginname.'.php';

        include($fname);

        $html = "<div align='center' style='margin-top: 40px;'>
					<div style='font-size: 25px; font-weight: bold; color: #4CAF50'>
						User: $loginname $fullname is deleted.<br>
					</div><br>
					<a href='$page?list'>
						<button id='home'>Back</button></a>
				</div>";


		echo $html;

        unlink($fname);

        exit();
}

// listing all users
if(isset($_SESSION['register']) and $_SESSION['register']=='admin' and isset($_SESSION['list'])){

		// Dispaly all user names
		$html = "<div align='center'><div style='font-size: 20px; font-weight: bold; margin-top: 20px;'>All User Register</div><br>
					<table id='tb' border='1' align='center'>
						<tr>
							<th>No.</th>
							<th>Username</th>
							<th>Fullname</th>
							<th>Edit</th>
							<th>Clear</th>
							<th>Delete</th>
						</tr>
				";

		$n = `cd pass;ls -1 | sed 's/.php//g'`;		
		$user = explode("\n", $n);
		$cnt = count($user);

		for($x = 0; isset($user[$x]); $x++){
			$loginname = trim($user[$x]);

			if($loginname == '') continue;

			$fname = 'pass/'.$loginname.'.php';
			include($fname);

			$no = $x + 1;

			$edit = "<a href='$page?edit=y&username=$loginname'>
							<button id='logout'>Edit</button>
						</a>";
			$clear = "<a href='$page?clear=y&username=$loginname'>
						<button id='clear'>Clear</button>
					</a>";
			$delete = "<a href='$page?delete=y&username=$loginname'>
						<button id='stop'>Delete</button>
					</a>";

			$html .= "<tr>
						<td align='center'>$no</td>
						<td style='padding: 8px;'>$loginname</td>
						<td style='padding: 8px;'>$fullname</td>
						<td align='center'>$edit</td>
						<td align='center'>$clear</td>
					";

			if($loginname != 'admin'){
				$html .= "<td align='center'>$delete</td>";
			}else{
				$html .= "<td></td>";			
			}

			$html .= "</tr>";
		}

		$html .= "	</table><br>
					<a href='$home'><button id='home'>Home</button></a>	
				";

		echo $html;

		exit();
}

?>

</body>
</html>