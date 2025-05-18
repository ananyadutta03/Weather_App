<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Email Verification</title>
  <style>
    body {
      background-color:rgb(249, 249, 249);
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
    }

    h2 {
      text-align: center;
      color: #333;
      margin-top: 40px;
    }

    form {
      width: 100%;
      max-width: 400px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    table {
      width: 100%;
    }

    label {
      font-weight: bold;
    }

    input[type="email"],
    input[type="text"] {
      width: 100%;
      padding: 10px;
      margin-top: 5px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    input[type="submit"] {
      padding: 10px 20px;
      background-color:rgb(65, 40, 167);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-weight: bold;
    }

    input[type="submit"]:hover {
      background-color:rgb(75, 198, 27);
    }

    .error {
      color: red;
      font-size: 14px;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <h2>Email Verification</h2>
  <form onsubmit="return validateForm()">
    <table>
      <tr>
        <td><label for="email">Enter Your Email:</label></td>
        <td><input type="email" name="email" id="email" /></td>
      </tr>
      <tr>
        <td colspan="2"><p id="emailError" class="error"></p></td>
      </tr>
      <tr>
        <td><label for="code">Verification Code:</label></td>
        <td><input type="text" name="code" id="code" /></td>
      </tr>
      <tr>
        <td colspan="2"><p id="codeError" class="error"></p></td>
      </tr>
      <tr>
        <td colspan="2" align="center">
          <input type="submit" value="Verify Email" />
        </td>
      </tr>
    </table>
  </form>

  <script>
    function validateForm() {
      const email = document.getElementById("email").value.trim();
      const code = document.getElementById("code").value.trim();
      const emailError = document.getElementById("emailError");
      const codeError = document.getElementById("codeError");

      emailError.innerHTML = "";
      codeError.innerHTML = "";

      let isValid = true;

      if (email === "") {
        emailError.innerHTML = "Please enter your email.";
        isValid = false;
      } else if (!email.includes("@") || email.indexOf("@") !== email.lastIndexOf("@")) {
        emailError.innerHTML = "Invalid email format.";
        isValid = false;
      }

      if (code === "") {
        codeError.innerHTML = "Please enter the verification code.";
        isValid = false;
      }

      return isValid;
    }
  </script>
</body>
</html>