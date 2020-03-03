<?php

/***

Generates map from screenshot

***/
/*
$MAPNAME = 'bigmap3';
$RULESET = 'ruleset1';

$rulesetpath = '../' . $RULESET . '/ruleset.php';

if(!file_exists($rulesetpath)) {
	die('ruleset '.$rulesetpath.' dont exist');
}
include($rulesetpath);


generateMap($MAPNAME, $ruleset);

$mapsize = [];

function generateMap($mapname,$ruleset) {
	global $mapsize;
	$path = 'maps/' . $mapname . '/' . $mapname .'.png';
	if(!file_exists($path)) return;

	$map = [
		'RulesetTerrain' => createTerrainFromImage($path)
	];
	$map['size'] = $mapsize;
	echo 'map ' . $mapname . ' generated';

	// river
	$path = 'maps/' . $mapname . '_river.png';
	if(file_exists($path)) {
		$map['rivers'] = createRiversFromImage($path);
		echo 'rivers for map ' . $mapname . ' generated';
	}

	$filename = '../maps/' . $mapname . '.php';
	file_put_contents($filename, '<?php $data = ' . var_export($map, TRUE) . ";" );
}*/


function getTerrainTypes() {
	global $ruleset;
	foreach ($ruleset['terrain'] as $t) {
		$terrain[$t['symbol']] = $t['color'];
	}
	return $terrain;

}


function createTerrainFromImage($fpath) {
	global $mapsize;
	if(!file_exists($fpath)) die('map ' . $fpath . ' dont exist');

	$tiles = array();

	/** loading image **/
	$size = getimagesize($fpath); 
	if(!$size) return FALSE;
	$sizex = $size[0] - 1;
	$sizey = $size[1] - 1;
	
	switch($size['mime']) {
		case 'image/png': $img = imagecreatefrompng($fpath); break;
		case 'image/gif': $img = imagecreatefromgif($fpath); break;
		case 'image/jpeg': $img = imagecreatefromjpeg($fpath); break;
	}
	$x = $size[0];
	$y = $size[1]; $i=0;
	$mapsize = [ 'x' => $x, 'y' => $y];
	
	for($j = 0; $j < $y; $j++) {
		$tiles[$j] = '';
		for($i = 0 ; $i < $x; $i++) {
			$tilex = $i;	
			$rgb = imagecolorat($img, $i, $j); 
			$cols = imagecolorsforindex($img, $rgb);
			$r = $cols['red'];
			$g = $cols['green'];
			$b = $cols['blue'];
			$rgb = array($r,$g,$b);
			$_tile = findClosestTerrain($rgb); //die($_tile);
			$tiles[$j] .= $_tile;
		}
	} print_r($tiles);
	return $tiles;
}

function findClosestTerrain($rgb) {
	$diff = 255 * 3;
	$terrain = ' ';		
	$terr =  getTerrainTypes(); 
	foreach($terr as  $char => $color) {
	    if(empty($color)) continue;
		$trgb = explode(',', $color);//sscanf($color, "%02x%02x%02x");
		$r = abs($rgb[0] - @$trgb[0]);
		$g = abs($rgb[1] - @$trgb[1]);
		$b = abs($rgb[2] - @$trgb[2]);
		$_diff = $r + $g + $b;
		if($_diff < $diff) {
			$diff = $_diff;
			$terrain = $char;
			//$terrain = checkForrest($terrain);
		}
	} 
	return $terrain;
}

function createRiversFromImage($fpath) {
	if(!file_exists($fpath)) {
		echo 'rivers file ' . $fpath . ' dont exist';
	}
	$size = getimagesize($fpath);
	if(!$size) return false;

	switch($size['mime']) {
		case 'image/png': $img = imagecreatefrompng($fpath); break;
		case 'image/gif': $img = imagecreatefromgif($fpath); break;
		case 'image/jpeg': $img = imagecreatefromjpeg($fpath); break;
	}
	$x = $size[0] - 1;
	$y = $size[1] -1; $i=0;
	$tiles = [];
	for($j = 0; $j < $y; $j++) {
		$tiles[$j] = '';
		for($i = 0 ; $i < $x; $i++) {
			$rgb = @imagecolorat($img, $i, $j); 
			$cols = imagecolorsforindex($img, $rgb);
			$alpha = $cols['alpha'];
			$tiles[$j].= ($alpha < 50 ? 'r' : ' ');
		}
	}
	return $tiles;	
}

function rnd($array) { //print_r($array);
	return $array[rand(0, count($array)-1)];
}

function yes($n = 1) { //return true;
	return $n == rand(0,$n);
}

function checkForrest($tile) {
	global $ruleset;
	if(isset($ruleset['forrest'][$tile])) {
		if(yes($ruleset['forrest'][$tile])) {
			return 'f';
		}
	}
	return $tile;
}

function generateTile($ter) {
	$tile = array();
	
	$tile['RulesetTerrain'] = $ter;
	
	if(!in_array($ter, array('water','swamp'))) {
		/** roads **/
		if(yes()) $tile['road'] = 'road';
		
		/** mine **/
		$mineTiles = array('hills', 'mountains');
		if(in_array($ter, $mineTiles)) {	
			if(yes()) $tile['mine'] = true;
		}
		/** farm **/
		$farmTiles = array('grassland', 'plains', 'floodplains');
		if(in_array($ter, $farmTiles) && yes()) $tile['land'] = 'farm';
		
		/** forrest **/
		$forrestTiles = array('grassland' => 4,  'taiga' =>2);
		if(isset($forrestTiles[$ter]) && yes($forrestTiles[$ter])) {
			$tile['RulesetTerrain'] = 'forrest';
		}
	}
	return $tile;
}




