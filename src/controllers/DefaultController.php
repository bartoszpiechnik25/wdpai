<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    public function recipes() {
        $this->render('recipes');
    }
    public function login() {
        $this->render('login', ['messages' => ['Siema eniu dobry mudzin z afrika']]);
    }
    public function recipe() {
        $this->render('recipe');
    }
    public function liked() {
        $this->render('liked');
    }
}