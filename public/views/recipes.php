<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto:wght@300;400&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script type="text/javascript" src="./public/js/search.js" defer></script>
    <script type="text/javascript" src="./public/js/taskbar.js" defer></script>

    <title>Recipes</title>
    <style>
        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            max-height: 150px; /* Set a fixed height for the dropdown content */
            overflow-y: auto; /* Add a scrollbar when content overflows */
            box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .dropdown-content a {
            color: black;
            padding: 12px 16px;
            text-decoration: none;
            display: block;
        }

        .dropdown-content a:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <div class="taskbar">
        <img class="logo" alt="logo" src="/public/img/food_corner.png">
        <div class="taskbar-buttons-container">
            <div class="taskbar-text-icon" id='home-taskbar'>
                <img class="icon" alt="Home" src="/public/assets/icons/home.png">
                <p class="text">Home</p>
            </div>
            <div class="taskbar-text-icon" id='liked-taskbar'>
                <img class="icon" alt="Liked recipes" src="/public/assets/icons/favorite.png">
                <p class="text">Liked</p>
            </div>
            <div class="taskbar-text-icon" id='add-taskbar'>
                <img class="icon" alt="Add recipe" src="/public/assets/icons/add.png">
                <p class="text">Add</p>
            </div>
        </div>
    </div>
    <div class="content">

        <div class="title-wrapper">
            <h1>Recipes</h1>
        </div>
        <div class="search-bar-wrapper">
            <input class="search-bar" type="text" placeholder="Search" id="search-bar">
        </div>
        <div class="buttons-container">
            <!-- <button id="category-button">
                <p class="button-text">Category</p>
                <img alt="Vector" src="/public/assets/icons/expand_circle_down.svg">
            </button> -->
            <div class="dropdown">
                <button id="category-button">
                    <p class="button-text">Category</p>
                    <img alt="Vector" src="/public/assets/icons/expand_circle_down.svg">
                </button>
                <div class="dropdown-content" id="category-dropdown">
                    <?php
                    // Fetch categories dynamically using PHP and populate options
                    foreach ($categories as $category => $id) {
                        echo '<a>' . $category . '</a>';
                    }
                    ?>
                </div>
            </div>
            <button>
                <p class="button-text">Sort by</p>
                <img alt="Vector" src="/public/assets/icons/expand_circle_down.svg">
            </button>
            <div class="dropdown">
                <button id="diet-button">
                    <p class="button-text">Diet</p>
                    <img alt="Vector" src="/public/assets/icons/expand_circle_down.svg">
                </button>
                <div class="dropdown-content" id="diet-dropdown">
                    <?php
                    // Fetch categories dynamically using PHP and populate options
                    foreach ($diets as $diet => $id) {
                        echo '<a>' . $diet . '</a>';
                    }
                    ?>
                </div>
            </div>
            <button id="clear-filters">
                <p class="button-text">Clear all filters</p>
            </button>
            <button id="findButton">
                <p class="button-text"> Find </p>
                <img class="button-icon" alt="Search" src="/public/assets/icons/search.png">
            </button>
        </div>
        <div class="recipes-container">
            <?php foreach ($recipes as $recipe): ?>
                <div class="recipe">
                    <div class="image" style="background-image: url('public/uploads/<?=$recipe->getImageUrl(); ?>');"></div>
                    <div class="recipe-text-icon">
                        <div class="recipe-text"><?= $recipe->getName(); ?></div>
                        <img class="button-icon" src="/public/assets/icons/favorite.png" />
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    </div>
</body>

<template id="recipe-template">
    <div class="recipe">
        <div class="image" style="background-image: url('');"></div>
        <div class="recipe-text-icon">
            <div class="recipe-text"></div>
            <img class="button-icon" src="/public/assets/icons/favorite.png" />
        </div>
    </div>
</template>

</html>
