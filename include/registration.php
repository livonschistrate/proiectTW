<?php
include 'db_connect.php';

$conn = OpenCon();
$errors = array();
if (isset($_POST['register'])) {
    $firstname = mysqli_real_escape_string($conn,$_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn,$_POST['lastname']);
    $email = mysqli_real_escape_string($conn,$_POST['email']);
    $password_1 = mysqli_real_escape_string($conn,$_POST['password_1']);
    $password_2 = mysqli_real_escape_string($conn,$_POST['password_2']);

    if($password_1 != $password_2){
        array_push($errors,"Parolele nu se potrivesc! ");
    }
    if (count($errors) == 0){
        $passwordEnc = md5($password);
    $sql = "INSERT INTO users (firstname, lastname, email, password, role) VALUES ('$firstname','$lastname','$email','$passwordEnc','0')";
    mysqli_query($conn, $sql);
    header('location: login.php');
    }
}

CloseCon($conn);
