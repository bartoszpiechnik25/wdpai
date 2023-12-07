<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto:wght@300;400&display=swap"
        rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Add recipe</title>
</head>

<body>
    <div class="taskbar">
        <img class="logo" alt="logo" src="/public/img/food_corner.png">
        <div class="taskbar-buttons-container">
            <div class="taskbar-text-icon">
                <img class="icon" alt="Home" src="/public/assets/icons/home.png">
                <p class="text">Home</p>
            </div>
            <div class="taskbar-text-icon">
                <img class="icon" alt="Liked recipes" src="/public/assets/icons/favorite.png">
                <p class="text">Liked</p>
            </div>
            <div class="taskbar-text-icon">
                <img class="icon" alt="Add recipe" src="/public/assets/icons/add.png">
                <p class="text">Add</p>
            </div>
        </div>
    </div>
    <div class="content">
        <form action="add" method="POST" ENCTYPE="multipart/form-data">
            <div class="title-wrapper">
                <h1>Add New Recipe</h1>
            </div>
            <textarea name="name" class="box-text" style="min-height: 1em;" type="text" placeholder="Recipe name"></textarea>
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
                <!-- <button>
                    <p class="button-text">Upload Images</p>
                    <img class="button-icon" alt="Search" src="/public/assets/icons/cloud_upload.svg">
                </button> -->
                <input type="file" name="file" size=60/><br/>
                <div class="category-diet-buttons">
                <button>
                    <p class="button-text">Category</p>
                    <img alt="Vector" src="/public/assets/icons/expand_circle_down.svg">
                </button>
                <button>
                    <p class="button-text">Diet</p>
                    <img alt="Vector" src="/public/assets/icons/expand_circle_down.svg">
                </button>
                </div>
            </div>
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