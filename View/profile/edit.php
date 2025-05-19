<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
</head>
<body>
    <h3 class="edit-title">Edit Your Profile</h3>
    <img src="" alt="Avatar" class="profile-avatar" width="90" height="100">
    <form onsubmit="return validate()">
        <table>
            <tr>
                <td><label for="name">Full Name:</label></td>
                <td><input type="text" id="name" name="name" /></td>
            </tr>
            <tr>
                <td></td>
                <td><p id="ename"></p></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="text" id="email" name="email" /></td>
            </tr>
            <tr>
                <td></td>
                <td><p id="eemail"></p></td>
            </tr>
            <tr>
                <td><label for="phone">Phone Number:</label></td>
                <td><input type="text" id="phone" name="phone" /></td>
            </tr>
            <tr>
                <td></td>
                <td><p id="ephone"></p></td>
            </tr>
            <tr>
                <td><input type="submit" value="Save Changes" /></td>
            </tr>
        </table>
        <p id="succMsg"></p>
    </form>

    <script>
        function validate() {
            var name = document.getElementById("name").value;
            var email = document.getElementById("email").value;
            var phone = document.getElementById("phone").value;
            var ename = document.getElementById("ename");
            var eemail = document.getElementById("eemail");
            var ephone = document.getElementById("ephone");
            var succMsg = document.getElementById("succMsg");
            var isValid = true;

            
            if (name == "") {
                ename.innerHTML = "Name cannot be empty.";
                ename.style.color = "red";
                isValid = false;
            } else {
                ename.innerHTML = "";
            }

            
            if (email == "") {
                eemail.innerHTML = "Email cannot be empty.";
                eemail.style.color = "red";
                isValid = false;
            } else if (!email.includes("@") || email.indexOf("@") !== email.lastIndexOf("@")) {
                eemail.innerHTML = "Email must contain exactly one '@' symbol.";
                eemail.style.color = "red";
                isValid = false;
            } else {
                eemail.innerHTML = "";
            }

            
            if (phone == "") {
                ephone.innerHTML = "Phone number cannot be empty.";
                ephone.style.color = "red";
                isValid = false;
            } else if (isNaN(phone) || phone.length != 11) {
                ephone.innerHTML = "Phone number must be 11 digits.";
                ephone.style.color = "red";
                isValid = false;
            } else {
                ephone.innerHTML = "";
            }

            
            if (isValid) {
                succMsg.innerHTML = "Profile updated successfully!";
                succMsg.style.color = "blue";
            } else {
                succMsg.innerHTML = "";
            }

            return false; 
        }
    </script>
</body>
</html>