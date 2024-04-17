<?php

class RecipePredictor {
    private $recipes;

    public function __construct($recipes) {
        $this->recipes = $recipes;
    }

    public function predictDishes($inputIngredients) {
        // Validate input ingredients
        if (empty($inputIngredients)) {
            return ['error' => 'No ingredients provided'];
        }

        // Dummy prediction logic
        $predictedDishes = [];
        foreach ($this->recipes as $recipe) {
            if (count(array_intersect($inputIngredients, $recipe['ingredients'])) === count($inputIngredients)) {
                $predictedDishes[] = $recipe['name'];
            }
        }

        return $predictedDishes;
    }
}

// Usage
$inputData = file_get_contents('php://input');
$inputJson = json_decode($inputData, true);
$inputIngredients = $inputJson['ingredients'] ?? [];

$recipes = [
    ["name" => "Pasta Carbonara", "ingredients" => ["pasta", "eggs", "bacon", "cheese"]],
    ["name" => "Caprese Salad", "ingredients" => ["tomatoes", "mozzarella", "basil", "olive oil"]],
    ["name" => "Chicken Stir-Fry", "ingredients" => ["chicken", "vegetables", "soy sauce"]],
    ["name" => "Adobo", "ingredients" => ["chicken", "vinegar", "soy sauce","onion", "garlic"]],
    ["name" => "Sandwich", "ingredients" => ["bread", "egg", "lettuce","mayo", "tomato"]],
    ["name" => "French Fries", "ingredients" => ["potato", "salt"]],
    ["name" => "Sushi", "ingredients" => ["rice", "fish"]],
];

$predictor = new RecipePredictor($recipes);
$predictedDishes = $predictor->predictDishes($inputIngredients);

header('Content-Type: application/json');
echo json_encode(['predicted_dishes' => $predictedDishes]);
?>
