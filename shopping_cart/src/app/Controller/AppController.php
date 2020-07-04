<?php
// GET, POST
$http_method = $_SERVER['REQUEST_METHOD'];

// parse the url to figure where the user wants to go
$path = explode('/', parse_url(urldecode($_SERVER['REQUEST_URI']), PHP_URL_PATH));

// var_dump($path);
$controller = $path[1];

// configure cart

switch ($controller) {
    case '':
        require dirname(__DIR__) . '/Controller/HomeController.php';
        break;
    case 'shop':
        require dirname(__DIR__) . '/Controller/ShopController.php';
        break;
    case 'view':
        require dirname(__DIR__) . '/Controller/ProductController.php';
        break;
    case 'cart':
        require dirname(__DIR__) . '/Controller/CartController.php';
        break;
    case 'checkout':
        require dirname(__DIR__) . '/Controller/CheckoutController.php';
        break;
    case 'register':
        require dirname(__DIR__) . '/Controller/RegisterController.php';
        break;
    case 'admin':
        require dirname(__DIR__) . '/Controller/AdminController.php';
        break;
    default:
        require dirname(__DIR__) . '/Controller/ErrorController.php';
}
