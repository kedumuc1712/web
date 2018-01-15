<?php

// Khi an vao nut Sort
if (isset($_GET["sort"]) and $_GET["sort"] != "None") {
    $connect = mysqli_connect("localhost", "root", "", "ows");
    $query = mysqli_query($connect, "SELECT COUNT(ID) as total FROM user");
    $count = mysqli_fetch_array($query);
    $total_records = $count['total'];

//Tim limit va page hien tai
    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $limit = 10;

// Tinh tong so trang can thiet
    $total_page = ceil($total_records / $limit);

// Gioi han current page
    if ($current_page > $total_page) {
        $current_page = $total_page;
    } else if ($current_page < 1) {
        $current_page = 1;
    }

// Tim start cua moi trang
    $start = ($current_page - 1) * $limit;
    $sort = $_GET["sort"];
    $output = "";
    $sql = "SELECT * FROM user ORDER BY $sort LIMIT $start, $limit";
    $result = mysqli_query($connect, $sql);

?>

<!-- Hien thi table records -->
<div id="result_sort">
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


<?php

        echo "<div id='slide_page'>";

        echo '<a href="index.php?page=1">First</a> | ';

        // Nut Prev
        if ($current_page > 1 && $total_page > 1) {
            echo '<a href="index.php?sort='.$_GET["sort"].'page=' . ($current_page - 1) . '">Prev</a> | ';
        }

        // Chi hien thi nhung nut gan ke sort_page
        if ($current_page - 2 <= 0) {
            echo '<span>' . $current_page . '</span> | ';
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page + 1) . '">' . ($current_page + 1) . '</a> | ';
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page + 2) . '">' . ($current_page + 2) . '</a> | ';
        } else if ($total_page < ($current_page + 2)) {
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page - 1) . '">' . ($current_page - 1) . '</a> | ';
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page - 2) . '">' . ($current_page - 2) . '</a> | ';
            echo '<span>' . $current_page . '</span> | ';
        } else {
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page - 2) . '">' . ($current_page - 2) . '</a> | ';
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page - 1) . '">' . ($current_page - 1) . '</a> | ';
            echo '<span>' . $current_page . '</span> | ';
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page + 1) . '">' . ($current_page + 1) . '</a> | ';
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page + 2) . '">' . ($current_page + 2) . '</a> | ';
        }

    //Neu current_page < total_page va total_page > 1 moi hien thi nut prev
        if ($current_page <= $total_page && $total_page > 1) {
            echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($current_page + 1) . '">Next</a> | ';
        }

        echo '<a href="index.php?sort='.$_GET["sort"].'&page=' . ($total_page) . '">Last</a>';

        echo "</div>";

        mysqli_close($connect);
}

?>


