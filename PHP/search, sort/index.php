<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="style.css" />
    <!-- Jquery -->
    <script
            src="https://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous">
    </script>
    <script src="ajax.js"></script>
</head>
<body>

<a href="index.php" class="home">Home</a>

<form id="search_box" action="index.php" method="get">
    <input type="text" name="search" id="search_text" placeholder="Search"
           value="<?php if (isset($_GET['search'])) echo $_GET['search']; ?>"/>
    <input type="submit" name="submit" value="Search" />
</form>

<form action="index.php" method="get">
<select name="sort" id="sort">
    <option value="None">Select</option>
    <option value="ID">Sort By ID</option>
    <option value="firstName">Sort By firstName</option>
    <option value="lastName">Sort By lastName</option>
    <option value="email">Sort By Email</option>
</select>
    <input type="submit" value="Sort"/>
</form>

<!-- Chua tim kiem va sap xep thi hien tat ca records -->
<?php
    if (empty($_GET['submit']) && empty($_GET['sort'])) {
        require "page.php";
    }
?>

<?php
    require "search.php";
    require "sort.php";
?>


</body>
</html>