<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';
require_once __DIR__.'/../repository/RecipeRepository.php';

class DefaultController extends AppController{
    public function recipes() {
        $recipeRepository = new RecipeRepository();
        $recipe = $recipeRepository->getRecipe(4);
        $this->render('recipes', ['recipe' => $recipe]);
    }
    public function login() {
        $this->render('login');
    }
    public function recipe() {
        $this->render('recipe');
    }
    public function liked() {
        $this->render('liked');
    }
    public function add() {
        $this->render('add');
    }
}