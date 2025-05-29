<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    body {
      background-color: #f4f4f4;
      font-family: Arial, sans-serif;
    }
    h2 {
      text-align: center;
      margin-top: 40px;
    }
    form {
      width: 350px;
      margin: auto;
      background-color: white;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 5px 10px rgba(0,0,0,0.1);
    }
    input[type="text"], input[type="password"] {
      width: 95%;
      padding: 8px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    button {
      width: 100%;
      background-color:rgb(17, 111, 244);
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color:rgb(17, 13, 232);
    }
    .error {
      color: red;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
    <div class="container">
    <!-- Login Form -->
        <div class="login-box">
            <form method="post" action="../controller/loginCheckA.php">
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
