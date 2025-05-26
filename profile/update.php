<!<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>

        <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #eef1f5;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 25px;
            max-width: 500px;
            margin: auto;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
        }

        input[type="text"], input[type="password"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #007bff;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .password-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            text-decoration: none;
        }

        .password-link:hover {
            text-decoration: underline;
        }
    </style>

</head>
<body>
    <h2 >Update Password</h2>
    <form action="" onsubmit="return validate()">
        <table >
            <tr>
                <td><label for="password">Current Password:</label></td>
                <td><input type="text" name="password" id="cpass" ></td>
            </tr>
            <tr>
                <td><p id="cpass" class="panic" style="color: red;"></p></td>
            </tr>
            <tr>
                <td><label for="password">New Password::</label></td>
                <td><input type="text" name="password" id="npass"></td>
            </tr>
            <tr>
                <td><p id="npass" style="color: red;"></p></td>
            </tr>
            <tr>
                <td><label for="password">Confirm Password:</label></td>
                <td><input type="password" name="password" id="conpass" ></td>
            </tr>
            <tr>
                <td><p id="conpass" style="color: red;"></p></td>
            </tr>
            
            
            <tr>
                <td colspan="2" >
                    <input type="submit" value="SignUp">
                </td>
            </tr>
        </table>
        
    
    </form>

    <script>
        function validate() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var nameError = document.getElementById("nameError");
            var emailError = document.getElementById("emailError");
            var phoneError = document.getElementById("phoneError");
            var successMsg = document.getElementById("successMsg");
            var isValid = true;

            if (name === "") {
                nameError.innerHTML = "Name cannot be empty.";
                nameError.style.color = "red";
                isValid = false;
            } else {
                nameError.innerHTML = "";
            }

            if (email === "") {
                emailError.innerHTML = "Email cannot be empty.";
                emailError.style.color = "red";
                isValid = false;
            } else if (!(email.includes("@") && email.includes("."))) {
                emailError.innerHTML = "Enter a isValid email address.";
                emailError.style.color = "red";
                isValid = false;
            } else {
                var at = email.indexOf("@"), dot = email.lastIndexOf(".");
                if (at < 1 || dot < at + 2 || dot + 2 >= email.length) {
                    emailError.innerHTML = "Enter a isValid email address.";
                    emailError.style.color = "red";
                    isValid = false;
                } else {
                    emailError.innerHTML = "";
                }
            }

            if (phone === "") {
                phoneError.innerHTML = "Phone number cannot be empty.";
                phoneError.style.color = "red";
                isValid = false;
            } else if (isNaN(phone) || phone.length != 11) {
                phoneError.innerHTML = "Phone number must be 11 digits.";
                phoneError.style.color = "red";
                isValid = false;
            } else {
                phoneError.innerHTML = "";
            }

            if (isValid) {
                successMsg.innerHTML = "Profile updated successfully!";
                successMsg.style.color = "green";

            }

            return false;
        }
    </script>
</body>
<a align="center" href="edit.php" class="password-link">Back to Edit Profile</a>

</html>