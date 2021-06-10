<?php
include('db_connect.php');

$conn = OpenCon();

$email = $_POST['email'];
    $password = $_POST['password'];
    $result = mysqli_query($conn,"select * from users where email = '$email' and password = '$password'") or die("Failed to query db ");
    $row = mysqli_fetch_array($result);
    if($row['email'] == $email && $row['password'] == $password ){
    echo "Login ok";
    header('location: indexClient.php');
    }else{
        echo "Failed to login!";
    }
