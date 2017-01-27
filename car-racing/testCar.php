<?php

$n = `cd online; find *`;
$an = explode("\n", $n);
$cn = count($an);

for ($i = 0; $i < $cn; $i++) { 

	header ("Content-type: image/png");

	$im = imagecreatetruecolor(50, 50);
	$black = imagecolorallocate($im, 0, 0, 0);
	$black2 = imagecolorallocate($im, 1, 1, 1);
	$white = imagecolorallocate($im, 255, 255, 255);

	$color = getColor($im);

	

/*
	// Right
	imageline($im, 50, 40, 60, 42, $color);
	imageline($im, 60, 42, 70, 60, $color);
	imageline($im, 70, 60, 90, 65, $color);
	imageline($im, 90, 65, 95, 75, $color);
	imageline($im, 95, 75, 98, 76, $color);
	imageline($im, 98, 76, 98, 85, $color);
	imageline($im, 88, 85, 98, 85, $color);

	// Left
	imageline($im, 50, 40, 30, 42, $color);
	imageline($im, 30, 42, 10, 60, $color);
	imageline($im, 30, 42, 10, 60, $color);
	imageline($im, 10, 60, 3, 63, $color);
	imageline($im, 3, 63, 3, 75, $color);
	imageline($im, 3, 75, 0, 76, $color);
	imageline($im, 0, 76, 0, 85, $color);
	imageline($im, 0, 85, 10, 85, $color);
*/	

	$point = array(
				25, 20,
				30, 21,
				35, 30,
				45, 33,
				48, 38,
				49, 38,
				49, 43,
				0, 43,
				0, 38,
				2, 38,
				2, 32,
				5, 30,
				15, 21
				);


	imagepolygon($im, $point, 13, $color);
	imagefilledpolygon($im, $point, 13, $color);


	// back
	imagearc($im, 10, 40, 10, 10, 0, 360, $color);
	imagefilledarc($im, 10, 40, 10, 10, 0, 360, $black2, IMG_ARC_PIE);

	// font
	imagearc($im, 40, 40, 10, 10, 0, 360, $color);
	imagefilledarc($im, 40, 40, 10, 10, 0, 360, $black2, IMG_ARC_PIE);

	//imageline($im, 14, 43, 36, 43, $black2);

	imagecolortransparent($im, $black);

	imagestring($im, 2, 3, 5, $an[$i], $black2);

	imagepng($im, "image/$an[$i].png");
	//imagepng($im);
	imagedestroy ($im);
}

function getColor($pic){
	do{
		$x = rand(0, 255);
		$y = rand(0, 255);
		$z = rand(0, 255);
	}
	while($x == 255 and $y == 255 and $z == 255);

	return imagecolorallocate($pic, $x, $y, $z);
}


/*

header ("Content-type: image/png");

	$im = imagecreatetruecolor(100, 100);
	$black = imagecolorallocate($im, 0, 0, 0);
	$black2 = imagecolorallocate($im, 1, 1, 1);
	$white = imagecolorallocate($im, 255, 255, 255);

	$color = getColor($im);

	// back
	imagearc($im, 20, 80, 20, 20, 0, 360, $color);
	imagefilledarc($im, 20, 80, 20, 20, 0, 360, $color, IMG_ARC_PIE);

	// font
	imagearc($im, 80, 80, 20, 20, 0, 360, $color);
	imagefilledarc($im, 80, 80, 20, 20, 0, 360, $color, IMG_ARC_PIE);

	imageline($im, 28, 85, 72, 85, $color);

	// Right
	imageline($im, 50, 40, 60, 42, $color);
	imageline($im, 60, 42, 70, 60, $color);
	imageline($im, 70, 60, 90, 65, $color);
	imageline($im, 90, 65, 95, 75, $color);
	imageline($im, 95, 75, 98, 76, $color);
	imageline($im, 98, 76, 98, 85, $color);
	imageline($im, 88, 85, 98, 85, $color);

	// Left
	imageline($im, 50, 40, 30, 42, $color);
	imageline($im, 30, 42, 10, 60, $color);
	imageline($im, 30, 42, 10, 60, $color);
	imageline($im, 10, 60, 3, 63, $color);
	imageline($im, 3, 63, 3, 75, $color);
	imageline($im, 3, 75, 0, 76, $color);
	imageline($im, 0, 76, 0, 85, $color);
	imageline($im, 0, 85, 10, 85, $color);

	$point = array(
				50, 40,
				60, 42,
				70, 60,
				90, 65,
				95, 75,
				98, 76,
				98, 85,
				0, 85,
				0, 76,
				3, 75,
				3, 63,
				10, 60,
				30, 42
				);



	imagefilledpolygon($im, $point, 13, $color);
	imagecolortransparent($im, $black);

	imagestring($im, 5, 10, 20, $an[$i], $color);
	//imagestring($im, 5, 70, 45, "100", $color);

	imagepng($im, "image/$an[$i].png");
	//imagepng($im);
	imagedestroy ($im);

*/

?>