<!DOCTYPE html>
<html>
<head>
    <title>Page Not Found</title>
    <link rel="stylesheet" type="text/css" href="/public/css/style.css">
</head>
<body>
    </div>
    <div class="content" style="text-align: center;">
        <h2>404</h2>
        <p><?php
            if (isset($message)) {
                echo $message;
            } else {
                echo "Sorry, the page you are looking for does not exist.";
            }
            ?></p>
    </div>
</body>
</html>