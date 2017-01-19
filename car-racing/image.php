<?php

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

imagestring($im, 5, 10, 20, $u, $color);
//imagestring($im, 5, 70, 45, "100", $color);

imagepng($im, "image/$u.png");
//imagepng($im);
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