<?php

header ("Content-type: image/png");

$im = imagecreatetruecolor(50, 50);
$black = imagecolorallocate($im, 0, 0, 0);
$black2 = imagecolorallocate($im, 1, 1, 1);
$white = imagecolorallocate($im, 255, 255, 255);

$color = getColor($im);

$point = array(	25, 20,
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

imagecolortransparent($im, $black);

imagestring($im, 2, 3, 5, $u, $black2);

imagepng($im, "image/$u.png");
imagedestroy ($im);

function getColor($pic){
	do{
		$x = rand(0, 255);
		$y = rand(0, 255);
		$z = rand(0, 255);
	}
	while($x == 255 and $y == 255 and $z == 255);

	return imagecolorallocate($pic, $x, $y, $z);
}

?>