<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>DELETE</title>
    <!--CSS -->
    <style>
        form {
            text-align: center;
        }
    </style>
    
    <!-- PHP Code -->
    <?php
    // Ket noi PHP voi MySql
    $conn = mysqli_connect("localhost", "root", "", "ows");

    //Khong ket noi duoc thi dung chuong trinh
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $id = $_GET["ID"];
    $sql = "SELECT ID FROM user WHERE ID = '$id'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    if (isset($_POST["agree_delete"])){
        $userId = $_POST["userId"];
        $del = mysqli_query($conn, "DELETE FROM user WHERE ID = '$userId'");

        if ($del) {
            header("Location: data.php");
        } else {
            header("Location: data.php");
        }
    }
    else if (isset($_POST["disagree"])){
        header("Location: data.php");
    }

    mysqli_close($conn);

    ?>
</head>
<body>

    <form action="delete.php" method="post">
        <input type="hidden" name="userId" value="<?php echo $row['ID']; ?>"/>
        <h1>Do you want to delete this record ?</h1>
        <input type="submit" name="agree_delete" value="Yes" />
        <input type="submit" name="disagree" value="No" />
    </form>
</body>
</html>

