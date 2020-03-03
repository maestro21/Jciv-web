<?php

form([
    'cities_' => ['Cities file', 'file'],
], $ruleset);


$citiesSrc = 'rulesets/' . $ruleset['name'] . '/cities.png';

if(isImage($citiesSrc)) {
    
    $imageSize = getimagesize($citiesSrc);
    $tileSize = $ruleset['tileSize'];

    $rows = ceil($imageSize[1] / $tileSize);

    div('cities'); $i = 0;
    for($y = 0; $y < $rows; $y++) {
        div('row');
            div('cell');
                $pre = '[cities]';
                $values[$y] = $ruleset['cities'][$y] ?? '';
                form(
                  [
                      $y => ['Name'],
                  ],
                    $values,
                    $pre
                );
            e('div');
            div('cell');
                drawTile($citiesSrc,  $imageSize[0], $tileSize, 0, $y);
            e('div');
        e('div');
    }
    e('div');

    
    
    
    
    
    
    
    
    
    
}