<?php
// use SessionsTable;

session_start();

$sessionKey = filter_input(INPUT_COOKIE, 'PHPSESSID');

// require dirname(__DIR__) . '/Model/Table/SessionsTable.php';

// $SessionsDB = new SessionsTable($db);
// $session = SessionsTable::insertOrUpdateSession($sessionKey);

$session = new Session($sessionKey);

// $cart = $session->getCart();

// var_dump($session);
// die('new session in auth');

// $message = "Invalid user/password combination";


// require dirname(__DIR__) . '/View/theme/header.php';
// require dirname(__DIR__) . '/View/Login.php';
// require dirname(__DIR__) . '/View/theme/footer.php';