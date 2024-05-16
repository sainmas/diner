<?php

class Controller {

    private $_f3;

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        //echo '<h1>Diner app</h1>';

        // Render a view page
        $view = new Template();
        echo $view->render('views/home-page.html');
    }

    function breakfast()
    {
        //echo '<h1>Breakfast Menu!</h1>';

        //Render the view page
        $view = new Template();
        echo $view->render('views/breakfast-menu.html');
    }

    function lunch()
    {
        //echo '<h1>Lunch Menu!</h1>';

        //Render the view page
        $view = new Template();
        echo $view->render('views/lunch-menu.html');
    }

    function dinner()
    {
        //echo '<h1>Dinner Menu!</h1>';

        //Render the view page
        $view = new Template();
        echo $view->render('views/dinner-menu.html');
    }

    function summary()
    {
        // Render a view page
        $view = new Template();
        echo $view->render('views/order-summary.html');

        //var_dump ( $f3->get('SESSION') );
        session_destroy();
    }

    function order1()
    {
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
                $this->_f3->set('errors["food"]', 'Please enter a food');
            }
            if (isset($_POST['meal']) and (Validate::validMeal($_POST['meal']))) {
                $meal = $_POST['meal'];
            } else {
                $this->_f3->set('errors["meal"]', 'Please enter a meal');
            }

            // Add the data to the session array
            $order = new Order($food, $meal);
            $this->_f3->set('SESSION.order', $order);


            // If there no errors
            // Reroute to order2
            if(empty($this->_f3->get('errors'))) {
                $this->_f3->reroute('order2');
            }
        }

        // Get the data from the model

        // add it to the F3 hive
        $meals = DataLayer::GetMeals();
        $this->_f3->set('meals', $meals);

        //Render the view page
        $view = new Template();
        echo $view->render('views/order1.html');
    }

    function order2()
    {
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
    }
}