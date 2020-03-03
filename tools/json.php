<?php

include('enums.php');

$t = $_GET['type'] ?? 'ruleset';
$name = $_GET['name'] ?? 'default';

switch($t) {
    case 'ruleset':
        $path = 'rulesets/' . $name . '/ruleset.php';
        break;
}

if(file_exists($path)) {
    include($path);
    echo json_encode($data, JSON_PRETTY_PRINT);
}