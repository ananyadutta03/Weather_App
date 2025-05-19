<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Profile Picture</title>
    
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