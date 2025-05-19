<!<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Password</title>
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
<a align="center" href="edit-profile.php" class="password-link">Back to Edit Profile</a>

</html>