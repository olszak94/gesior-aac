<?php
if(isset($_GET['txt']) && preg_match("/^([a-zA-Z\s])+$/", urldecode($_GET['txt'])))
{
	$text = urldecode($_GET['txt']);
	if( !file_exists('./cache/images/'. $text . '.png') )
	{
		$size = 18;
		$sizex = 280;
		$sizey = 28;
		$x = 4;
		$y = 20;
		$color = 'efcfa4';
		$red = (int)hexdec(substr($color,0,2));
		$green = (int)hexdec(substr($color,2,2));
		$blue = (int)hexdec(substr($color,4,2));
		$img = imagecreatetruecolor($sizex,$sizey);
		ImageColorTransparent($img, ImageColorAllocate($img,0,0,0));
		imagefttext($img, $size, 0, $x, $y, ImageColorAllocate($img,$red,$green,$blue), './images/headline.ttf', $text);
		imagepng($img, './cache/images/'. $text . '.png');	
		imagedestroy($img);
	}
	$picture = imagecreatefrompng('./cache/images/'. $text . '.png');
	header('Content-type: image/png');
	imagepng($picture);
}

?>
