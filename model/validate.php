<?php

/* Validate data for diner app
 */
class Validate {
// Returns true if food contains at least 3 characters
    static function validFood($food) {
        return strlen(trim($food)) >= 3;
    }

    static function validMeal($meal) {
        return in_array($meal, DataLayer::GetMeals());
    }
}
