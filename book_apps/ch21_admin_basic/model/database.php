<?php
$dsn = 'mysql:host=localhost;dbname=my_guitar_shop2';
$username = 'mgs_user';
$password = 'pa55word';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error = $e->getMessage();
    include('view/error.php');
    exit();
}
?>