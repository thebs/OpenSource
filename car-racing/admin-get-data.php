<?php

session_start();

$server = $_SESSION['index'];

if(!isset($_SESSION['register']) or $_SESSION['register'] != 'admin'){
	exit();
}

$bn = "";

// clear and start
if(isset($_REQUEST['start'])){

	$timenow = time() + 3*60;
	file_put_contents('start', $timenow);
	// clear past data
	`cd online; rm *; cd ../result; rm *`;

	header("Location: $server");    
	exit();
}

// click stop
if (isset($_REQUEST['stop'])){
	unlink('start');
	header("Location: $server");    
	exit(); 
}

// logout
if (isset($_REQUEST['logout'])){
	unlink("online/".$_SESSION['register']);
	unset($_SESSION['register'], $_SESSION['fullname']);

	header("Location: $server");    
	exit(); 
}


$loginname = $_SESSION['register'];
touch("online/$loginname"); // for online keeping
$str = '';

# Score
$result = trim(`cd result; find *;`);
$dir = "result/";

$n = explode("\n", $result);
$smax = 0;
$smin = 0;

for ($i = 0; isset($n[$i]); $i++) { 
	$p = $n[$i];

	if ($p == '')	continue;

	$f = file_get_contents($dir.$p);
	$a = explode("\n", $f);
	$c = count($a);
	$s = 0;

	for ($j = 0; $j < $c; $j++) { 
		$s += $a[$j];
	}

	if ($s > $smax)
		$smax = $s;

	if ($i == 0)
		$smin = $s;

	if ($s < $smin)
		$smin = $s;
}


$tm = '';

// clear expired start
unset($time_left);
if(file_exists('start')){
	$timenow = time();
	$end = file_get_contents('start');

	if($timenow > $end)	unlink('start');
	if($end > $timenow) $time_left = $end - $timenow;

	// display time left
	if(isset($time_left)){
		$tm .= "<div style='font-size: 20px; font-weight: bold; display: inline;'>
					[ Time left = <div style='color: #f44336; display: inline;'>$time_left</div> ]
				</div>";
	}

	// stop button
	$bn .= "<form action='admin-get-data.php'>
				<button id='stop' type='submit' name='stop'>Stop</button>
			</form>";
}else{
	// start button
	$bn .= "<form action='admin-get-data.php'>
				<button id='start' type='submit' name='start'>Start</button>
			</form>";
}

// score max, min, time left and button
$str .= "<div id='score' style='font-size: 20px; font-weight: bold;'>
			Max : <div style='color: #4CAF50; display: inline'>$smax</div>, 
			Min : <div style='color: #f44336; display: inline'>$smin</div>
			$tm
		</div>".$bn;


# Count online users
$n = trim(`cd online; find *;`);
$z = explode("\n", $n);
$cnt = count($z) - 1;

$pos = "position: absolute; top: 5px; left: 5px;";
 
$str .= "<a href='user-online.php'>
			<div style='font-size: 16px; font-weight: bold; $pos width: 200px; background-color: #ddd;'>
				User online are : 
				<div style='color: #4CAF50; display: inline;'>$cnt</div>
			</div></a>";

# display	
echo "$str";

?>