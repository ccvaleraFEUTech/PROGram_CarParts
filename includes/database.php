<?php
$isLocal = ($_SERVER['HTTP_HOST'] === 'localhost');

if ($isLocal) {
    $databaseHost = "localhost";
    $databaseUser = "root";
    $databasePassword = "";
    $databaseName = "program_carparts";
} else {
    $databaseHost = "sql210.infinityfree.com";
    $databaseUser = "if0_42429884";
    $databasePassword = "PROGramproj2026";
    $databaseName = "if0_42429884_program_carparts";
}

$connection = mysqli_connect($databaseHost, $databaseUser, $databasePassword, $databaseName);

if (!$connection) {
    die('Database connection failed. Import database/program_carparts.sql and make sure MySQL is running.');
}

mysqli_set_charset($connection, 'utf8mb4');
?>

