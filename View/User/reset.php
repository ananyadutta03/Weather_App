<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <style>
        body {
            
            background-color: rgb(249, 249, 249);
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 50px;
            color: #333;
        }

        form {
            background-color: #fff;
            padding: 30px 40px;
            margin: 0 auto;
            width: 400px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
        }

        td {
            padding: 10px;
        }

        label {
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }

        input[type="email"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        input[type="submit"] {
            background-color: #007BFF;
            color: white;
            padding: 10px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <h2 align="center">Reset Password</h2>
    <form onsubmit="return validate()">
        <table align="center">
            <tr>
                <td><label for="email">Enter Your Email:</label></td>
                <td><input type="email" name="email" required></td>
            </tr><br>

            <tr>
                <td><p id="emsg" style="color: rgb(248, 3, 3);"></p></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" value="Send Reset Link">
                </td>
            </tr>
        </table>
    </form>
<script>

function validate()
    {
        let email=document.getElementById("email").value;
    
        let emsg=document.getElementById("emsg");

    if (email==="")
    {
       emsg.innerHTML="please fill up userid";
       return false;

    }
    else if (!email.includes("@") || email.indexOf("@") !== email.lastIndexOf("@")) {
            emsg.innerHTML = "Email must contain exactly one '@' symbol";
                return false;
    
    }
    else
    {
        emsg.innerHTML=""
    }
    return true;
}
    </script>
</body>