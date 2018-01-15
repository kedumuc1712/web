<?php
if(isset($_POST['page'])){

    include('pagination.php');
    include('dbConfig.php');

    $start = isset($_POST['page']) ? $_POST['page'] : 0;
    $limit = 10;

    //Truy van SQL
    $whereSQL = $orderSQL = '';
    $keywords = $_POST['keywords'];
    $sortBy = $_POST['sortBy'];
    if(isset($keywords)){
        $whereSQL = "WHERE (ID LIKE '%".$keywords."%')
        OR (firstName LIKE '%".$keywords."%')
        OR (lastName LIKE '%".$keywords."%')
        OR (email LIKE '%".$keywords."%')";
    }
    if(isset($sortBy)){
        $orderSQL = " ORDER BY ID ".$sortBy;
    }else{
        $orderSQL = " ORDER BY ID DESC ";
    }

    //Tinh tong so ban ghi
    $queryNum = $connect->query("SELECT COUNT(*) as postNum FROM user ".$whereSQL.$orderSQL);
    $resultNum = $queryNum->fetch_assoc();
    $rowCount = $resultNum['postNum'];

    //Tao lop phan trang
    $pagConfig = array(
        'currentPage' => $start,
        'totalRows' => $rowCount,
        'perPage' => $limit,
        'link_func' => 'searchFilter'
    );
    $pagination =  new Pagination($pagConfig);

    // Truy van de phan trang
    $query = $connect->query("SELECT * FROM user $whereSQL $orderSQL LIMIT $start,$limit");

    if ($query == FALSE) {
        exit();
    }
?>
    <table style="border: 1px solid black" id="full_table">
        <tr>
            <th>ID</th>
            <th>firstName</th>
            <th>lastName</th>
            <th>Email</th>
            <th>Edit</th>
            <th>Delete</th>
        </tr>

   <?php if($query->num_rows > 0){ ?>
        <div class="posts_list">
            <?php
            while($row = $query->fetch_assoc()){
                $postID = $row['ID'];
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
        </div>
        </table>
        <?php echo $pagination->createLinks(); ?>
    <?php } } ?>