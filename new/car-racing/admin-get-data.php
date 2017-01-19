<?php

session_start();

$server = $_SESSION['index'];

if(!isset($_SESSION['register']) or $_SESSION['register'] != 'admin'){
	exit();
}

// clear and start
if(isset($_REQUEST['start'])){
	$timenow = time() + 3*60;
	file_put_contents('start', $timenow);
	// clear past data
	`cd online; rm *;cd ../result; rm *`;

	//echo "<script language=\"JavaScript\" type=\"text/javascript\">\n";
	//echo "location.href = 'index.php';\n";
	//echo "</script>\n";
	header("Location: $server");    
	exit();
}

if (isset($_REQUEST['stop'])){
	unlink('start');

	header("Location: $server");    
	exit(); 
}

if (isset($_REQUEST['logout'])){

	unlink("online/".$_SESSION['register']);
	//unlink("result/".$_SESSION['register']);

	unset($_SESSION['register'], $_SESSION['fullname']);

	header("Location: $server");    
	exit(); 
}

$loginname = $_SESSION['register'];
touch("online/$loginname"); // for online keeping
$str = '';


# Score
$result = `cd result; find *;`;
$dir = "result/";

$n = explode("\n", $result);
$smax = 0;
$smin = 500;

for ($i = 0; isset($n[$i]); $i++) { 
	$p = $n[$i];
	$f = file_get_contents($dir.$p);
	$a = explode("\n", $f);
	$c = count($a);

	$s = 0;
	for ($j = 0; $j < $c; $j++) { 
		$s += $a[$j];
	}

	if ($s > $smax)
		$smax = $s;

	if ($s < $smin)
		$smin = $s;
}

$str .= "<div id='score' style='position: absolute; top: 10px; left: 600px; font-size: 20px; font-weight: bold;'>
			Max : <div style='color: #4CAF50; display: inline'>$smax</div>, 
			Min : <div style='color: #f44336; display: inline'>$smin</div>
		</div>";



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
	$str .= "<div style='font-size: 20px; font-weight: bold; display: inline;'>
				[ Time left = <div style='color: #f44336; display: inline;'>$time_left</div> ]
			</div>";
}



# Count online users
$n = `cd online; find *;`;
$z = explode("\n", $n);
$cnt = count($z);
$on = '';

for($a = 0; $a < $cnt; $a++){
	$d = $z[$a];

	if($d == 'admin' or $d == '') continue;
	$on .= ($cnt == 3 or $cnt == $a+3) ? "$d " : "$d, ";	
}

$pos = "position: absolute; top: 5px; left: 5px;";

if($on != '') {
	$on = substr($on, 0, -1); 
	$str .= "<div style='font-size: 16px; font-weight: bold; $pos width: 550px; background-color: #ddd;'>
				User online are: 
				<div style='color: #4CAF50; display: inline;'>$on</div>
			</div>";
} else{
	$str .= "<div style='font-size: 16px; font-weight: bold; color: #f44336; $pos'>No user online</div>";
}



# display	
echo "$str";

?>