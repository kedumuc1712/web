<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <script src="ajax.js"></script>
    <!-- Add Jquery -->
    <script
        src="https://code.jquery.com/jquery-3.2.1.min.js"
        integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
        crossorigin="anonymous"></script>
    <!-- AJAX -->
    <script>
        function searchFilter(page_num) {
            page_num = page_num ? page_num : 0;
            var keywords = $('#keywords').val();
            var sortBy = $('#sortBy').val();
            $.ajax({
                type: 'POST',
                url: 'getData.php',
                //data:'page='+page_num+'&keywords='+keywords+'&sortBy='+sortBy,
               	data : {
                	page: page_num,
                	keywords: keywords,
                	sortBy: sortBy
                },
                success: function (html) {
                    $('#posts_content').html(html);
                  
                }
            });
        }
    </script>
</head>
<body>
<div class="post-search-panel" style="margin-bottom: 15px;">
    <input type="text" id="keywords" placeholder="Search here !" onkeyup="searchFilter()"/>
    <select id="sortBy" onchange="searchFilter()">
        <option value="">Sort By</option>
        <option value="asc">Ascending</option>
        <option value="desc">Descending</option>
    </select>
</div>
<div class="post-wrapper">

    <div id="posts_content">
        <?php

        include('pagination.php');
        include('dbConfig.php');

        $limit = 10;

        //Tinh tong so ban ghi
        $queryNum = $connect->query("SELECT COUNT(*) as postNum FROM user");
        $resultNum = $queryNum->fetch_assoc();
        $rowCount = $resultNum['postNum'];

        //initialize pagination class
        $pagConfig = array(
            'totalRows' => $rowCount,
            'perPage' => $limit,
            'link_func' => 'searchFilter'
        );

        $pagination =  new Pagination($pagConfig);

        //get rows
        $query = $connect->query("SELECT * FROM user ORDER BY ID DESC LIMIT $limit");
        ?>

        <div id="posts_list">
            <table style="border: 1px solid black" >
                <tr>
                    <th>ID</th>
                    <th>firstName</th>
                    <th>lastName</th>
                    <th>Email</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>

        <?php while ($row = $query->fetch_assoc()) { ?>
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
                        <input type="image" src="image/edit.png" class="edit_button"
                               id="edit_button<?php echo $row['ID']; ?>"
                               onclick="edit_row('<?php echo $row['ID']; ?>');">

                        <input type='button' style="display: none;" value="Save" class="save_button"
                               id="save_button<?php echo $row['ID']; ?>" onclick="save_row('<?php echo $row['ID']; ?>');">

                        <input type='button' style="display: none;" value="Cancel" class="cancel_button"
                               id="cancel_button<?php echo $row['ID']; ?>"
                               onclick="cancel_row('<?php echo $row['ID']; ?>');">
                    </td>

                    <td>
                        <input type='image' src="image/delete.png" class="delete_button"
                               id="delete_button<?php echo $row['ID']; ?>"
                               onclick="delete_row('<?php echo $row['ID']; ?>');">
                    </td>
                </tr>
        <?php } ?>
        </table>
    </div>

    <?php  echo $pagination->createLinks(); ?>
</div>
</body>
</html>