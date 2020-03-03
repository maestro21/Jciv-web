<?php



$flags = dir_list('flags/src/large/');
$flagsPerRow = 30;
$flagSizeX = 44;
$flagSizeY = 30; 

$flagRows = ceil(count($flags) / $flagsPerRow);
$imout = imagecreatetruecolor($flagsPerRow * $flagSizeX, $flagRows * $flagSizeY);
imagesavealpha( $imout, true );
imagefill( $imout, 0, 0, imagecolorallocatealpha( $imout, 0, 0, 0, 127 ) );

foreach($flags as $k => $flag) {
    $y = floor($k / $flagsPerRow);
    $x = $k % $flagsPerRow;

    $imflag = imagecreatefrompng('flags/src/large/' . $flag);
    $flags[$k] = explode('.', $flag)[0];

    $_offsetx = $x * $flagSizeX;
    $_offsety = $y * $flagSizeY;

    imagecopyresampled($imout, $imflag, $_offsetx, $_offsety, 0, 0, $flagSizeX, $flagSizeY, $flagSizeX, $flagSizeY);

}

imagepng($imout, 'flags/flags.png'); ?>

<img src="flags/flags.png">



