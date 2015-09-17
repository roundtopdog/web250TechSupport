<?php
    $dsn = 'mysql:host=localhost;dbname=tech_support';
    $username = 'ts_user';
    $password = '1234';

    try {
        $db = new PDO($dsn, $username, $password);
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>