<!DOCTYPE html>
<html lang="en">
<head>
    <title>Edit Profile</title>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fa;
            padding: 32px;
            margin: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            min-height: 100vh;
        }

        .edit-title {
            text-align: center;
            color: #1a1a1a;
            font-size: 1.75rem;
            font-weight: 600;
            margin-bottom: 24px;
            letter-spacing: -0.02em;
        }

        form {
            background-color: #ffffff;
            max-width: 520px;
            width: 100%;
            margin: 16px auto;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        form:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 12px 8px;
            vertical-align: top;
        }

        label {
            font-size: 0.9rem;
            font-weight: 500;
            color: #333;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px 12px;
            border: 1px solid #d1d5db;
            border-radius: 6px;
            font-size: 0.95rem;
            color: #1a1a1a;
            background-color: #fafafa;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
            box-sizing: border-box;
        }

        input[type="text"]:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        input[type="submit"] {
            background-color: #3b82f6;
            color: #ffffff;
            padding: 12px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-size: 1rem;
            font-weight: 500;
            transition: background-color 0.2s ease, transform 0.1s ease;
        }

        input[type="submit"]:hover {
            background-color: #2563eb;
            transform: translateY(-1px);
        }

        input[type="submit"]:active {
            transform: translateY(0);
        }

        .profile-avatar {
            display: block;
            margin: 0 auto 24px;
            border-radius: 10px;
            border: 2px solid #e5e7eb;
            object-fit: cover;
            transition: border-color 0.2s ease;
        }

        .profile-avatar:hover {
            border-color: #3b82f6;
        }

        p {
            font-size: 0.85rem;
            margin: 4px 0 0;
            min-height: 20px;
        }

        .error {
            color: #ef4444;
            font-weight: 400;
        }

        #succMsg {
            text-align: center;
            font-weight: 500;
            margin-top: 16px;
            font-size: 0.95rem;
            color: #3b82f6;
        }

        .profile-link {
            display: inline-block;
            margin-top: 12px;
            font-size: 0.9rem;
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .profile-link:hover {
            color: #2563eb;
            text-decoration: underline;
        }

        /* Responsive Design */
        @media (max-width: 480px) {
            body {
                padding: 16px;
            }

            .edit-title {
                font-size: 1.5rem;
            }

            form {
                padding: 16px;
            }

            td {
                padding: 8px 4px;
            }

            input[type="text"],
            input[type="submit"] {
                font-size: 0.9rem;
            }

            .profile-avatar {
                width: 80px;
                height: 80px;
            }
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
                <td><a href="change.php" class="profile-link">Change</a></td>
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