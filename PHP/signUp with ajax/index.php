<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        td {
            padding-top: 10px;
            padding-left: 55px;
            padding-right: 55px;
            padding-bottom: 10px;
            border: 1px solid gray;
        }

        th {
            border: 1px solid black;
        }

        table {
            position: fixed;
        }

        a {
            text-decoration: none;
            color: black;
            font-size: 25px;
            font-weight: bold;
            display: inline-block;
            margin-top: 500px;
        }

        span {
            font-size: 25px;
            color: black;
            font-weight: italic;
            display: inline-block;
            margin-top: 500px;
        }

        a:hover {
            color: lightblue;
        }
    </style>
    <!-- Jquery -->
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous">
    </script>
    <script>
        function delete_row(ID) {
            $.ajax({
                url: 'edit_delete.php',
                type: 'post',
                data: {
                    delete_row: "delete_row",
                    row_id: ID,
                },
                success: function(response) {
                    if (response == "success") {
                        var question = confirm("Do you want to delete this record ?");
                        if (question) {
                            var row = document.getElementById("row"+ID);
                            row.parentNode.removeChild(row);
                        }
                        
                    }
                }
            });
        }

        function edit_row(ID) {
            var firstName = document.getElementById("fname"+ID).innerHTML;
            var lastName = document.getElementById("lname"+ID).innerHTML;
            var email = document.getElementById("mail"+ID).innerHTML;

            document.getElementById("fname" + ID).innerHTML = "<input type='text' id='fname_text"+ID+"' value='"+firstName+"'>";
            document.getElementById("lname" + ID).innerHTML = "<input type='text' id='lname_text"+ID+"' value='"+lastName+"'>";
            document.getElementById("mail" + ID).innerHTML = "<input type='email' id='mail_text"+ID+"' value='"+email+"'>";

            document.getElementById("edit_button"+ID).style.display = "none";
            document.getElementById("save_button"+ID).style.display = "inline-block";
            document.getElementById("cancel_button"+ID).style.display = "inline-block";  

        }

        function save_row(ID) {
            var newFirstName = document.getElementById("fname_text"+ID).value;
            var newLastName = document.getElementById("lname_text"+ID).value;
            var newEmail = document.getElementById("mail_text"+ID).value;

            $.ajax({
                url: 'edit_delete.php',
                type: 'post',
                data: {
                    edit_row: "edit_row",
                    row_id: ID,
                    newFirstName: newFirstName,
                    newLastName: newLastName,
                    newEmail: newEmail
                },
                success: function(response) {
                    if (response == "success") {

                        document.getElementById("fname"+ID).innerHTML = newFirstName;
                        document.getElementById("lname"+ID).innerHTML = newLastName;
                        document.getElementById("mail"+ID).innerHTML = newEmail;

                        document.getElementById("edit_button"+ID).style.display = "block";
                        document.getElementById("save_button"+ID).style.display = "none";
                        document.getElementById("cancel_button"+ID).style.display = "none"; 
                        alert("Edited this record"); 
                    }
                    else if (response == "email type is incorrect") {
                        alert ("email type is incorrect");
                    }
                    else {
                        alert ("Please Fill All The Details");
                    }
                }
            });   
        }

        function cancel_row(ID) {
            var firstName = document.getElementById("fname_text"+ID).value;
            var lastName = document.getElementById("lname_text"+ID).value;
            var email = document.getElementById("mail_text"+ID).value;

            document.getElementById("fname"+ID).innerHTML = firstName;
            document.getElementById("lname"+ID).innerHTML = lastName;
            document.getElementById("mail"+ID).innerHTML = email;

            document.getElementById("edit_button"+ID).style.display = "block";
            document.getElementById("save_button"+ID).style.display = "none";
            document.getElementById("cancel_button"+ID).style.display = "none";  
        }
    </script>
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

    <!-- Thuat toan phan trang -->
    <?php
        //Xu ly PHP
        $connect = mysqli_connect("localhost", "root", "", "ows");

        if (!$connect) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Dem tong so ban ghi cua DB
        $sql = "SELECT COUNT(ID) as total FROM user";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_array($result);
        $total_records = $row['total'];

        //Tim limit va page hien tai
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $limit = 10;

        // Tinh tong so trang can thiet
        $total_page = ceil($total_records / $limit);

        // Gioi han current page
        if ($current_page > $total_page) {
            $current_page = $total_page;
        }
        else if ($current_page < 1) {
            $current_page = 1;
        }

        // Tim start cua moi trang
        $start = ($current_page - 1) * $limit;

        // Truy van lay danh sach
        $query = mysqli_query($conn, "SELECT * FROM user LIMIT $start, $limit");

    ?>
    <!-- Thanh Tim Kiem -->
    <form action="edit_delete.php" method="post">
        <input type="text" name="search" value="Search" />
    </form>
    
    <!-- Hien thi danh sach ban ghi theo LIMIT -->
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
        while ($row = mysqli_fetch_array($query)) {
        ?>
            <tr id="row<?php echo $row['ID']; ?>">

                <td id="id<?php echo $row['ID']; ?>">
                    <?php echo $row['ID']; ?>
                </td>

                <td id="fname<?php echo $row['ID']; ?>">
                    <?php echo $row['firstName']; ?>
                </td>

                <td id="lname<?php echo $row['ID']; ?>">
                    <?php echo $row['lastName']; ?>
                </td>

                <td id="mail<?php echo $row['ID']; ?>">
                    <?php echo $row['email']; ?>
                </td>

                <td>
                    <input type="image" src="image/edit.png" class="edit_button" id="edit_button<?php echo $row['ID'];?>" onclick="edit_row('<?php echo $row['ID'];?>');">

                    <input type='button' style="display: none;" value="Save" class="save_button" id="save_button<?php echo $row['ID'];?>"  onclick="save_row('<?php echo $row['ID'];?>');">

                    <input type='button' style="display: none;" value="Cancel" class="cancel_button" id="cancel_button<?php echo $row['ID'];?>"  onclick="cancel_row('<?php echo $row['ID'];?>');">        
                </td>

                <td>
                    <input type='image' src="image/delete.png" class="delete_button" id="delete_button<?php echo $row['ID'];?>"  onclick="delete_row('<?php echo $row['ID'];?>');">
                </td>
            </tr>
    <?php } ?>
     </table>

     <!-- Hien thi phan trang, cac nut chuyen trang -->
    <?php

        echo '<a href="index.php?page=1">First</a> | ';

        // Nut Prev
        if ($current_page > 1 && $total_page > 1) {
            echo '<a href="index.php?page='.($current_page - 1).'">Prev</a> | ';
        }
        
        // Chi hien thi nhung nut gan ke 
        if ($current_page - 2 <= 0) {
            echo '<span>'.$current_page.'</span> | ';
            echo '<a href="index.php?page='.($current_page + 1).'">'.($current_page + 1).'</a> | ';
            echo '<a href="index.php?page='.($current_page + 2).'">'.($current_page + 2).'</a> | ';
        }
        else if ($total_page < ($current_page + 2)) { 
            echo '<a href="index.php?page='.($current_page - 1).'">'.($current_page - 1).'</a> | ';
            echo '<a href="index.php?page='.($current_page - 2).'">'.($current_page - 2).'</a> | ';
            echo '<span>'.$current_page.'</span> | ';
        }
        else {
            echo '<a href="index.php?page='.($current_page - 2).'">'.($current_page - 2).'</a> | ';
            echo '<a href="index.php?page='.($current_page - 1).'">'.($current_page - 1).'</a> | ';
            echo '<span>'.$current_page.'</span> | ';
            echo '<a href="index.php?page='.($current_page + 1).'">'.($current_page + 1).'</a> | ';
            echo '<a href="index.php?page='.($current_page + 2).'">'.($current_page + 2).'</a> | ';
        }

        //Neu current_page < total_page va total_page > 1 moi hien thi nut prev
        if ($current_page <= $total_page && $total_page > 1) {
            echo '<a href="index.php?page='.($current_page + 1).'">Next</a> | ';
        }

        echo '<a href="index.php?page='.($total_page).'">Last</a>';
    ?>
</table>
</body>
</html>
