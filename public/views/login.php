<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" type="text/css" href="public/css/login.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>FoodCorner</title>
</head>

<body>
    <div class="container">
        <div class="logo"></div>
        <div class="image-login-container">
            <div class="image"></div>
            <form class="login-container" action="login" method="POST">
                <div class="messages">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message. "<br>";
                        }
                    }
                    ?>
                </div>
                <input class="input-bar" type="text" placeholder="username" name="username">
                <input class="input-bar" type="password" placeholder="password" name="password">
                <button class="login-button" type="submit">Login</button>
                <button class="login-button">With Facebook</button>
            </form>
        </div>
    </div>


</body>

</html>