<?php

session_start();

$code = '';

# getresult
$result = `cd result; find *;`;
$dir = "result/";

$n = explode("\n", $result);

for ($i = 0; isset($n[$i]); $i++) { 
	$p = $n[$i];
	$f = file_get_contents($dir.$p);
	$a = explode("\n", $f);
	$c = count($a);

	$s = 0;	// score
	for ($j = 0; $j < $c; $j++) { 
		$s += $a[$j];
	}

	$l = $s."px";
	$t = "0px";
	
	// image car
	if ($p != ""){
		$code .= "<div style='left: $l; top: $t; position: relative; font-weight: bold; font-size: 20px'>
					<img src='image/$p.png' id='image'/>$s</div>";
	}
}

// display
echo $code;

?>