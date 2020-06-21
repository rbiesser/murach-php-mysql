<?php
// use cookie or database?
// if you want the user to pick up a session on another machine, use database.

// handle add item to cart
if ($http_method == 'POST') {
    echo $http_method;
    var_dump($_POST);
}

$items = array('a');

require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Cart.php';
require dirname(__DIR__) . '/View/theme/footer.php';