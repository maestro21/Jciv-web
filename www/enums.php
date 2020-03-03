<?php

class Enum {

    static public function getOptions() {
        $reflectionClass = new ReflectionClass(get_called_class());

        $return = [
            '' => '--none--'
        ];
        foreach($reflectionClass->getConstants() as $k => $v) {
            $return[$v] = ucfirst($v);
        }

        return $return;
    }

}


class UnitFlagEnumType extends Enum
{

    const SETTLER = 'settler';
    const WORKER = 'worker';
    const TRADE = 'trade';
    const COASTAL_SHIP = 'coastal';
}


class UnitMovementTypeEnumType extends Enum
{

    const LAND = 'land';
    const SEA = 'sea';
    const AIR = 'air';
}


class TerrainType extends Enum
{
    const WATER =  'water';
    const COAST = 'coast';
    const LAND = 'land';
    const TOP = 'top';
}