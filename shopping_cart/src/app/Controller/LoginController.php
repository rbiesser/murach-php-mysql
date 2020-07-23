<?php

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

if ($action === 'logout') {
    $session->logout();
    $_SESSION['message'] = "You have been logged out.";
    header("Location: /account/login");
}

if($session->isLoggedIn()) {
    $_SESSION['message'] = "You are already logged in";
    header("Location: /profile");
}

// if post
// login
if ($http_method == 'POST') {
    
    $emailAddress = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');
    
    if ($session->login($emailAddress, $password)) {
        header("Location: /shop");
    } else {   
        $message = "Invalid user/password combination";
    }
}



require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Login.php';
require dirname(__DIR__) . '/View/theme/footer.php';