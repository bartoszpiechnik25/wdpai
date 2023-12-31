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
    <title>Recipes</title>
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
            <h1>Liked</h1>
        </div>
        <div class="search-bar-wrapper">
            <input class="search-bar" type="text" placeholder="Search">
        </div>
        <div class="buttons-container">
            <button>
                <p class="button-text">Category</p>
                <img alt="Vector" src="/public/assets/icons/vector.png">
            </button>
            <button>
                <p class="button-text">Sort by</p>
                <img alt="Vector" src="/public/assets/icons/vector.png">
            </button>
            <button>
                <p class="button-text">Diet</p>
                <img alt="Vector" src="/public/assets/icons/vector.png">
            </button>
            <button>
                <p class="button-text">Clear all filters</p>
            </button>
            <button>
                <p class="button-text"> Find </p>
                <img class="button-icon" alt="Search" src="/public/assets/icons/search.png">
            </button>
        </div>
        <div class="recipes-container">
            <div class="recipe">
                <div class="image" style="background-image: url(public/img/ramen.jpg);"></div>
                <div class="recipe-text-icon">
                    <div class="recipe-text">Ramen</div>
                    <img class="button-icon" src="/public/assets/icons/favorite.png" />
                </div>
            </div>
            <div class="recipe">
                <div class="image" style="background-image: url(public/img/pizza.jpg);"></div>
                <div class="recipe-text-icon">
                    <div class="recipe-text">Pizza Neapolitana</div>
                    <img class="button-icon" src="/public/assets/icons/favorite.png" />
                </div>
            </div>
            <div class="recipe">
                <div class="image" style="background-image: url(public/img/sushi.jpg);"></div>
                <div class="recipe-text-icon">
                    <div class="recipe-text">Sushi</div>
                    <img class="button-icon" src="/public/assets/icons/favorite.png" />
                </div>
            </div>
        </div>
    </div>

    </div>
</body>

</html>