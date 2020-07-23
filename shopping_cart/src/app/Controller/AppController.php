<?php

// parse the url to figure where the user wants to go
$path = explode('/', parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH));

// could also use hidden form fields, but this defines the status of 
// the application based on the url
$controller = isset($path[1]) ? $path[1] : '';
// sometimes the action is in the url, but could also come from form
$action = isset($path[2]) ? $path[2] : filter_input(INPUT_POST, 'action');;

// GET, POST, PUT, DELETE
$http_method = filter_input(INPUT_POST, 'method');
$http_method = isset($http_method)? $http_method : $_SERVER['REQUEST_METHOD'];

// var_dump($http_method);
// die();

// $session middleware
require dirname(__DIR__) . '/Controller/AuthController.php';

// messages middleware
// see cart for example
if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}

switch ($controller) {
    case '':
        require dirname(__DIR__) . '/Controller/HomeController.php';
        break;
    case 'shop':
        require dirname(__DIR__) . '/Controller/ShopController.php';
        break;
        // case 'view':
        //     require dirname(__DIR__) . '/Controller/ProductController.php';
        //     break;
    case 'cart':
        require dirname(__DIR__) . '/Controller/CartController.php';
        break;
        // case 'checkout':
        //     require dirname(__DIR__) . '/Controller/CheckoutController.php';
        //     break;
    // case 'register':
    //     require dirname(__DIR__) . '/Controller/RegisterController.php';
    //     break;
    case 'admin':
        require dirname(__DIR__) . '/Controller/Admin/AdminController.php';
        break;
    case 'account':
        require dirname(__DIR__) . '/Controller/AccountController.php';
        break;
    case 'address':
        require dirname(__DIR__) . '/Controller/AddressController.php';
        break;

    // case 'login':
    // case 'logout':
    //     require dirname(__DIR__) . '/Controller/LoginController.php';
    //     break;
    // case 'profile':
    //     require dirname(__DIR__) . '/Controller/ProfileController.php';
    //     break;
    default:
        require dirname(__DIR__) . '/Controller/ErrorController.php';
}
