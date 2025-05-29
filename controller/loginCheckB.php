<?php
session_start();

if (isset($_POST['submit'])) {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if ($username === "" || $password === "") {
        echo "Username or password cannot be empty!";
        exit();
    }

    // Simple check (replace with DB lookup in real use)
    $validUsername = "admin";
    $validPassword = "admin123";

    if ($username === $password) {
        $_SESSION['status'] = true;
       
        header("Location: ../View/unitConversion.php");
        exit();
    } else {
        echo "Invalid username or password!";
        exit();
    }
} else {
   header("Location: ../View/loginB.php");
    exit();
}
?>
