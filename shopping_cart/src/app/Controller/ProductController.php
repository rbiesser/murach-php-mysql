<?php
require dirname(__DIR__) . '/Model/Table/ProductsTable.php';

$ProductsDB = new ProductsTable($db);

$item_code = isset($path[2]) ? filter_var($path[2]) : '';

try {
    $item = $ProductsDB->getItemByCode($item_code);
} catch (Exception $e) {
    $item = null;
    $error_message = $e->getMessage();
}


// get list of items
$featured_items = $ProductsDB->getFeaturedItems();



require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Product.php';
require dirname(__DIR__) . '/View/theme/footer.php';