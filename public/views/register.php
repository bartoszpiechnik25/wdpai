<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="public/css/login.css">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Libre+Baskerville&family=Roboto:wght@300;400&display=swap" rel="stylesheet">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <script type="text/javascript" src="./public/js/script.js" defer></script>
        <title>Register</title>
    </head>
    <body>
        <div class="content-container">
            <div class="logo"></div>
            <form class="register-container" action="register" method="POST">
            <div class="messages">
                    <?php
                    if (isset($messages)) {
                        foreach ($messages as $message) {
                            echo $message. "<br>";
                        }
                    }
                    ?>
                </div>
                <input class="register-input" type="text" placeholder="Username" name="username">
                <input class="register-input" type="email" placeholder="Email" name="email">
                <input class="register-input" type="password" placeholder="Password" name="password">
                <input class="register-input" type="password" placeholder="Confirm password" name="confirm_password">
                <input class="register-input" type="text" placeholder="Name" name="name">
                <input class="register-input" type="text" placeholder="Surname" name="surname">
                <input class="register-input" type="tel" placeholder="Phone number" name="phone_number">
                <button class="register-button" type="submit">Register</button>
            </form>
        </div>
    </body>

</html>