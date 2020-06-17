<?php
require_once('../util/main.php');
require_once('../util/tags.php');
require_once('../model/database.php');
require_once('../model/product_db.php');
require_once('../model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products':
        // get current category
        $category_id = filter_input(INPUT_GET, 'category_id', 
                FILTER_VALIDATE_INT);
        if ($category_id == NULL || $category_id === FALSE) {
            $category_id = 1;
        }                

        // get categories and products
        $current_category = get_category($category_id);
        $categories = get_categories();
        $products = get_products_by_category($category_id);

        // display view
        include('product_list.php');
        break;
    case 'view_product':
        $categories = get_categories();

        // get product data
        $product_id = filter_input(INPUT_GET, 'product_id', 
                FILTER_VALIDATE_INT);
        $product = get_product($product_id);
        
        // display product
        include('product_view.php');
        break;
}
?>