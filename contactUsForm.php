<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us form</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgb(244, 244, 249);
            margin: 0;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100px;
        }
        header {
            text-align: center;
            margin-bottom: 20px;
        }
        header h2 {
            color: #333;
            font-size: 2em;
            margin: 0;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }
        table {
            width: 100%;
        }
        td {
            padding: 10px;
            vertical-align: top;
        }
        label {
            font-weight: bold;
            color: #555;
        }
        input[type="text"] {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 1em;
        }
        input[type="text"]:focus {
            border-color: #007bff;
            outline: none;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
        }
        button {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        p[id$="msg"] {
            margin: 5px 0 0;
            font-size: 0.9em;
        }
        @media (max-width: 600px) {
            form {
                padding: 15px;
            }
            td {
                display: block;
                width: 100%;
            }
            td label {
                margin-bottom: 5px;
            }
        }
    </style>
</head>
<body>
    <header>
        <div align="center"><h2 >Contact Us</h2></div>
    </header>
    <main>
        <form action="" onsubmit="return validate()">
            <table align="center">
                <tr>
                    <td><label for="fullName">full Name:</label></td>
                    <td><input type="text" name=" " id="fname" ></td>
                    <tr>
                        <td>
                            <p id="nmsg" style="color: red;"></p>
                        </td>
                    </tr>
                </tr>
                <tr>
                    <td><label for="email">Email:</label></td>
                    <td><input type="text" name="email" id="email" ></td>
                </tr>
                <tr>
                    <td><p id="emsg" style="color: red;"></p></td>
                </tr>
                <tr>
                    <td><label for="message">Message:</label></td>
                    <td><input type="text" name=" " id="message" ></td>
                    <tr>
                        <td>
                            <p id="mmsg" style="color: red;"></p>
                        </td>
                    </tr>
                </tr>
                <tr>
                    <td>
                        <p>CHAPCHA: what is 5+7</p>
                    </td>
                    <td>
                        <input type="text" name="" id="capcha">
                    </td>
                    <tr>
                        <td>
                            <p id="cmsg" style="color: red;"></p>
                        </td>
                    </tr>
                </tr>
                <tr>
                   <td> <a  href=""><button >SUBMIT</button></a></td>
                </tr>
            </table>
        </form>
    </main>
    <script>
        function validate()
        {

               let fName=document.getElementById("fname").value;
                
                let email=document.getElementById("email").value;
                let capcha=document.getElementById("capcha").value;
                let cmsg=document.getElementById("cmsg")
                let fmsg=document.getElementById("nmsg");
                let emsg=document.getElementById("emsg");
               
    
                if (fName=="")
            {
                fmsg.innerHTML="pleae fill up userid"
                return false;
            }
            else
            {
                fmsg.innerHTML="";
                
            }
            if(capcha==""){
                cmsg.innerHTML="fill in the capcha field";
                return false;
            }
            else
            {
                cmsg.innerHTML=""
            }
             if(email=="")
            {
                emsg.innerHTML="pleae fill up email"
                return false;
            }
            else if (!email.includes("@") || email.indexOf("@") !== email.lastIndexOf("@")) {
                emsg.innerHTML = "Email must contain exactly one '@' symbol";
                    return false;
                }
                else{
                    emsg.innerHTML="";
                }
                return true
        }

    </script>
</body>
</html>