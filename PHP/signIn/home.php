<?php session_start(); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <style type="text/css">
        a {
            text-decoration: none;
            color: lightblue;
            font-size: 20px;
        }
    </style>
</head>
<body>
<?php
//Check session
if (isset($_SESSION["email"])) {
    echo "You haved logined" . "<br />";

    echo 'Click here to <a href="logout.php">Logout</a>';
    //header("Location:logout.php");
} else {
    echo "You haved not logined before" . "<br />";

    echo 'Click here to <a href="login.php">Login</a>';
}
?>

</body>
</html>