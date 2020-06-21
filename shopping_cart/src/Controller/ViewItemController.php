<?php
require dirname(__DIR__) . '/Model/Table/ItemsTable.php';

$ItemsDB = new ItemsTable;

$item_code = isset($path[2]) ? $path[2] : '';

$item = $ItemsDB->getItemByCode($item_code);

// get list of items
$featured_items = $ItemsDB->getFeaturedItems();



require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/ViewItem.php';
require dirname(__DIR__) . '/View/theme/footer.php';