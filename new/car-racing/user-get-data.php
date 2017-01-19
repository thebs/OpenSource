<?php

session_start();

if(!isset($_SESSION['register'])){
	exit();
}

$loginname = $_SESSION['register'];
touch("online/$loginname");
touch("result/$loginname");

$str = '';


$result = `cd result; find *;`;
$dir = "result/";

$n = explode("\n", $result);
$smax = 0;
$smin = 500;
$sy = 0;

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

	if ($p == $loginname)
		$sy = $s;
}

$str .= "<div id='score' style='position: absolute; top: 10px; left: 550px; font-size: 20px; font-weight: bold;'>
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
		//$str = '';
		$str .= getButton2();
	}
}

function getButton(){
	
	$id = $_SESSION["register"];

	$code = "<div id='randomScreen'>";

	$p = range(1, 10);
	shuffle($p);

	$c = array(	"#F44336", "#E91E63","#9C27B0", "#2196F3", "#3F51B5", 
				"#009688", "#FF9800", "#795548", "#607D8B", "#000000");
	shuffle($c);

	$l = array( rand(0, 70), rand(120, 170), rand(220, 270), rand(320, 370), rand(420, 470), 
				rand(520, 570), rand(620, 670), rand(720, 770), rand(820, 870), rand(920, 970));
	shuffle($l);

	$rd = rand(3, 10);
	for($i = 0; $i < $rd; $i++){
		$a = $p[$i];
		$b = "background-color: $c[$i];";

		$pl = $l[$i]."px";
		$pos = "position: relative; left: $pl; top: 5px;";

		$code .= "<button id='bnRace' onclick=\"sendMe('$id', $a)\" style='$b $pos'> $a </button>";
	}

	$code .= "</div>";

	return $code;
}

function getButton2(){
	
	$id = $_SESSION["register"];
	$code = "<div id='randomScreen'>";

	$p = range(1, 10);
	shuffle($p);

	$c = array(	"#F44336", "#E91E63","#9C27B0", "#2196F3", "#3F51B5", 
				"#009688", "#FF9800", "#795548", "#607D8B", "#000000");
	shuffle($c);

	//$l = array( rand(0, 80), rand(80, 160), rand(160, 240), rand(240, 320), rand(320, 400), 
	//			rand(400, 480), rand(480, 560), rand(560, 640), rand(640, 720), rand(720, 800));
	
	$l = array();
	$min = 0;
	$max = 110;
	for ($i = 0; $i < 10; $i++) { 
		$l[$i] = rand($min, $max);
		$min = $l[$i] + 50;
		$max = $min + 110;
	}

	shuffle($l);
	

	$rd = rand(3, 10);
	for($i = 0; $i < $rd; $i++){
		$a = $p[$i];
		$b = "background-color: $c[$i];";

		$pl = $l[$i]."px";
		$pos = "position: absolute; left: $pl; top: 55px;";

		$code .= "<button id='bnRace' onclick=\"sendMe('$id', $a)\" style='$b $pos'> $a </button>";
	}
	$code .= "</div>";

	return $code;
}

echo $str;

?>