<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../repository/RecipeRepository.php';

class DefaultController extends AppController{
    public function login() {
        $this->render('login');
    }
    public function recipe() {
        if (isset($_GET['id'])) {
            try {
                $recipe_repository = new RecipeRepository();
                $recipe = $recipe_repository->getRecipe((int)$_GET['id']);
                $recipe->setId((int)$_GET['id']);
                $this->render('recipe', ['recipe' => $recipe]);
            } catch (Exception $e) {
                $this->render('404', ['message' => $e->getMessage()]);
            }
        } else {
            $this->render('404');
        }
    }
    public function liked() {
        $this->render('liked');
    }
    public function add() {
        $recipe_repository = new RecipeRepository();
        $this->render('add', [
            'categories' => $recipe_repository->getCategories(),
            'diets' => $recipe_repository->getDietType()
        ]);
    }
    public function register() {
        $this->render('register');
    }
}