<?php

    require_once 'classes/functions.php';
    require_once 'config/database.php';

    session_start();

    $email = $password = "";
    $accountObj = new Account();
    $loginErr = '';

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = clean_input($_POST['email']);
        $password = clean_input($_POST['password']);

        if ($accountObj->login($email, $password)) {
            $data = $accountObj->fetch($email);
            $_SESSION['account'] = $data;

            if ($data['role'] === 'student') {
                header('location: students/student_landing.php'); 
            } elseif ($data['role'] === 'admin') {
                header('location: admin/dashboard.php'); 
            } elseif ($data['role'] === 'supervisor') {
                header('location: supervisor/dashboard.php');
            } else {
                header('location: dashboard.php'); 
            }
        } else {
            $loginErr = 'Invalid email/password';
        }
    } else {
        if (isset($_SESSION['account'])) {
    
            if ($_SESSION['account']['role'] === 'staff') {
                header('location: secretary.php'); 
            } elseif ($_SESSION['account']['role'] === 'customer') {
                header('location: user-landing.php'); 
            } else {
                header('location: dashboard.php'); 
            }
        }
    }
    

?>