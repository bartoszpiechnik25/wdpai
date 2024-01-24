<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../repository/RecipeRepository.php';

class DefaultController extends AppController{
    public function login() {
        $this->render('login');
    }
    public function recipe() {
        if (!isset($_SESSION['logged_user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        } else {
            if (isset($_GET['id'])) {
                try {
                    $recipe_repository = new RecipeRepository();
                    $recipe = $recipe_repository->getRecipe((int)$_GET['id']);
                    $recipe->setId((int)$_GET['id']);
                    $likes = $recipe_repository->getLikes((int)$_GET['id']);
                    $this->render('recipe', ['recipe' => $recipe, 'likes' => $likes['likes'], 'dislikes' => $likes['dislikes']]);
                } catch (Exception $e) {
                    $this->render('404', ['message' => $e->getMessage()]);
                }
            } else {
                $this->render('404');
            }
        }
    }
    public function liked() {
        if (!isset($_SESSION['logged_user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        } else {
            $recipe_repository = new RecipeRepository();
            $user_liked_recipes = $recipe_repository->getLikedRecipes($_SESSION['logged_user']);
            $this->render('liked', ['recipes' => $user_liked_recipes, 'categories' => $recipe_repository->getCategories(), 'diets' => $recipe_repository->getDietType()]);
        }
    }
    public function add() {
        if (!isset($_SESSION['logged_user'])) {
            $url = "http://$_SERVER[HTTP_HOST]";
            header("Location: {$url}/login");
        } else {
            $recipe_repository = new RecipeRepository();
            $this->render('add', [
                'categories' => $recipe_repository->getCategories(),
                'diets' => $recipe_repository->getDietType()
            ]);
        }
    }
    public function register() {
        $this->render('register');
    }
    public function notFound() {
        $this->render('404');
    }
}