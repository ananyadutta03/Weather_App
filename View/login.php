<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="CurrentConditionStyle.css">
</head>
<body>
    <div class="container">
    <!-- Login Form -->
        <div class="login-box">
            <form method="post" action="../controller/loginCheck.php">
               <h2>Login to Weather App</h2>
                <input type="text" name="username" placeholder="Username"><br><br>
                <input type="password" name="password" placeholder="Password"><br><br>
                <button type="submit" name="submit">Login</button>
                <p id="login-error" class="error"></p>
            </form>
        </div>
    </div>
</body>
</html>
