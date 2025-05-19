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
            <h2>Login to Weather App</h2>
            <input type="text" id="username" placeholder="Username"><br><br>
            <input type="password" id="password" placeholder="Password"><br><br>
            <button onclick="handleLogin()">Login</button>
            <p id="login-error" class="error"></p>
        </div>
    </div>
</body>
</html>