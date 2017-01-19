<?php

session_start();

$code = '';
$result = '';
$dir = '';

$result = trim(`cd result; find *;`);
$dir = "result/";


$n = explode("\n", $result);

for ($i = 0; isset($n[$i]); $i++) { 
	$p = $n[$i];
	$f = file_get_contents($dir.$p);
	$a = explode("\n", $f);
	$c = count($a);

	$s = 0;
	for ($i = 0; $i < $c; $i++) { 
		$s += $a[$i];
	}

	$l = $s."px";
	$t = $i."px";
	
	if ($p != ""){
		$code .= "<div style='left: $l; top: $t; position: relative; font-weight: bold; font-size: 20px'>
					<img src='image/$p.png' id='image'/>$s</div>";
	}
}

echo $code;

?>