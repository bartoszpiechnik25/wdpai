<?php

require_once 'AppController.php';
require_once __DIR__.'/../models/Recipe.php';

class RecipeController extends AppController {
    private $messages = [];

    const MAX_FILE_SIZE = 1024*1024;
    const SUPPORTED_TYPES = ['image/png', 'image/jpg', 'image/jpeg'];
    const UPLOAD_DIRECTORY= '/../public/uploads/';

    public function addRecipe() {

        if ($this->isPost() && is_uploaded_file($_FILES['file']['tmp_name']) && $this->validate($_FILES['file'])) {
            
            $filepath = dirname(__DIR__).self::UPLOAD_DIRECTORY.$_FILES['file']['name'];
            move_uploaded_file(
                $_FILES['file']['tmp_name'],
                $filepath
            );

            $recipe = new Recipe(
                $_POST['name'],
                $_POST['description'],
                $_POST['ingredients'],
                $_POST['method'],
                'category',
                'diet',
                $_FILES['file']['name']
            );
            
            return $this->render('recipes', ['recipe' => $recipe]);
        }
        $this->render('add', ['messages' => $this->messages]);
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
}