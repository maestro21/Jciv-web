<?php
require_once('../www/enums.php');


$data = [
    'title' => 'Default Ruleset',
    'name' => 'default',
    'tileSize' => 64,
    'terrainTileSize' => 96
];


/***********
 * TERRAIN *
 **********/
/** id => name,  symbol, color, movement, defMod, food, prod, trade */
$data['terrain'] = [

    [
        'name' => 'Coast',
        'symbol' => '',
        'type' => TerrainType::COAST,
    ],

    [
        'name' => 'Floodplains',
        'symbol' => 'l',
        'color' => '255,0,255',
        'movement' => 1,
        'defense' => 1,
        'food' => 3,
        'prod' => 0,
        'trade' => 0,
        'type' =>  TerrainType::LAND,
    ],
    [
        'name' => 'Grassland',
        'symbol' => 'g',
        'color' => '0,136, 0',
        'movement' => 1,
        'defense' => 1,
        'food' => 2,
        'prod' => 0,
        'trade' => 0,
        'type' =>  TerrainType::LAND,
    ],
    [
        'name' => 'Desert',
        'symbol' => 'd',
        'color' => '255,255,0',
        'movement' => 1,
        'defense' => 1,
        'food' => 0,
        'prod' => 0,
        'trade' => 0,
        'type' => TerrainType::LAND,
    ],
    [
        'name' => 'Swamp',
        'symbol' => 'a',
        'color' => '0,0,0',
        'movement' => 3,
        'defense' => 1,
        'food' => 0,
        'prod' => 0,
        'trade' => 0,
        'type' =>  TerrainType::LAND,
    ],
    [
        'name' => 'Plains',
        'symbol' => 'p',
        'color' => '248,178,52',
        'movement' => 3,
        'defense' => 1,
        'food' => 0,
        'prod' => 0,
        'trade' => 0,
        'type' => 'land',
        'type' =>  TerrainType::LAND,
    ],
    [],
    [
        'name' => 'Water',
        'symbol' => '.',
        'color' => '0,0,255',
        'movement' => 1,
        'defense' => 1,
        'food' => 1,
        'prod' => 0 ,
        'trade' => 1,
        'type' =>  TerrainType::WATER,
    ],
    [
        'name' => 'Taiga',
        'symbol' => 't',
        'color' => '68,135,67',
        'movement' => 1,
        'defense' => 1,
        'food' => 1,
        'prod' => 0,
        'trade' => 0,
        'type' =>  TerrainType::LAND,
    ],
    [
        'name' => 'Snow',
        'symbol' => 's',
        'color' => '255,255,255',
        'movement' => 1,
        'defense' => 1,
        'food' => 1,
        'prod' => 0,
        'trade' => 0,
        'type' =>  TerrainType::LAND,
    ],
    [
        'name' => 'Mountains',
        'symbol' => 'm',
        'color' => '68,68,68',
        'movement' => 3,
        'defense' => 2,
        'food' => 0,
        'prod' => 2 ,
        'trade' => 0,
        'type' => TerrainType::TOP,
    ],
    [
        'name' => 'Forest',
        'symbol' => 'f',
        'color' => '32, 87, 2',
        'movement' => 2,
        'defense' => 1.5,
        'food' => 0,
        'prod' => 1,
        'trade' => 0,
        'type' =>  TerrainType::TOP,
    ],
    [
        'name' => 'Hills',
        'symbol' => 'h',
        'color' => '136,136,136',
        'movement' => 2,
        'defense' => 1.5,
        'food' => 0,
        'prod' => 1 ,
        'trade' => 0,
        'type' => TerrainType::TOP,
    ],
    [
        'name' => 'Jungle',
        'symbol' => 'j',
        'color' => '0,255,0',
        'movement' => 2,
        'defense' => 1.5,
        'food' => 1,
        'prod' => 0 ,
        'trade' => 0,
        'type' => TerrainType::TOP,
    ],
];



/*********
 * UNITS *
 *********

$data['units'] = [
    'settlers' => [
        'name' => 'Settlers',
        'flags' => [UnitFlagEnumType::SETTLER],
        'movement' => 1,
        'movementType' => UnitMovementTypeEnumType::LAND,
        'attack' => 0,
        'defense' => 1,
        'hp' => 10,
        'cost' => 40,
    ],

    'workers' => [
        'name' => 'Workers',
        'flags' => [UnitFlagEnumType::WORKER],
        'movement' => 1,
        'movementType' => UnitMovementTypeEnumType::LAND,
        'attack' => 0,
        'defense' => 1,
        'hp' => 10,
        'cost' => 20,
    ],

    'warriors' => [
        'name' => 'Warriors',
        'movement' => 1,
        'movementType' => UnitMovementTypeEnumType::LAND,
        'attack' => 1,
        'defense' => 1,
        'hp' => 10,
        'cost' => 10,
    ],

    'chariots' => [
        'name' => 'Chariots',
        'movement' => 2,
        'movementType' => UnitMovementTypeEnumType::LAND,
        'attack' => 2,
        'defense' => 1,
        'hp' => 10,
        'cost' => 20,
        'resources' => [

        ]
    ],

    'spearmen' => [
        'name' => 'Spearmen',
        'movement' => 2,
        'movementType' => UnitMovementTypeEnumType::LAND,
        'attack' => 1,
        'defense' => 2,
        'hp' => 10,
        'cost' => 20,
    ],

    'swordsmen' => [
        'name' => 'Swordsmen',
        'movement' => 2,
        'movementType' => UnitMovementTypeEnumType::LAND,
        'attack' => 3,
        'defense' => 2,
        'hp' => 10,
        'cost' => 40,
        'resources' => [
            'iron' => 1
        ]
    ],

    'catapults' => [
        'name' => 'Catapults',
        'movement' => 2,
        'movementType' => UnitMovementTypeEnumType::LAND,
        'attack' => 6,
        'defense' => 1,
        'hp' => 10,
        'cost' => 60
    ],

    'caravan' => [
        'name' => 'Caravan',
        'movement' => 2,
        'movementType' => UnitMovementTypeEnumType::SEA,
        'attack' => 6,
        'defense' => 1,
        'hp' => 10,
        'cost' => 50
    ],

    'galley' => [
        'name' => 'Galley',
        'movement' => 3,
        'movementType' => UnitMovementTypeEnumType::SEA,
        'attack' => 1,
        'defense' => 1,
        'hp' => 10,
        'flags' => [
            UnitFlagEnumType::COASTAL_SHIP
        ],
        'cost' => 60
    ],

    'trade_ship' => [
        'name' => 'Trading ship',
        'movement' => 3,
        'movementType' => UnitMovementTypeEnumType::SEA,
        'attack' => 0,
        'defense' => 1,
        'hp' => 10,
        'flags' => [
            UnitFlagEnumType::COASTAL_SHIP, UnitFlagEnumType::TRADE
        ],
        'cost' => 50
    ],

];


/*****************
 * Civilizations *
 *****************


$data['civilizations'] = [
  'Roman', 'Greek', 'Egyptian', 'Babylonian', 'Chinese', 'Indian', 'Persian', 'African',
  'Arab', 'Japanese', 'Mongolian', 'English', 'German', 'French', 'Scandinavian',
  'Spanish', 'Russian',  'Aztec', 'Inca', 'American', 'Korean', 'Khmer',
  'Polish'
];




/*****/
$ruleset = json_encode($data);
echo $ruleset;

file_put_contents('../rulesets/default/ruleset.json', $ruleset);









