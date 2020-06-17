<?php
require_once('../util/main.php');
require_once('../model/product_db.php');
require_once('../model/category_db.php');

$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
if ($category_id !== null) {
    $action = 'category';
} elseif ($product_id !== null) {
    $action = 'product';
} else {
    $action = '';
}

switch ($action) {
    // Display the specified category
    case 'category':
        // Get category data
        $category = get_category($category_id);
        $category_name = $category['categoryName'];
        $products = get_products_by_category($category_id);

        // Display category
        include('./category_view.php');
        break;
    // Display the specified product
    case 'product':
        // Get product data
        $product = get_product($product_id);

        // Display product
        include('./product_view.php');
        break;
    default:
        $error = 'Unknown catalog action: ' . $action;
        include('errors/error.php');
        break;
}
?>