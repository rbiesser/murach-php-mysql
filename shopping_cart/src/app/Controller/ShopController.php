<?php
require dirname(__DIR__) . '/Model/Table/ProductsTable.php';

// get list of items
$ProductsDB = new ProductsTable;

// sqli
// verify that page is indeed a number because this is going to the db
$current_page = isset($path[3]) ? $path[3] : 1;
$items_per_page = 9; // 9 looks best with current card view

$items_count = $ProductsDB->getCountOfItems();
if ($items_count > 0) {
    $items = $ProductsDB->getPaginatedItems($current_page, $items_per_page);
}


require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Shop.php';
require dirname(__DIR__) . '/View/theme/footer.php';