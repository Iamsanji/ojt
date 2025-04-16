<?php

    require_once 'classes/functions.php';
    require_once 'classes/account.class.php';

    session_start();

    $email = $password = '';
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
                header('location: login.php'); 
            }
        } else {
            $loginErr = 'Invalid email/password';
        }
    } else {
        if (isset($_SESSION['account'])) {
    
            if ($_SESSION['account']['role'] === 'admin') {
                header('location: admin/dashboard.php'); 
            } elseif ($_SESSION['account']['role'] === 'student') {
                header('location: students/student_landing.php'); 
            } else {
                header('location: login.php'); 
            }
        }
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign in</title>
    <link rel = "stylesheet" href = "styles/sign.css">
    
</head>
<body>
    <div class="container">

        <div class="card">
            
            <div class="sign-form">
                    <form action="login.php" method="post">
                        <h2>Sign in</h2>
                        <label for="email">Username/Email</label>
                        
                        <input type="text" name="email" id="email">
                        
                        <label for="password">Password</label>
                        
                        <input type="password" name="password" id="password">
                        
                        <input type="submit" value="Sign in" name="login">
                        <?php
                        if (!empty($loginErr)) {
                        ?>
                            <p class="error"><?= $loginErr ?></p>
                        <?php
                        }
                        ?>
                    </form>
            </div>
        </div>
    </div>
</body>
</html>