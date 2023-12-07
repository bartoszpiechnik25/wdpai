<?php

class Recipe {
    private string $name;
    private string $description;
    private string $ingredients;
    private string $method;
    private string $category;
    private string $diet;
    private string $image;

    public function __construct(string $name, string $description, string $ingredients, string $method, string $category, string $diet, string $image) {

        $this->name = $name;
        $this->description = $description;
        $this->ingredients = $ingredients;
        $this->method = $method;
        $this->category = $category;
        $this->diet = $diet;
        $this->image = $image;
    }

    public function getImgage() {
        return $this->image;
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

}