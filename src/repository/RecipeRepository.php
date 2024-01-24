<?php

require_once 'Repository.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../exceptions/NotFoundException.php';


class RecipeRepository extends Repository {
    private static ?array $categoryMapping = null;
    private static ?array $dietMapping = null;

    public function __construct() {
        parent::__construct();
        if (is_null(self::$dietMapping)) {
            $this->getDietType();
        }
        if (is_null(self::$categoryMapping)) {
            $this->getCategories();
        }
    }

    public function getRecipe(int $recipe_id): Recipe {

        $query = $this->database->connect()->prepare(
            'select * from recipes r join images i on r.recipe_id = i.recipe_id where r.recipe_id = :recipe_id'
        );
        $query->bindParam(':recipe_id', $recipe_id, PDO::PARAM_INT); 
        $query->execute();
        $recipe = $query->fetch(PDO::FETCH_ASSOC);

        if ($recipe === false ) {
            throw new NotFoundException("Recipe with id: ".$recipe_id." not found");
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
            $r = new Recipe(
                $recipe['name'],
                $recipe['description'],
                $recipe['ingredients'],
                $recipe['method'],
                (int)$recipe['food_category_id'],
                (int)$recipe['diet_type_id'],
                $recipe['image_url'],
                (int)$recipe['author_id']
            );
            $r->setId($recipe['recipe_id']);
            $result[] = $r;
        }

        return $result;
    }

    public function addRecipe(Recipe $recipe): void {
        $connection = $this->database->connect();
        try{
            $connection->beginTransaction();
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
                    image_url
                ) values (?, ?)'
            );
            $insert_image->execute([$recipe_id, $recipe->getImageUrl()]);
            $connection->commit();
        } catch (Exception $e) {
            $connection->rollBack();
        }   
    }

    public function getLikedRecipes(int $user_id) {
        $stmt = $this->database->connect()->prepare(
            "select * from likedrecipes natural join recipes natural join images where user_id=:id"
        );
        $stmt->bindParam(':id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        $recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $result = [];
        foreach ($recipes as $recipe) {
            $r = new Recipe(
                $recipe['name'],
                $recipe['description'],
                $recipe['ingredients'],
                $recipe['method'],
                (int)$recipe['food_category_id'],
                (int)$recipe['diet_type_id'],
                $recipe['image_url'],
                (int)$recipe['author_id']
            );
            $r->setId($recipe['recipe_id']);
            $result[] = $r;
        }
        return $result;
    }

    public function getLikes(int $recipe_id) {
        $likes_stmt = $this->database->connect()->prepare("select count(recipe_id) as likes from likedrecipes where recipe_id=:id group by recipe_id");
        $dislikes_stmt = $this->database->connect()->prepare("select count(recipe_id) as dislikes from dislikedrecipes where recipe_id=:id group by recipe_id");

        $likes_stmt->bindParam(':id', $recipe_id, PDO::PARAM_INT);
        $dislikes_stmt->bindParam(':id', $recipe_id, PDO::PARAM_INT);

        $likes_stmt->execute();
        $likes = $likes_stmt->fetch(PDO::FETCH_ASSOC);

        $dislikes_stmt->execute();
        $dislikes = $dislikes_stmt->fetch(PDO::FETCH_ASSOC);

        $request_data = [];

        if (empty($dislikes)) {
            $request_data['dislikes'] = 0;
        } else {
            $request_data['dislikes'] = $dislikes['dislikes'];
        }

        if (empty($likes)) {
            $request_data['likes'] = 0;
        } else {
            $request_data['likes'] = $likes['likes'];
        }

        return $request_data;
    }

    public function getRecipesByKeyword(string $searchString, ?string $diet, ?string $category) {
        $base_query = 'select recipe_id, name, image_url from recipes natural join images where name ilike :search';
        if (!is_null($category)) {
            $id = self::keyExistsInMapping($category, self::$categoryMapping);
            if (!is_null($id)) {
                $base_query = $base_query.' and food_category_id='.$id;
            }
        }

        if (!is_null($diet)) {
            $d_id = self::keyExistsInMapping($diet, self::$dietMapping);
            if (!is_null($d_id)) {
                $base_query = $base_query.' and diet_type_id='.$d_id;
            }
        }
        $searchString = '%'.$searchString.'%';
        $connection = $this->database->connect();
        $stmt = $connection->prepare(
            $base_query
        );
        $stmt->bindParam(':search', $searchString, PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getCategories(): array {
        $query = $this->database->connect()->query(
            "select * from foodcategory"
        );
        $food_categories = array();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $category) {
            $food_categories[$category["category"]] = $category["food_category_id"];
        }
        self::$categoryMapping = $food_categories;
        return $food_categories;
    }

    public function getDietType(): array {
        $query = $this->database->connect()->query(
            "select * from diettype"
        );
        $diet_type = array();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach($result as $diet) {
            $diet_type[$diet["diet_type"]] = $diet["diet_type_id"];
        }
        RecipeRepository::$dietMapping = $diet_type;
        return $diet_type;
    }

    public static function getCategoriesArray() {
        return self::$categoryMapping;
    }

    public static function getDietArray() {
        return self::$dietMapping;
    }

    public static function keyExistsInMapping(string $key, array $mapping): ?int {
        if (array_key_exists($key, $mapping)) {
            return $mapping[$key];
        }
        return null;
    }
}