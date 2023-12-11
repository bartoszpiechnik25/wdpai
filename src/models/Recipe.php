<?php

class Recipe {
    private int $recipe_id;
    private string $name;
    private string $description;
    private string $ingredients;
    private string $method;
    private int $author_id;
    private int $category_id;
    private int $diet_type_id;
    private string $bucket_image_url;

    public function __construct(string $name, string $description, string $ingredients, string $method, int $category_id, int $diet_type_id, string $image, int $author_id) {
        $this->name = $name;
        $this->description = $description;
        $this->ingredients = $ingredients;
        $this->method = $method;
        $this->category_id = $category_id;
        $this->diet_type_id = $diet_type_id;
        $this->author_id = $author_id;
        $this->bucket_image_url = $image;
    }

    public function getId() {
        return $this->recipe_id;
    }

    //create all remaining getters and setters
    public function setId(int $recipe_id) {
        $this->recipe_id = $recipe_id;
    }

    public function getAuthorId() {
        return $this->author_id;
    }

    public function getCategoryId() {
        return $this->category_id;
    }

    public function getDietTypeId() {
        return $this->diet_type_id;
    }

    public function getImageUrl() {
        return $this->bucket_image_url;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getIngredients() {
        return $this->ingredients;
    }
    
    public function getMethod() {
        return $this->method;
    }

    public function setAuthorId(int $author_id) {
        $this->author_id = $author_id;
    }
    
    public function setCategoryId(int $category_id) {
        $this->category_id = $category_id;
    }
    
    public function setDietTypeId(int $diet_type_id) {
        $this->diet_type_id = $diet_type_id;
    }
    
    public function setImage(string $image) {
        $this->bucket_image_url = $image;
    }
    
    public function setName(string $name) {
        $this->name = $name;
    }
    
    public function setDescription(string $description) {
        $this->description = $description;
    }
    
    public function setIngredients(string $ingredients) {
        $this->ingredients = $ingredients;
    }
    
    public function setMethod(string $method) {
        $this->method = $method;
    }

}