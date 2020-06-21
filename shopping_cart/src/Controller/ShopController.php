<?php

require dirname(__DIR__) . '/Model/Entity/Item.php';
require dirname(__DIR__) . '/Model/Table/ItemsTable.php';

// get list of items
$items_db = new ItemsTable;
$items = $items_db->getItems();

// for testing
for ($i = 1; $i < 10; $i++) {
    array_push($items, new Item($i, 'name ' . $i, 5.99));
}

require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Shop.php';
require dirname(__DIR__) . '/View/theme/footer.php';