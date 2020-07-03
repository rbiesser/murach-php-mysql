<?php
require dirname(__DIR__) . '/Model/Table/ProductsTable.php';

$ProductsDB = new ProductsTable;

$item_code = isset($path[2]) ? $path[2] : '';

$item = $ProductsDB->getItemByCode($item_code);

// get list of items
$featured_items = $ProductsDB->getFeaturedItems();



require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Product.php';
require dirname(__DIR__) . '/View/theme/footer.php';