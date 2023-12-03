<?php

require_once 'AppController.php';

class DefaultController extends AppController{
    public function index() {
        $this->render('index');
    }
    public function login() {
        $this->render('login', ['messages' => ['Siema eniu dobry mudzin z afrika']]);
    }
}