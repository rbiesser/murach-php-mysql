<?php
error_reporting(E_ALL);
require('../model/database.php');
// almost exactly the same as ch15_ex2 except tech_support doesn't have categories
// require('../model/category.php');
// require('../model/category_db.php');
require('../model/product.php');
require('../model/product_db.php');

// include the modules
require('../model/fields.php');
require('../model/validate.php');

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('code');
$fields->addField('name');
$fields->addField('version');
$fields->addField('releaseDate');

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'list_products';
    }
}

if ($action == 'list_products') {
    // Get the current category ID
    // $category_id = filter_input(INPUT_GET, 'category_id', 
    //         FILTER_VALIDATE_INT);
    // if ($category_id == NULL || $category_id == FALSE) {
    //     $category_id = 1;
    // }

    // Get product and category data
    // $current_category = CategoryDB::getCategory($category_id);
    // $categories = CategoryDB::getCategories();
    // $products = ProductDB::getProductsByCategory($category_id);

    $products = ProductDB::getProducts();

    // Display the product list
    include('product_list.php');
} else if ($action == 'delete_product') {
    // Get the IDs
    $product_code = filter_input(INPUT_POST, 'product_code');
    // $category_id = filter_input(INPUT_POST, 'category_id', 
    //         FILTER_VALIDATE_INT);

    try {
        // Delete the product
        ProductDB::deleteProduct($product_code);
    
        // Display the Product List page for the current category
        // header("Location: .?category_id=$category_id");
        header("Location: .");

    } catch (Exception $e) {
        $error = $e->getMessage();
        include '../errors/error.php';
    }

} else if ($action == 'show_add_form') {
    // not in the text, but it's also not required
    // php doesn't require variable declarations.
    // will display an error in inputs if you have error_reporting(E_ALL);
    $code = $name = $version = '';

    // $categories = CategoryDB::getCategories();
    include('product_add.php');
} else if ($action == 'add_product') {
    // $category_id = filter_input(INPUT_POST, 'category_id', 
            // FILTER_VALIDATE_INT);
    $code = filter_input(INPUT_POST, 'code');
    $name = filter_input(INPUT_POST, 'name');
    $version = filter_input(INPUT_POST, 'version');
    $releaseDate = filter_input(INPUT_POST, 'releaseDate');

    // Validate form data
    $validate->text('code', $code, true, 1, 10);
    $validate->text('name', $name, true, 1, 50);
    $validate->number('version', $version); // decimal(18, 1)
    // $validate->text('releaseDate', $releaseDate); // datetime

    $releaseDate = date("Y-m-d H:i:s"); // use current time

    if ($fields->hasErrors()) {
        // $categories = CategoryDB::getCategories();
        include 'product_add.php';
    } else {
        // $current_category = CategoryDB::getCategory($category_id);
        $product = new Product($code, $name, $version, $releaseDate);

        try {
            ProductDB::addProduct($product);

            // Display the Product List page for the current category
            // header("Location: .?category_id=$category_id");
            header("Location: .");
        } catch (Exception $e) {
            $error = $e->getMessage();
            include '../errors/error.php';
        }

    }
}
?>