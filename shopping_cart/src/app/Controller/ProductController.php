<?php

$item_code = isset($path[3]) ? filter_var($path[3]) : '';

// move to AppController
// if (isset($_SESSION['message'])) {
//     $message = $_SESSION['message'];
//     unset($_SESSION['message']);
// }

try {
    $item = ProductsTable::getItemByCode($item_code);
} catch (Exception $e) {
    $item = null;
    $error_message = $e->getMessage();
}


// get list of items
$featured_items = ProductsTable::getFeaturedItems();



require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Product.php';
require dirname(__DIR__) . '/View/theme/footer.php';