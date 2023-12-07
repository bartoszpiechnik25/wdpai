<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    public function recipes() {
        $this->render('recipes');
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