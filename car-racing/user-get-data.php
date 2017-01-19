<?php

session_start();

if(!isset($_SESSION['register'])){
	exit();
}

$loginname = $_SESSION['register'];
touch("online/$loginname");
touch("result/$loginname");


unset($time_left);
$str = '';

if(file_exists('start')){
	$timenow = time();
	$end = file_get_contents('start');

	if($timenow <= $end){
	    $time_left = $end - $timenow; // find time left
	    $str .= "<div style='font-size: 20px; font-weight: bold; text-align: center; position: absolute; top: 10px; left: 600px;'>
				[ Time left = <div style='color: #f44336; display: inline;'>$time_left</div> ]
			</div>";
		//$str = '';
		$str .= getButton();
	}
}

function getButton(){
	
	$id = $_SESSION["register"];

	$code = "<div id='randomScreen'>";

	$p = array(1, 3, 5);

	$r = "background-color: #f44336;";
	$g = "background-color: #4CAF50;";
	$b = "background-color: #008CBA;";
	
	$c = array($r, $g, $b);
	$rg = range(0, 2);

	$c2 = 4;
	$h2 = 1000;

	for($i = 0; $i < 3; $i++){

		if ($i == 0){
			$rd = rand(0, 2);
			$c1 = $rd;

			$rH = rand(0, 550);
			$h1 = $rH;
		}
		else{

			do{
				$rd = rand(0, 2);
			}while($c1 == $rd or $c2 == $rd);
			$c2 = $rd;

			do{
				$rH = rand(0, 550);
			}while( ( $rH > ($h1-50) and $rH < ($h1+50) ) or ( $rH > ($h2-50) and $rH < ($h2+50) ) );
			$h2 = $rH;
		}
	
		$rH .= "px";
		$rW = rand(0, 800)."px";
		$a = $p[$i];

		$code .= "<button id='bnRace' onclick=\"sendMe('$id', $a)\" 
					style='margin: 5px; top: $rH; left: $rW; position: relative; $c[$rd]'>
					 $a </button>";
	}

	$code .= "</div>";

	return $code;
}

// displat time left
/*if(isset($time_left)){
$str .= "<div style='font-size: 20px; font-weight: bold; text-align: center;'>
				[ Time left = <div style='color: #f44336; display: inline;'>$time_left</div> ]
			</div>";
}*/

echo $str;

?>