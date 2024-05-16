<?php

// 328/diner/index.php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary files
require_once ('vendor/autoload.php');
require_once ('controllers/controller.php');

// Instantiate the F3 base class
$f3 = Base::instance();
$con = new Controller($f3);

// Define a default route
$f3->route('GET /', function() {
    $GLOBALS['con']->home();
});

// Breakfast menu
$f3->route('GET /menu/breakfast', function() {
    $GLOBALS['con']->breakfast();
});

// Lunch menu
$f3->route('GET /menu/lunch', function() {
    $GLOBALS['con']->lunch();
});

// Dinner menu
$f3->route('GET /menu/dinner', function() {
    $GLOBALS['con']->dinner();
});

// Order Summary
$f3->route('GET /summary', function() {
    $GLOBALS['con']->summary();
});

// Order1
$f3->route('GET|POST /order1', function() {
    $GLOBALS['con']->order1();
});

// Order2
$f3->route('GET|POST /order2', function($f3) {
    $GLOBALS['con']->order2();
});

// Run Fat-Free
$f3->run();