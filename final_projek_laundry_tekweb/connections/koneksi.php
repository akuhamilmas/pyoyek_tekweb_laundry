<?php 
// ini untuk melakukan koneksi ke php admin atau data base kita
$dbHost = "localhost";
$dbUsername = "root";
$dbPass = "";
$dbName = "db_laundry";

$conn = mysqli_connect($dbHost, $dbUsername, $dbPass, $dbName);

// setting waktu WIB
date_default_timezone_set("Asia/Jakarta");
