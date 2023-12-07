<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';

class DefaultController extends AppController{
    public function recipes() {
        $recipe = new Recipe(
            "Simething",
            "essa",
            "o tako",
            'askldjflkasjdf',
            'asldjflkajsdlfjla',
            'jakis shit',
            'perogi.jpeg'
        );
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