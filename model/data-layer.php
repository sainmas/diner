<?php

/* This is my data layer
 * This belongs to the model
 */
class DataLayer {
// Gets the meals for the diner app
    static function GetMeals()
    {
        return array('breakfast', 'lunch', 'dinner', 'dessert');
    }

    static function GetCondiments() {
        return array ('ketchup', 'mustard', 'sriracha', 'sour cream');
    }
}