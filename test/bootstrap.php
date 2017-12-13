<?php
require __DIR__  . '/../src/SplClassLoader.php';
//require "../vendor/autoload.php";
include __DIR__ . '/../src/COG/Config/constant.php';
$oClassLoader = new \SplClassLoader('COG', __DIR__ . '/../src');
$oClassLoader->register();

// Get data from data source
$str = file_get_contents("../data/15475.json");
$data = json_decode($str, true);

// Get data ordered from data test
$str = file_get_contents("15475_ordered.json");
$dataOrdered = json_decode($str, true);