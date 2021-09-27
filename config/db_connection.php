<?php
$servername = "127.0.0.1:3306";
$database = "sellingbooks";
$username = "root";
$password = "123456";
$conn = mysqli_connect($servername, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
session_start();