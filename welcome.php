<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<body style="background-color:Khaki;">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1 style = "font-family: Broadway; color : CadetBlue;">Hi, <b style = "font-family: Colonna MT; color: black;"><?php echo htmlspecialchars($_SESSION["username"]); ?></b>. Welcome to our site.</h1>
    </div> 
    <form method="get" action="search.php" enctype="multipart/form-data">
    <input type="text" name="name" size = "25" placeholder = "Staff Search" style = "font-family: Colonna MT;"/> 
    <input type="submit" name="search" value="Search Now" style = "font-family: Colonna MT;" /> 
    </form><br>
    <p>
        <a href="reset-password.php" class="btn btn-info" style = "font-family: Colonna MT;">Reset Your Password</a>
        <a href="logout.php" class="btn btn-danger" style = "font-family: Colonna MT;">Sign Out of Your Account</a>
        <a href="index.php" class="btn btn-primary" style = "font-family: Colonna MT;">Staff Portal</a>
    </p>
</body>
</html>