<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login</title>
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
      background-color: #28a745;
      color: white;
      padding: 10px;
      border: none;
      border-radius: 5px;
      font-weight: bold;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
    .error {
      color: red;
      font-size: 0.9em;
    }
  </style>
</head>
<body>
  <h2>Login</h2>
  <form action="../controller/loginCheck.php" method="POST" onsubmit="return validate()">
    <label for="username">Username:</label><br>
    <input type="text" id="username" name="username"><br>
    <p id="uError" class="error"></p>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password"><br>
    <p id="pError" class="error"></p>

    <button type="submit" name="submit">Login</button>
  </form>

  <script>
    function validate() {
      let username = document.getElementById("username").value.trim();
      let password = document.getElementById("password").value.trim();
      let uError = document.getElementById("uError");
      let pError = document.getElementById("pError");

      uError.innerHTML = "";
      pError.innerHTML = "";

      let valid = true;

      if (username === "") {
        uError.innerHTML = "Username is required.";
        valid = false;
      }

      if (password === "") {
        pError.innerHTML = "Password is required.";
        valid = false;
      }

      return valid;
    }
  </script>
</body>
</html>
