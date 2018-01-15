<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        td {
            padding-top: 10px;
            padding-left: 90px;
            padding-right: 84px;
            padding-bottom: 10px;
            border: 1px solid gray;
        }

        th {
            border: 1px solid black;
        }
    </style>
</head>
<body>
<?php
$conn = mysqli_connect("localhost", "root", "", "ows");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM user";
$result = mysqli_query($conn, $sql);
?>

<table style="border: 1px solid black">
    <tr>
        <th>ID</th>
        <th>firstName</th>
        <th>lastName</th>
        <th>Email</th>
        <th>Edit</th>
        <th>Delete</th>
    </tr>

    <!-- Tao bang -->
    <?php
    while ($row = mysqli_fetch_array($result)) {
        ?>
        <tr>
            <td>
                <?php echo $row['ID']; ?>
            </td>

            <td>
                <?php echo $row['firstName']; ?>
            </td>

            <td>
                <?php echo $row['lastName'] ?>
            </td>

            <td>
                <?php echo $row['email']; ?>
            </td>

            <td>
                <a href='edit.php?ID=<?php echo $row["ID"]; ?>'><img src='image/edit.png' alt='edit'/></a>
            </td>

            <td>
                <a href='delete.php?ID=<?php echo $row["ID"]; ?>'><img src='image/delete.png' alt='delete'/></a>
            </td>
        </tr>
    <?php }
    mysqli_close($conn);
    ?> <!-- Ket thuc vong lap -->
</table>
</body>
</html>
