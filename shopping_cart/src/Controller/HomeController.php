<?php
require dirname(__DIR__) . '/Model/Table/ItemsTable.php';

// get list of items
$ItemsDB = new ItemsTable;

$items = $ItemsDB->getFeaturedItems();

require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Home.php';
require dirname(__DIR__) . '/View/theme/footer.php';