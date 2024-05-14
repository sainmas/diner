<?php

// 328/diner/index.php

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary files
require_once ('vendor/autoload.php');

/* Testing datalayer class*/
//var_dump(DataLayer::GetCondiments());

/* Test Code
$testFood = 'pho';
var_dump(validFood($testFood));
*/

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

// Order Summary
$f3->route('GET /summary', function($f3) {

    // Render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');

    //var_dump ( $f3->get('SESSION') );
    session_destroy();
});

// Order1
$f3->route('GET|POST /order1', function($f3) {
    //echo '<h1>Dinner Menu!</h1>';

    // Initialize values
    $food = "";
    $meal = "";

    //If the page has been POSTed
    if($_SERVER['REQUEST_METHOD'] == "POST") {

        //Get data from post array
        if (Validate::validFood($_POST['food'])) {
            $food = $_POST['food'];
        } else {
            $f3->set('errors["food"]', 'Please enter a food');
        }
        if (isset($_POST['meal']) and (Validate::validMeal($_POST['meal']))) {
            $meal = $_POST['meal'];
        } else {
            $f3->set('errors["meal"]', 'Please enter a meal');
        }

        // Add the data to the session array
        $order = new Order($food, $meal);
        $f3->set('SESSION.order', $order);


        // If there no errors
        // Reroute to order2
        if(empty($f3->get('errors'))) {
            $f3->reroute('order2');
        }
    }

    // Get the data from the model

    // add it to the F3 hive
    $meals = DataLayer::GetMeals();
    $f3->set('meals', $meals);

    //Render the view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Order2
$f3->route('GET|POST /order2', function($f3) {
    //var_dump ( $f3->get('SESSION') );

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        //var_dump($_POST);
        // Get the data from the post array
        if (isset($_POST['conds']))
            $condiments = implode(", ", $_POST['conds']);
        else
            $condiments = "None selected";

        // If the data valid
        if (true) {

            // Add the data to the session array
            $f3->get('SESSION.order')->setCondiments($condiments);

            // Send the user to the next form
            $f3->reroute('summary');
        }
        else {
            // Temporary
            echo "<p>Validation errors</p>";
        }
    }
    // Get the data from the model
    // add it to the F3 hive
    $condiments = DataLayer::GetCondiments();
    $f3->set('condiments', $condiments);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Run Fat-Free
$f3->run();