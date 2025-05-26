<!<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Authentication</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(228, 244, 232);
            margin: 0;
            padding: 0;
        }
        h2 {
            color: rgb(112, 111, 111);
            text-align: center;
            margin-top: 30px;
        }
        form {
            background-color: white;
            width: 400px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="radio"] {
            margin-right: 5px;
        }
        input[type="submit"] {
            background-color: rgb(0, 123, 255);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error-message {
            color: red;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <h2 align="center">User Sign up</h2>
    <form action="" onsubmit="return validate()">
        <table align="center">
            <tr>
                <td><label for="firstname">First Name:</label></td>
                <td><input type="text" name="firstname" id="fname" ></td>
            </tr>
            <tr>
                <td><p id="fmsg" class="panic" style="color: red;"></p></td>
            </tr>
            <tr>
                <td><label for="lastname">Last Name:</label></td>
                <td><input type="text" name="lastname" id="lname"></td>
            </tr>
            <tr>
                <td><p id="lmsg" style="color: red;"></p></td>
            </tr>
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="email" name="email" id="email" ></td>
            </tr>
            <tr>
                <td><p id="emsg" style="color: red;"></p></td>
            </tr>
            <tr>
                <td><label for="gender">Gender:</label></td>
                <td>
                    <input type="radio" name="gender" id="" value="male">male
                    <input type="radio" name="gender" id="female">female
                    <input type="radio" name="gender" id="other">other

                </td>
            </tr>
            <tr>
                <td><p id="gmsg" style="color: red;"></p></td>
            </tr>
            
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="password" id="pass" ></td>
            </tr>
            <tr>
                <td><p id="pmsg" style="color: red;"></p></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="SignUp">
                    <a href="login.php" class="profile-link">clogin</a><br>
                </td>
            </tr>
        </table>
        
    </form>
    

    <script>
        function validate()
        {
            let fName=document.getElementById("fname").value;
            let lName=document.getElementById("lname").value;
            let email=document.getElementById("email").value;
            let password=document.getElementById("pass").value;
            let fmsg=document.getElementById("fmsg");
            let lmsg=document.getElementById("lmsg");
            let emsg=document.getElementById("emsg");
            let pmsg=document.getElementById("pmsg");

            if (fName=="")
        {
            fmsg.innerHTML="pleae fill up userid"
            return false;

        }
        else
        {
            fmsg.innerHTML="";
        }
         if(lName=="")
        {
            lmsg.innerHTML="pleae fill up userid"
            return false;
        }
        else{
            lmsg.innerHTML="";
        }
         if(email=="")
        {
            emsg.innerHTML="pleae fill up userid"
            return false;
        }
        else if (!email.includes("@") || email.indexOf("@") !== email.lastIndexOf("@")) {
            emsg.innerHTML = "Email must contain exactly one '@' symbol";
                return false;
            }
            else{
                emsg.innerHTML="";
            }
         if(password=="")
        {
            pmsg.innerHTML="pleae fill up userid"
            return false;
        }
        else
        {
            pmsg.innerHTML="";
        }
        return true;
        }
    </script>
</body>
</html>