<?php

form([
    'units_' => ['Units file', 'file'],
], $ruleset);


$unitsSrc = 'rulesets/' . $ruleset['name'] . '/units.png';

if(isImage($unitsSrc)) {
    
    $imageSize = getimagesize($unitsSrc);
    $tileSize = $ruleset['tileSize'];

    $rows = ceil($imageSize[0] / $tileSize);
    $cols = ceil( $imageSize[1] / $tileSize);

    div('units'); $i = 0;
    for($y = 0; $y < $cols; $y++) {
        for($x = 0; $x < $rows; $x++) {
            div('cell');
                drawTile($unitsSrc, $tileSize, $tileSize, $x, $y);
                $pre = '[units][' .$i . ']';
                $values = $ruleset['units'][$i] ?? [];
                $values['row'] = $y;
                $values['col'] = $x;


                form(
                  [
                    'col' => [ 'X', 'hidden'],
                    'row' => [ 'Y', 'hidden'],
                    'key' => ['Key'],
                    'name' => ['Name'],
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