<?php
require_once("../model/userModel.php");
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['email']) && 
    isset($_POST['gender']) && isset($_POST['password'])) {

    $firstName = trim($_POST['first_name']);
    $lastName  = trim($_POST['last_name']);
    $email     = trim($_POST['email']);
    $gender    = $_POST['gender'];
    $password  = trim($_POST['password']);

   
    if ($firstName == "") {
        echo "First name is required!";
    } else if ($lastName == "") {
        echo "Last name is required!";
    } else if ($email == "") {
        echo "Email is required!";
    } else if (!str_contains($email, "@") || substr_count($email, "@") !== 1) {
        echo "Email must contain exactly one '@' symbol!";
    } else if ($gender != "male" && $gender != "female" && $gender != "other") {
        echo "Invalid gender selected!";
    } else if ($password == "") {
        echo "Password is required!";
    } else if (strlen($password) < 8) {
        echo "Password must be at least 8 characters long!";
    } else {
        $user=['firstName'=>$firstName,'lastName'=>$lastName,'email'=>$email,'gender'=>$gender,'password'=>$password];
        $status=addUser($user);
        if ($status) {

            header("Location: ../view/User/login.php");
        }
        else{
            header("Location: ../view/User/signup.html");
        }

      
    }

} else {
    echo "invalid echo!";
}
?>