<?php

session_start();

if(!isset($_SESSION['register'])){
	exit();
}

// add file user in online and result
$loginname = $_SESSION['register'];
touch("online/$loginname");
touch("result/$loginname");

$str = '';

// find result
$result = trim(`cd result; find *;`);
$dir = "result/";

$n = explode("\n", $result);
$len = count($n);

// score
$smax = 0;
$smin = 0;
$sy = 0;

for ($i = 0; $i < $len; $i++){

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

	if ($p == $loginname)
		$sy = $s;
}

$str .= "<div id='score' style='font-size: 20px; font-weight: bold;'>
			Max : <div style='color: #4CAF50; display: inline'>$smax</div>, 
			Min : <div style='color: #f44336; display: inline'>$smin</div>, 
			Your Score : <div style='color: #2196F3; display: inline'>$sy</div>
		</div>";

unset($time_left);

if(file_exists('start')){
	$timenow = time();
	$end = file_get_contents('start');

	if($timenow <= $end){
	    $time_left = $end - $timenow; // find time left
	    $str .= "<div id='time-left' style='font-size: 20px; font-weight: bold; text-align: center; position: absolute; top: 10px; left: 100px;'>
				[ Time left = <div style='color: #f44336; display: inline;'>$time_left</div> ]
			</div>";

		$str .= getButton();
	}
}

// button for user click to get score
function getButton(){
	
	$id = $_SESSION["register"];
	$code = '';

	$p = range(1, 7);	// point
	shuffle($p);

	// color for button
	$c = array(	"#F44336", "#E91E63","#9C27B0", "#2196F3", "#3F51B5", 
				"#009688", "#FF9800", "#795548", "#607D8B", "#000000");
	shuffle($c);

	// create position for button
	$l = array();
	$min = 0;
	$max = 110;
	for ($i = 0; $i < 10; $i++) { 
		$l[$i] = rand($min, $max);
		$min = $l[$i] + 50;
		$max = $min + 110;
	}

	shuffle($l);
	
	// create button
	$rd = rand(3, 7);
	for($i = 0; $i < $rd; $i++){
		$a = $p[$i];
		$b = "background-color: $c[$i];";

		$pl = $l[$i]."px";
		$pos = "position: absolute; left: $pl; top: 55px;";

		$code .= "<button id='bnRace' onclick=\"sendMe('$id', $a)\" style='$b $pos'> $a </button>";
	}

	return $code;
}

echo $str;

?>