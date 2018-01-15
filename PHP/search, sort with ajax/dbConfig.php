<?php

// Create database connection
$connect = mysqli_connect("localhost", "root", "", "ows");

// Check connection
if (!$connect) {
    die("Connection failed: " . mysqli_connect_error());
}
?>