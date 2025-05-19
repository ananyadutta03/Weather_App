<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        body {
        
            background-color: rgb(174, 176, 179);
            margin: 0;
            padding: 0;
        }
        h2 {
            text-align: center;
            margin-top: 40px;
            color: rgb(90, 89, 89);
        }
        form {
            width: 350px;
            margin: auto;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 5px 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
        }
        input[type="text"],
        input[type="password"] {
            width: 95%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: rgb(57, 194, 89);
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: rgb(21, 82, 203);
        }
        .error {
            color: red;
            font-size: 0.9em;
        }
        a {
            text-decoration: none;
            color: rgb(0, 123, 255);
        }
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <h2 align="center">Login</h2>
    <form action="check.php"  onsubmit="return validate()">
        <table align="center">
            <tr>
                <td><label for="email">Email:</label></td>
                <td><input type="text" name="email" id="email"></td>
            </tr>
            <tr>
                <td><p id="emsg" style="color: rgb(248, 3, 3);"></p></td>
            </tr>
            <tr>
                <td><label for="password">Password:</label></td>
                <td><input type="password" name="password" id="password" ></td>
            </tr>
            <tr>
                <td><p id="msg" style="color: rgb(250, 9, 9);"></p></td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <a href="/ActivityFeed.html"><button>Login</button></a>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <a href="reset authen.html">Forgot Password?</a><br>
                    <a href="email verifi authen.html">Verify Email</a><br>
                    
                    
                    
                </td>
            </tr>
        </table>
    </form>
    <script>
    function validate()
    {
        let email=document.getElementById("email").value;
        let password=document.getElementById("password").value;
    
        let fmsg=document.getElementById("emsg");
        let msg=document.getElementById("msg");

        if (password=="")
        {
            fmsg.innerHTML="please fill up password"
            return false;
        }
        else
        {
            fmsg.innerHTML=""
        }
        if (email==="")
    {
       fmsg.innerHTML="please fill up userid";
       return false;

    }
    else if (!email.includes("@") || email.indexOf("@") !== email.lastIndexOf("@")) {
            emsg.innerHTML = "Email must contain exactly one '@' symbol";
                return false;
    
    }
    else
    {
        fmsg.innerHTML=""
    }
    return true;
        
    }

</script>
</body>
</html>