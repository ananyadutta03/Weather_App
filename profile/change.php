<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Profile Picture</title>

    <style>
        body.avatar-body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .avatar-container {
            background-color: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 320px;
        }

        .avatar-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
        }


        .avatar-preview:hover {
            transform: scale(1.05);
        }

        .avatar-form-group {
            margin-bottom: 15px;
            text-align: left;
        }

        .avatar-form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
            color: #555;
        }

        .avatar-input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        .avatar-submit-btn {
            width: 100%;
            padding: 10px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 14px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .avatar-submit-btn:hover {
            background-color: #0056b3;
        }

        .avatar-link {
            display: block;
            margin-top: 15px;
            font-size: 14px;
            color: #007bff;
            text-decoration: none;
        }

        .avatar-link:hover {
            text-decoration: underline;
        }

        .error-message {
            color: red;
            font-size: 13px;
            margin-top: 5px;
            display: block;
        }
    </style>
    
</head>

<body class="avatar-body">
    <div class="avatar-container">
        <h3 class="avatar-title">Update Your Profile Picture</h3>

        <img src="th.jpeg"
            alt="Current Profile Picture" class="avatar-preview" width="100" height="100">

        <form class="avatar-form" onsubmit="return validateAvatarForm()" action="upload-avatar.php" method="post"
            enctype="multipart/form-data">
            <div class="avatar-form-group">
                <label for="avatarFile">Choose New Profile Picture</label>
                <input type="file" id="avatarFile" name="avatarFile" class="avatar-input">
            </div>
            <span id="imageError" class="error-message"></span>

            <button type="submit" class="avatar-submit-btn">Save Profile Picture</button>

        </form>

        <a href="edit-profile.php" class="avatar-link">Return to Profile Settings</a>
    </div>

    <script>
        function validateAvatarForm() {
            var fileInput = document.getElementById("avatarFile");
            var imageError = document.getElementById("imageError");
            var filePath = fileInput.value;
            var isValid = true;

            imageError.innerHTML = "";

            if (filePath === "") {
                imageError.innerHTML = "Please choose an image file.";

                isValid = false;
            }

            return isValid;
        }
    </script>

</body>

</html>