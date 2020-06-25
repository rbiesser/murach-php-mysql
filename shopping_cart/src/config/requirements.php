<?php

// debug
error_reporting(E_ALL);

// // make database connection
// $dsn = 'mysql:host=db;dbname=shopping_cart';
// $username = 'user';
// $password = 'pa55word';

// try {
//     $db = new PDO($dsn, $username, $password);
// } catch (PDOException $e) {
//     $error_message = $e->getMessage();
//     echo $error_message;
//     // include('../errors/database_error.php');
//     exit();
// }

session_start();