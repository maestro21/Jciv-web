<?php
  form([
     'terrain_' => [ 'Terrain file', 'file'],
     'terrainTileSize' => [ 'Terrain tile size'],
    // 'terrainTilesPerRow' =>  [ 'Tiles per row'],
  ], $ruleset);
?>

<?php
$terrainSrc = 'rulesets/' . $ruleset['name'] . '/terrain.png';
echo $terrainSrc;
if(isImage($terrainSrc)) { echo 'ok';
    
    $imageSize = getimagesize($terrainSrc);
    $tileSize = $ruleset['terrainTileSize'];

    $rows = ceil($imageSize[0] / $tileSize);
    $cols = ceil( $imageSize[1] / $tileSize);

  $typeOptions = [
      '' => '-none-',
    'water' => 'Water',
    'coast' => 'Coast',
    'terrain' => 'Terrain',
    'top' => 'Top terrain'
  ];

    div('terrain'); $i = 0;
    for($y = 0; $y < $cols; $y++) {
        for($x = 0; $x < $rows; $x++) {
            div('cell');
                drawTile($terrainSrc, $tileSize, $tileSize, $x, $y);
                $pre = '[terrain][' .$i . ']';
                $values = $ruleset['terrain'][$i] ?? [];
                $values['row'] = $y;
                $values['col'] = $x;


                form(
                  [
                    'col' => [ 'X', 'hidden'],
                    'row' => [ 'Y', 'hidden'],
                    'name' => ['Name'],
                    'symbol' => ['Symbol'],
                    'color' => ['Color', 'color'],
                    'type' => ['Type', 'select', TerrainType::getOptions()],
                  ],
                    $values,
                    $pre
                );


                $i++;
            e('div');
        }
    }
    e('div');
    
    
    
    
    
    
    
    
    
    
}