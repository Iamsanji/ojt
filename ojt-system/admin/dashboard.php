<?php

    require_once(__DIR__ . '/../database.php');
    require_once '../classes/account.class.php';

    $db = new Database();

    $sql = $db->connect()->query("SELECT COUNT(*) as total_students FROM accounts WHERE role = 'student'");
    $sql->bindParam(':admin_id', $admin_id);
    $total_students = $sql->fetch();

    $sql = $db->connect()->query("SELECT COUNT(*) as total_supervisor FROM accounts WHERE role = 'supervisor'");
    $sql->bindParam(':admin_id', $admin_id);
    $supervisor = $sql->fetch();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<a href="../logout.php">logout</a>
<h1>Admin Dashboard Page</h1>

<h3>Total Students</h3>
<p><?= $total_students['total_students'] ?></p>

<h3>Total Supervisor</h3>
<p><?= $supervisor['total_supervisor'] ?></p>

</body>
</html>