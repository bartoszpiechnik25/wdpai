<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../exceptions/NotFoundException.php';


class RecipeRepository extends Repository {

    public function getRecipe(int $recipe_id): Recipe {

        $query = $this->database->connect()->prepare(
            'select * from recipes r join images i on r.recipe_id = i.recipe_id where r.recipe_id = :recipe_id'
        );
        $query->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT); 
        $query->execute();
        $recipe = $query->fetch(PDO::FETCH_ASSOC);

        if ($recipe == false ) {
            new NotFoundException("Recipe with id: ".$recipe_id." not found");
        }
        $recipe = new Recipe(
            $recipe['name'],
            $recipe['description'],
            $recipe['ingredients'],
            $recipe['method'],
            (int)$recipe['food_category_id'],
            (int)$recipe['diet_type_id'],
            $recipe['image_url'],
            (int)$recipe['author_id']
        );
        $recipe->setId($recipe_id);
        return $recipe;
    }

    public function getRecipes(): array {
        $result = [];
        $query = $this->database->connect()->query('select * from recipes natural left join images');

        $recipes = $query->fetchAll(PDO::FETCH_ASSOC);

        foreach ($recipes as $recipe) {
            $result[] = new Recipe(
                $recipe['name'],
                $recipe['description'],
                $recipe['ingredients'],
                $recipe['method'],
                (int)$recipe['food_category_id'],
                (int)$recipe['diet_type_id'],
                $recipe['image_url'],
                (int)$recipe['author_id']
            );
        }

        return $result;
    }

    public function addRecipe(Recipe $recipe): void {
        $connection = $this->database->connect();
        $insert = $connection->prepare(
            'insert into recipes (
                name,
                description,
                ingredients,
                method,
                author_id,
                food_category_id,
                diet_type_id
            ) values (?, ?, ?, ?, ?, ?, ?)'
        );

        $insert->execute([
            $recipe->getName(),
            $recipe->getDescription(),
            $recipe->getIngredients(),
            $recipe->getMethod(),
            $recipe->getAuthorId(),
            $recipe->getCategoryId(),
            $recipe->getDietTypeId(),
        ]);

        $recipe_id = (int)$connection->lastInsertId();
        $recipe->setId($recipe_id);

        $insert_image = $connection->prepare(
            'insert into images (
                recipe_id,
                bucket_url
            ) values (?, ?)'
        );
        $insert_image->execute([$recipe_id, $recipe->getImageUrl()]);

    }
}