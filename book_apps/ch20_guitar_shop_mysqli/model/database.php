<?php
$host = 'localhost';
$username = 'mgs_user';
$password = 'pa55word';
$database = 'my_guitar_shop2';

$db = new mysqli($host, $username, $password, $database);

$error_message = $db->connect_error;
if ($error_message != null) {
    include 'errors/db_error_connect.php';
    exit;
}

function display_db_error($error_message) {
    global $app_path;
    include 'errors/db_error.php';
    exit;
}
?>