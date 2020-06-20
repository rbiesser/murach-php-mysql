you are in webroot

<?php
require dirname(__DIR__) . '/config/requirements.php';

// parse the url to figure where the user wants to go
$url = parse_url(urldecode($_SERVER['REQUEST_URI']));

switch ($url['path']) {
    case '/cart':
        require dirname(__DIR__) . '/Controller/CartController.php';
        break;
    case '/register':
        require dirname(__DIR__) . '/Controller/RegisterController.php';
        break;
    case '/shop':
    case '/':
        require dirname(__DIR__) . '/Controller/ShopController.php';
        break;
    default:
        require dirname(__DIR__) . '/Controller/ErrorController.php';
}

phpinfo();

?>