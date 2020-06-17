<?php
require_once('../../util/main.php');
require_once('../../util/tags.php');
require_once('../../model/database.php');
require_once('../../model/product_db.php');
require_once('../../model/category_db.php');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products':
        $category_id = filter_input(INPUT_GET, 'category_id', 
                FILTER_VALIDATE_INT);
        if ($category_id === FALSE) {
            $category_id = 1;
        }                
        $current_category = get_category($category_id);
        $categories = get_categories();
        $products = get_products_by_category($category_id);
        include('product_list.php');
        break;
    case 'view_product':
        $categories = get_categories();
        $product_id = filter_input(INPUT_GET, 'product_id', 
                FILTER_VALIDATE_INT);
        $product = get_product($product_id);
        include('product_view.php');
        break;
    case 'delete_product':
        $product_id = filter_input(INPUT_POST, 'product_id', 
                FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        delete_product($product_id);
        
        // display product list for the current category
        header("Location: .?category_id=$category_id");
        break;
    case 'show_add_edit_form':
        $product_id = filter_input(INPUT_GET, 'product_id', 
                FILTER_VALIDATE_INT);
        if ($product_id == NULL) {
            $product_id = filter_input(INPUT_POST, 'product_id', 
                    FILTER_VALIDATE_INT);
        }
        $product = get_product($product_id);
        $categories = get_categories();
        include('product_add_edit.php');
        break;
    case 'add_product':        
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $discount_percent = filter_input(INPUT_POST, 'discount_percent');        

        if ($category_id === FALSE || 
                $code == NULL || $name == NULL || $description == NULL ||
                $price === FALSE || $discount_percent === FALSE) {            
            $error = 'Invalid product data.
                      Check all fields and try again.';
            include('../../errors/error.php');
        } else {
            $categories = get_categories();
            $product_id = add_product($category_id, $code, $name,
                    $description, $price, $discount_percent);
            $product = get_product($product_id);
            include('product_view.php');
        }
        break;
    case 'update_product':
        $product_id = filter_input(INPUT_POST, 'product_id', 
                FILTER_VALIDATE_INT);
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        $code = filter_input(INPUT_POST, 'code');
        $name = filter_input(INPUT_POST, 'name');
        $description = filter_input(INPUT_POST, 'description');
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
        $discount_percent = filter_input(INPUT_POST, 'discount_percent');        

        if ($product_id === FALSE || $category_id === FALSE ||
                $code === NULL || $name === NULL || $description === NULL ||
                $price === FALSE || $discount_percent === FALSE) {            
            $error = 'Invalid product data.
                      Check all fields and try again.';
            include('../../errors/error.php');
        } else {
            $categories = get_categories();
            update_product($product_id, $code, $name, $description,
                           $price, $discount_percent, $category_id);
            $product = get_product($product_id);
            include('product_view.php');
        }
        break;
}
?>