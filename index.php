<?php
require('./ingredients/Ingredient.php');

/**
 * Add all possible sums of 4 numbers which add up to 100 to an array
 */
function getAllPossibleCombinations ($max) {
    $possibilities = [];

    for ($sprinklesCount = $max; $sprinklesCount >= 0; $sprinklesCount--) {
        if ($sprinklesCount === $max) {
            array_push($possibilities, [$sprinklesCount, 0, 0, 0]);
        } else if ($sprinklesCount < $max) {
            for ($butterscotchCount = 0; $butterscotchCount <= $max; $butterscotchCount++) {
                if (($sprinklesCount + $butterscotchCount) === $max) {
                    array_push($possibilities, [$sprinklesCount, $butterscotchCount, 0, 0]);
                } else if (($sprinklesCount + $butterscotchCount) < $max) {
                    for ($chocolateCount = 0; $chocolateCount <= $max; $chocolateCount++) {
                        if (($sprinklesCount + $butterscotchCount + $chocolateCount) === $max) {
                            array_push($possibilities, [$sprinklesCount, $butterscotchCount, $chocolateCount, 0]);
                        } else if (($sprinklesCount + $butterscotchCount + $chocolateCount) < $max) {
                            for ($candyCount = 0; $candyCount <= $max; $candyCount++) {
                                if (($sprinklesCount + $butterscotchCount + $chocolateCount + $candyCount) === $max) {
                                    array_push($possibilities, [$sprinklesCount, $butterscotchCount, $chocolateCount, $candyCount]);
                                }
                            }
                        }
                    }
                }
            }
        }
    }

    return $possibilities;
}

/**
 * Calculates the total highscore of every possible ingredient combination. Also takes the 500 calories into account if so specified.
 */
function calculateCookieScore ($possibilities, $caloriesMatter = false) {
    $ingredients = [];
    $ingredients['Sprinkles'] = new Ingredient('Sprinkles', 2, 0, -2, 0, 3);
    $ingredients['Butterscotch'] = new Ingredient('Butterscotch', 0, 5, -3, 0, 3);
    $ingredients['Chocolate'] = new Ingredient('Chocolate', 0, 0, 5, -1, 8);
    $ingredients['Candy'] = new Ingredient('Candy', 0, -1, 0, 5, 8);

    $highScore = 0;
    foreach ($possibilities as $possibility) {
        $totalCapacity = getTotalPropertyScore($possibility, $ingredients, 'Capacity');
        $totalDurability = getTotalPropertyScore($possibility, $ingredients, 'Durability');
        $totalFlavour = getTotalPropertyScore($possibility, $ingredients, 'Flavour');
        $totalTexture = getTotalPropertyScore($possibility, $ingredients, 'Texture');

        if (!$caloriesMatter) {
            $totalScore = $totalCapacity * $totalDurability * $totalFlavour * $totalTexture;
            $highScore = $totalScore > $highScore ? $totalScore : $highScore;
        } else {
            $totalCalories = getTotalPropertyScore($possibility, $ingredients, 'Calories');
            if ($totalCalories === 500) {
                $totalScore = $totalCapacity * $totalDurability * $totalFlavour * $totalTexture;
                $highScore = $totalScore > $highScore ? $totalScore : $highScore;
            }
        }
        
    }

    return $highScore;
}

/**
 * Calculates the score of a specified property (IE: Capacity, Durability etc.)
 */
function getTotalPropertyScore($possibility, $ingredients, $property) {
    $propertyScore = 0;

    if ($property === 'Capacity') {
        $propertyScore = 
            ($possibility[0] * $ingredients['Sprinkles']->getCapacity()) +
            ($possibility[1] * $ingredients['Butterscotch']->getCapacity()) +
            ($possibility[2] * $ingredients['Chocolate']->getCapacity()) +
            ($possibility[3] * $ingredients['Candy']->getCapacity());
    }else if ($property === 'Durability') {
        $propertyScore = 
            ($possibility[0] * $ingredients['Sprinkles']->getDurability()) +
            ($possibility[1] * $ingredients['Butterscotch']->getDurability()) +
            ($possibility[2] * $ingredients['Chocolate']->getDurability()) +
            ($possibility[3] * $ingredients['Candy']->getDurability());
    } else if ($property === 'Flavour') {
        $propertyScore = 
            ($possibility[0] * $ingredients['Sprinkles']->getFlavour()) +
            ($possibility[1] * $ingredients['Butterscotch']->getFlavour()) +
            ($possibility[2] * $ingredients['Chocolate']->getFlavour()) +
            ($possibility[3] * $ingredients['Candy']->getFlavour());
    } else if ($property === 'Texture') {
        $propertyScore = 
            ($possibility[0] * $ingredients['Sprinkles']->getTexture()) +
            ($possibility[1] * $ingredients['Butterscotch']->getTexture()) +
            ($possibility[2] * $ingredients['Chocolate']->getTexture()) +
            ($possibility[3] * $ingredients['Candy']->getTexture());
    } else if ($property === 'Calories') {
        $propertyScore = 
            ($possibility[0] * $ingredients['Sprinkles']->getCalories()) +
            ($possibility[1] * $ingredients['Butterscotch']->getCalories()) +
            ($possibility[2] * $ingredients['Chocolate']->getCalories()) +
            ($possibility[3] * $ingredients['Candy']->getCalories());
    }

    // Set the property score to 0 if it's a negative value
    return $propertyScore < 0 ? 0 : $propertyScore;
}

$combinations = getAllPossibleCombinations(100);
echo 'HIGHEST POSSIBLE SCORE: '.calculateCookieScore($combinations);
echo '<br>';
echo 'HIGHEST POSSIBLE SCORE WITH EXACTLY 500 CALORIES: '.calculateCookieScore($combinations, true);