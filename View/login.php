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
                <input type="text" id="username" name="username" placeholder="Username"><br><br>
                <input type="password" id="password" name="password" placeholder="Password"><br>
                <p style="color: red;" id="login-error" class="error"></p><br>
                <button type="submit" name="submit">Login</button>
                
            </form>
        </div>
    </div>
    <script>
   function validate() {
    let username = document.getElementById('username').value.trim();
    let password = document.getElementById('password').value.trim();
    let errorMsg = document.getElementById('login-error');
    
    errorMsg.innerHTML = "";
    
    if (username == "" || password == "") {
        errorMsg.innerHTML = "null username/password!";
        errorMsg.style.color = 'red';
        return false;
    } else if (username == password) {
        return true;
    } else {
        errorMsg.innerHTML = "invalid user!";
        errorMsg.style.color = 'red';
        return false;
    }
}
</script>
</body>
</html>
