<?php

// 328/diner/index.php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require autoload.php
require_once ('vendor/autoload.php');

// Instantiate the F3 base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {
    //echo '<h1>Diner app</h1>';

    // Render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');
});

// Breakfast menu
$f3->route('GET /menu/breakfast', function() {
    //echo '<h1>Breakfast Menu!</h1>';

    //Render the view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

// Lunch menu
$f3->route('GET /menu/lunch', function() {
    //echo '<h1>Lunch Menu!</h1>';

    //Render the view page
    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});

// Dinner menu
$f3->route('GET /menu/dinner', function() {
    //echo '<h1>Dinner Menu!</h1>';

    //Render the view page
    $view = new Template();
    echo $view->render('views/dinner-menu.html');
});

// Order1
$f3->route('GET|POST /order1', function($f3) {
    //echo '<h1>Dinner Menu!</h1>';

    //If the page has been POSTed
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        //Get data from post array
        $food = $_POST['food'];
        $meal = $_POST['meal'];

        // if valid data
        if (true) {
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);
        }

    }

    //Render the view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Order2
$f3->route('GET|POST /order2/', function() {
    //Render the view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Run Fat-Free
$f3->run();