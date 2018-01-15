
<!-- Thuat toan phan trang -->
<?php
$conn = mysqli_connect("localhost", "root", "", "ows");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Dem tong so ban ghi cua DB
$sql = "SELECT COUNT(ID) as total FROM user";
$result = mysqli_query($conn, $sql);
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
} else if ($current_page < 1) {
    $current_page = 1;
}

// Tim start cua moi trang
$start = ($current_page - 1) * $limit;

// Truy van lay danh sach
$query = mysqli_query($conn, "SELECT * FROM user LIMIT $start, $limit");

?>

<!-- Hien thi danh sach ban ghi theo LIMIT o dang table-->
<div id="result">
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

<!-- Hien thi phan trang, cac nut chuyen trang -->
<?php
echo "<div id='root'>";

echo '<a href="index.php?page=1">First</a> | ';

// Nut Prev
if ($current_page > 1 && $total_page > 1) {
    echo '<a href="index.php?page=' . ($current_page - 1) . '">Prev</a> | ';
}

// Chi hien thi nhung nut gan ke
if ($current_page - 2 <= 0) {
    echo '<span>' . $current_page . '</span> | ';
    echo '<a href="index.php?page=' . ($current_page + 1) . '">' . ($current_page + 1) . '</a> | ';
    echo '<a href="index.php?page=' . ($current_page + 2) . '">' . ($current_page + 2) . '</a> | ';
} else if ($total_page < ($current_page + 2)) {
    echo '<a href="index.php?page=' . ($current_page - 1) . '">' . ($current_page - 1) . '</a> | ';
    echo '<a href="index.php?page=' . ($current_page - 2) . '">' . ($current_page - 2) . '</a> | ';
    echo '<span>' . $current_page . '</span> | ';
} else {
    echo '<a href="index.php?page=' . ($current_page - 2) . '">' . ($current_page - 2) . '</a> | ';
    echo '<a href="index.php?page=' . ($current_page - 1) . '">' . ($current_page - 1) . '</a> | ';
    echo '<span>' . $current_page . '</span> | ';
    echo '<a href="index.php?page=' . ($current_page + 1) . '">' . ($current_page + 1) . '</a> | ';
    echo '<a href="index.php?page=' . ($current_page + 2) . '">' . ($current_page + 2) . '</a> | ';
}

//Neu current_page < total_page va total_page > 1 moi hien thi nut prev
if ($current_page <= $total_page && $total_page > 1) {
    echo '<a href="index.php?page=' . ($current_page + 1) . '">Next</a> | ';
}

echo '<a href="index.php?page=' . ($total_page) . '">Last</a>';

echo "</div>";
?>
