<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
    <style>
        th, td {
            padding-left: 90px;
            padding-right: 60px;
        }
        th,td {
            border:1px solid gray;
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
        <tr>
            <td>
                <?php
                foreach($result as $value) {
                    echo $value["ID"] . "<br />";
                }
                ?>
            </td>

            <td>
                <?php
                foreach($result as $value) {
                    echo $value["firstName"] . "<br />";
                }
                ?>
            </td>

            <td>
                <?php
                foreach($result as $value) {
                    echo $value["lastName"] . "<br />";
                }
                ?>
            </td>

            <td>
                <?php
                foreach($result as $value) {
                    echo $value["email"] . "<br />";
                }
                ?>
            </td>
        </tr>
    </table>
</body>
</html>