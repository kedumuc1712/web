<?php

// Khi an vao nut search
if (isset($_GET["submit"])) {
    if ($_GET["search"] == NULL) {
        header("Location: index.php");
    }

    $conn = mysqli_connect("localhost", "root", "", "ows");
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $output = "";
    $search = $_GET["search"]; // Tu khoa can tim kiem
    $submit = $_GET["submit"];

    // Tim so ban ghi co tu khoa can tim

    $sql = "SELECT COUNT(ID) as total FROM user WHERE (ID LIKE '%" . $_GET["search"] . "%')
                OR (firstName LIKE '%" . $_GET["search"] . "%')
                OR (lastName LIKE '%" . $_GET["search"] . "%') 
                OR (email LIKE '%" . $_GET["search"] . "%')";
    // Tinh tong so trang can co de phan trang            
    $query = mysqli_query($conn, $sql);
    $count = mysqli_fetch_array($query);
    $total_records = $count['total'];
    $current_page = isset($_GET["page"]) ? $_GET["page"] : 1;
    $limit = 10;
    $total_page = ceil($total_records / $limit);

    // Gioi han current page

    if ($current_page > $total_page) {
        $current_page = $total_page;
    }
    else
        if ($current_page < 1) {
            $current_page = 1;
        }

    // Tim start cua moi trang

    $start = ($current_page - 1) * $limit;

    // Truy van lay danh sach
    $result = mysqli_query($conn, "SELECT * FROM user WHERE (ID LIKE '%" . $_GET["search"] . "%')
             OR (firstName LIKE '%" . $_GET["search"] . "%')
             OR (lastName LIKE '%" . $_GET["search"] . "%') 
             OR (email LIKE '%" . $_GET["search"] . "%')
             LIMIT $start, $limit");
    // Kiem tra $result
    if ($result == FALSE) {
        echo "<br />" . "DATA NOT FOUND";
        exit();
    }
?>

<!-- Hien thi table records -->
<div id="result_search">
    <table style="border: 1px solid black" id="full_table">
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

<!-- Nut phan trang -->
<?php
        echo "<div id='slide'>";
        echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=1">First</a> | ';

        // Nut Prev

        if ($current_page > 1 & $total_page > 1) {
            echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page - 1) . '">Prev</a> | ';
        }

        // Chi hien thi nhung nut gan ke

        if ($current_page - 2 <= 0 && $total_page >= 3) {
            echo '<span>' . $current_page . '</span> | ';
            echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page + 1) . '">
            ' . ($current_page + 1) . '</a> | ';
            echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page + 2) . '">
            ' . ($current_page + 2) . '</a> | ';
        }
        else
            if ($total_page < ($current_page + 2) & $total_page >= 3) {
                echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page - 1) . '">
            ' . ($current_page - 1) . '</a> | ';
                echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page - 2) . '">
            ' . ($current_page - 2) . '</a> | ';
                echo '<span>' . $current_page . '</span> | ';
            }
            else
                if ($total_page >= 3) {
                    echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page - 2) . '">
            ' . ($current_page - 2) . '</a> | ';
                    echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page - 1) . '">
            ' . ($current_page - 1) . '</a> | ';
                    echo '<span>' . $current_page . '</span> | ';
                    echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page + 1) . '">
            ' . ($current_page + 1) . '</a> | ';
                    echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page + 2) . '">
            ' . ($current_page + 2) . '</a> | ';
                }
                else {
                    echo '<span>' . $current_page . '</span> | ';
                }

        // Neu current_page < total_page va total_page > 1 moi hien thi nut prev

        if ($current_page <= $total_page && $total_page > 1) {
            echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($current_page + 1) . '">
            Next</a> | ';
        }

        echo '<a href="index.php?search=' . $search . '&submit=' . $submit . '&page=' . ($total_page) . '">Last</a>';
        echo "</div>";

    mysqli_close($conn);
}

?>
