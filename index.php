<?php

use src\aplication\RoutesAplication;
use src\frame\EntryPoint;

include __DIR__ . '/vendor/autoload.php';

$route = ltrim(strtok($_SERVER['REQUEST_URI'],'?'),'/');

try{
    $entryPoint = new EntryPoint($route,$_SERVER['REQUEST_METHOD'],new RoutesAplication);
    $entryPoint->run();
}catch(\PDOException $e){
    $title = "ERROR BASE DE DATOS";
    $content = "ERROR: " . $e->getMessage() . ' en ' . $e->getFile() . ' : ' . $e->getLine();

    include __DIR__ . '/views/templates/layout.html.php';
}