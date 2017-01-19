<?php

session_start();

if(!isset($_SESSION['register']) or $_SESSION['register'] != 'admin'){
	exit();
}

// clear and start
if(isset($_REQUEST['start'])){
	$timenow = time() + 3*60;
	file_put_contents('start', $timenow);
	// clear past data
	`cd online; rm *;cd ../result; rm *`;

	echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
	echo "location.href = 'index.php';\n";
	echo "</script>\n";
	exit();
}

$loginname = $_SESSION['register'];
touch("online/$loginname"); // for online keeping
$str = '';

## Count online users
$n = `cd online; find *;`;
$z = explode("\n", $n);
$cnt = count($z);
$on = '';

for($a = 0; isset($z[$a]); $a++){
	$d = $z[$a];

	if($d == 'admin' or $d == '') continue;
	$on .= ($cnt == 3 or $cnt == $a+2) ? "$d " : "$d, ";	
}


if($on != '') {
	$on = substr($on, 0, -1); 
	$str .= "<div style='font-size: 20px; font-weight: bold; '>User online are: 
				<div style='color: #4CAF50; display: inline;'>$on</div>
			</div>";
} else{
	$str .= "<div style='font-size: 20px; font-weight: bold; color: #f44336; '>No user online</div>";
}


## add start button
// clear expired start
unset($time_left);
if(file_exists('start')){
	$timenow = time();
	$end = file_get_contents('start');

	if($timenow > $end)	unlink('start');
	if($end > $timenow) $time_left = $end - $timenow;
}

// display time left
if(isset($time_left)){
	$str .= "<br><div style='font-size: 20px; font-weight: bold;'>
				[ Time left = <div style='color: #f44336; display: inline;'>$time_left</div> ]
			</div>";
}

$thislink = $_SERVER["PHP_SELF"]; // admin-get-data.php

if(!file_exists('start')){
	$str .= "<br><div><form action='$thislink'><button id='start' type='submit' name='start'>Start</button></form></div>";
}
	
echo "$str";

?>