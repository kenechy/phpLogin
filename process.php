<?php
session_start();    
include("config.php");

if(isset($_POST["registerButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];
    $fname = $_POST['fname'];
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '' ;
    $lname = $_POST['lname'];

    $check_email_query = "SELECT * FROM `user` WHERE `email` = '$email'";
    $email_result = mysqli_query($con,$check_email_query);
    $email_count = mysqli_fetch_array($email_result)[0];

    if($email_count > 0){
        $_SESSION['status'] = "Email address already taken";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }

    if ($password !== $repassword){
        $_SESSION['status'] = "Password does not match";
        $_SESSION['status_code'] = "error";
        header("Location: register.php");
        exit();
    }


    $query = "INSERT INTO `user`(`email`, `password`, `fname`, `mname`, `lname`) VALUES ('$email','$password','$fname','$mname','$lname')";
    $query_result = mysqli_query( $con, $query );

    if($query_result){
        $_SESSION['status'] = "Registration Sucess!";
        $_SESSION['status_code'] = "success";
        header("Location: login.php");
        exit();
    }
}


if(isset($_POST["loginButton"])){

    $email = $_POST['email'];
    $password = $_POST['password'];

    $login_query = "SELECT `id`, `email`, `password`, `fname`, `mname`, `lname` FROM `user` WHERE `email` = '$email' AND `password` = '$password' LIMIT 1 ";
    $login_result = mysqli_query($con, $login_query);

    if(mysqli_num_rows($login_result) == 1){
            $_SESSION['status'] = "Welcome!";
            $_SESSION['status_code'] = "success";
            header("Location: index.php");
            exit();
    }else{
        $_SESSION['status'] = "Invalid Username/Password";
        $_SESSION['status_code'] = "error";
        header("Location: login.php");
        exit();
    }
}

if(isset($_POST["submitButton"])){

    $student_number = $_POST['student_number'];
    $fname = $_POST['fname'];
    $mname = isset($_POST['mname']) ? $_POST['mname'] : '' ;
    $lname = $_POST['lname'];
    $date_of_birth = $_POST['date_of_birth'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $check_email_query = "SELECT * FROM `student` WHERE `email` = '$email'";
    $email_result = mysqli_query($con,$check_email_query);
    $email_count = mysqli_fetch_array($email_result)[0];

    if($email_count > 0){
        $_SESSION['status'] = "Email address already taken";
        $_SESSION['status_code'] = "error";
        header("Location: insert.php");
        exit();
    }

    $student_number_query = "SELECT * FROM `student` WHERE `student_number` = '$student_number'";
    $student_number_result = mysqli_query($con,$student_number_query);
    $student_number_count = mysqli_fetch_array($student_number_result)[0];

    if($student_number_count > 0){
        $_SESSION['status'] = "Student ID address already taken";
        $_SESSION['status_code'] = "error";
        header("Location: insert.php");
        exit();
    }
   

    $submit_query = "INSERT INTO `student`(`student_number`, `fname`, `mname`, `lname`, `date_of_birth`, `email`, `phone_number`, `address`) 
    VALUES ('$student_number','$fname','$mname','$lname','$date_of_birth','$email','$phone_number','$address')";
    $submit_result = mysqli_query($con, $submit_query);

    if($submit_query){
        $_SESSION['status'] = "Insert Successfully";
        $_SESSION['status_code'] = "success";
        header("Location: insert.php");
        exit();
    }else{
        $_SESSION['status'] = "error";
        $_SESSION['status_code'] = "error";
        header("Location: insert.php");
        exit();
    }
}
?>