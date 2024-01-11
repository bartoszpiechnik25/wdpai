<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto:wght@300;400&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <script type="text/javascript" src="./public/js/taskbar.js" defer></script>
    <script type="text/javascript" src="./public/js/add_recipe.js" defer></script>
    <title>Add recipe</title>
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
            max-height: 150px;
            /* Set a fixed height for the dropdown content */
            overflow-y: auto;
            /* Add a scrollbar when content overflows */
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
    <script></script>
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
        <form action="addRecipe" method="POST" ENCTYPE="multipart/form-data">
            <div class="title-wrapper">
                <h1>Add New Recipe</h1>
            </div>
            <textarea name="name" class="box-text" style="min-height: 1em;" type="text"
                placeholder="Recipe name"></textarea>
            <h2>Description</h2>
            <textarea name="description" class="box-text" type="text" placeholder="Description"></textarea>
            <h2>Ingredients</h2>
            <textarea name="ingredients" class="box-text" type="text" placeholder="Ingredients"></textarea>

            <h2>Method</h2>
            <textarea name="method" class="box-text" type="text" placeholder="Method"></textarea>
            <div class="messages">
                <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message. "<br>";
                        }
                    }
                    ?>
            </div>
            <div class="add-buttons-container">
                <input type="file" name="file" size=60 /><br />
                <div class="category-diet-buttons">
                    <div class="dropdown">
                        <button id="category-button" type="button">
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
                    <div class="dropdown">
                        <button id="diet-button" type="button">
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
                </div>
            </div>
            <input type="hidden" id="selectedDiet" name="selectedDiet" value="">
            <input type="hidden" id="selectedCategory" name="selectedCategory" value="">

            <div class="add-button">
                <button type="submit">
                    <p class="button-text">Add</p>
                    <img alt="Vector" src="/public/assets/icons/add_circle.svg">
                </button>
            </div>
        </form>
    </div>
</body>

</html>