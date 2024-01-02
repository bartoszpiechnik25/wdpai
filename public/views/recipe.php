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
    <title>Pizza Neapolitana</title>
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
            <h1><?=$recipe->getName()?></h1>
        </div>
        <div class="image-icon-container">
            <div class="image" style="background-image: url(public/uploads/<?=$recipe->getImageUrl(); ?>); min-height: 500px;"></div>
            <div class="likes-container">
                <img class="icon" id="recipe-heart" alt="number of dislikes" src="/public/assets/icons/favorite.png">
                <div class="like-dislike-container">

                <div class="like">
                    <img class="icon" alt="number of likes" src="/public/assets/icons/thumb_up.svg">
                    <p>128</p>
                </div>
                <div class="dislike">
                    <img class="icon" alt="number of dislikes" src="/public/assets/icons/thumb_down.svg">
                    <p>5</p>
                </div>
                </div>

            </div>
        </div>
        <h2>Description</h2>
        <p><?=$recipe->getDescription()?></p>
        <h2>Ingredients</h2>
        <ul>
            <?php
            $ingredients = explode(",", $recipe->getIngredients());

            foreach ($ingredients as $ingredient) {
                echo "<li>".$ingredient."</li>";
            } 
            ?>
        </ul>
        <h2>Method</h2>
        <p><?php
            $method = $recipe->getMethod();
            $steps = explode('\n', $method);

            foreach ($steps as $step) {
                echo $step . "<br>";
            }
            ?></p>
    </div>
</body>

</html>