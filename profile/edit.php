<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f5f9;
            padding: 40px;
        }

        .edit-title {
            text-align: center;
            color: #333;
        }

        form {
            background-color: #fff;
            max-width: 500px;
            margin: 20px auto;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .profile-avatar {
            display: block;
            margin: 0 auto 20px;
            border-radius: 8px;
            border: 2px solid #ccc;
        }

        p {
            font-size: 14px;
            margin: 0;
        }

        .error {
            color: red;
        }

        #succMsg {
            text-align: center;
            font-weight: bold;
            margin-top: 10px;
        }
    </style>
    
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