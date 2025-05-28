<!DOCTYPE html>
<html lang="en">

<head>
    <title>View Profile</title>

      <style>
        body.profile-body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
        }

        .profile-title {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }

        .profile-table {
            width: 50%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            border-radius: 8px;
            overflow: hidden;
        }

        .profile-table td {
            padding: 12px 15px;
        }

        .profile {
            font-weight: bold;
            background-color: #f0f0f0;
            width: 30%;
        }

        .profile-data {
            background-color: #fff;
            color: #555;
        }

        .profile-avatar {
            display: block;
            margin: 0 auto 20px auto;
            border-radius: 50%;
            border: 2px solid #ddd;
        }

        .profile-link {
            display: block;
            width: 150px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .profile-link:hover {
            background-color: #0056b3;
        }

        a[href="../logout.php"] {
            display: block;
            width: 100px;
            margin: 10px auto;
            padding: 8px;
            text-align: center;
            background-color: #dc3545;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        a[href="../logout.php"]:hover {
            background-color: #c82333;
        }
    </style>
   
</head>

<body class="profile-body">
    <h3 class="profile-title">Your Profile</h3>

    <tr>
            <td class="profile">Profile Picture:</td>
            <td class="profile-data">
                <img src="" alt="Avatar" class="profile-avatar" width="90" height="100">
            </td>
        </tr><br>

    <table class="profile-table">
        <tr>
            <td class="profile">Name:</td>
            <td class="profile-data">abc</td>
        </tr>
        <tr>
            <td class="profile">Email:</td>
            <td class="profile-data">abc@example.com</td>
        </tr>
        <tr>
            <td class="profile">Phone:</td>
            <td class="profile-data">01234567890</td>
        </tr>
        
    </table>
    <br>
    <a href="edit.php" class="profile-link">Edit Profile</a><br>

    <a href="../logout.php">logout</a>
   
</body>

</html>
