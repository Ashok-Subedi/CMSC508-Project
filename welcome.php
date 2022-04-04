<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            font: 14px sans-serif;
            text-align: center;
        }
    </style>
</head>

<body>
    <h1 class="my-5">Hi, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to Quick & Easy.</h1>
    <h2 class="my-5">We are glad to have you!!</h2>

    <p class="my-5">
        <a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger ml-3">Sign Out of Your Account</a>
    </p>

    <ul>
        <a href="employees.php" class="btn btn-primary">List all employees</a>
    
        <a href="addEmployee.php"class="btn btn-success ml-5">Add Employee</a>

    </ul>

</body>

</html>