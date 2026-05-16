<?php
    $hsot = "localhost";
    $username = "root";
    $password = "";
    $database = "db_servora";
    $conn = mysqli_connect($hsot, $username, $password, $database);
    if (!$conn) {
        die(mysqli_connect_error());
    }   
?>