<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../repository/RecipeRepository.php';

class RecipeController extends AppController {
    private $messages = [];
    private RecipeRepository $recipeRepository;

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg', 'image/jpeg'];
    const UPLOAD_DIRECTORY= '/../public/uploads/';

    public function __construct() {
        parent::__construct();
        $this->recipeRepository = new RecipeRepository();
    }

    public function addRecipe() {

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            
            $filepath = dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name'];
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                $filepath
            );

            $category_id = RecipeRepository::keyExistsInMapping($_POST['selectedCategory'], RecipeRepository::getCategoriesArray());
            $diet_id = RecipeRepository::keyExistsInMapping($_POST['selectedDiet'], RecipeRepository::getDietArray());
            
            if (is_null($category_id)) {
                $this->messages[] = "No such category";
            } else if (is_null($diet_id)) {
                $this->messages[] = "No such diet";
            } else {
                $recipe = new Recipe(
                    $_POST['name'],
                    $_POST['description'],
                    $_POST['ingredients'],
                    $_POST['method'],
                    $category_id,
                    $diet_id,
                    $_FILES['file']['name'],
                    1
                );
                $this->recipeRepository->addRecipe($recipe);

                return $this->render('recipes', ['recipes' => $this->recipeRepository->getRecipes()]);
            }   
        }
        $this->render('add', ['messages' => $this->messages]);
    }

    public function recipes() {
        $recipes = $this->recipeRepository->getRecipes();
        $categories = $this->recipeRepository->getCategories();
        $diets = $this->recipeRepository->getDietType();
        $this->render('recipes', [
            'recipes' => $recipes,
            'categories' => $categories,
            'diets' => $diets
        ]);
    }

    private function validate(array $file) {
        if ($file['size'] > self::MAX_FILE_SIZE) {
            $this->messages[] = 'File is to large';
            return false;
        }

        if (!isset($file['type']) || !in_array($file['type'], self::SUPPORTED_TYPES)) {
            $this->messages[] = 'File type is not supported';
            return false;
        }
        return true;
    }

    public function search() {
        $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';

        if ($contentType === 'application/json') {
            $content = trim(file_get_contents("php://input"));
            $decoded = json_decode($content, true);
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode($this->recipeRepository->getRecipesByKeyword(
                $decoded['search'],
                $decoded['diet'],
                $decoded['category']
            ));
        }
    }
}