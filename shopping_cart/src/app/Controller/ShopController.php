<?php

$items_per_page = 9; // 9 looks best with current card view

switch ($action) {
    case 'view':
        require dirname(__DIR__) . '/Controller/ProductController.php';
        break;
    case 'page':
    default:
        $current_page = isset($path[3]) ? filter_var($path[3], FILTER_VALIDATE_INT) : 1;
        try {
            $items_count = ProductsTable::getCountOfItems();
            $items = ProductsTable::getPaginatedItems($current_page, $items_per_page);
        } catch (Exception $e) {
            $items = null;
            $error_message = $e->getMessage();
        }
        
        
        require dirname(__DIR__) . '/View/theme/header.php';
        require dirname(__DIR__) . '/View/Shop.php';
        require dirname(__DIR__) . '/View/theme/footer.php';
}


