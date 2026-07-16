<?php
$databaseHost = 'localhost';
$databaseUser = 'root';
$databasePassword = '';
$databaseName = 'program_carparts';

$connection = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

if (!$connection) {
    die('Database connection failed. Import database/program_carparts.sql and make sure MySQL is running.');
}

mysqli_set_charset($connection, 'utf8mb4');
?>

