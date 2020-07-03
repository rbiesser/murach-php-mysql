<?php
require dirname(__DIR__) . '/Model/Table/ProductsTable.php';

// get list of items
$ProductsDB = new ProductsTable;

$items = $ProductsDB->getFeaturedItems();

require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Home.php';
require dirname(__DIR__) . '/View/theme/footer.php';