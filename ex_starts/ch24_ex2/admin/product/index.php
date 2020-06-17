<?php
require_once('../../util/main.php');
require_once('util/secure_conn.php');
require_once('util/valid_admin.php');
require_once('util/images.php');
require_once('model/product_db.php');
require_once('model/category_db.php');

$action = strtolower(filter_input(INPUT_POST, 'action'));
if ($action == NULL) {
    $action = strtolower(filter_input(INPUT_GET, 'action'));
    if ($action == NULL) {        
        $action = 'list_products';
    }
}

switch ($action) {
    case 'list_products':
        // get categories and products
        $category_id = filter_input(INPUT_GET, 'category_id', 
                FILTER_VALIDATE_INT);
        if (empty($category_id)) {
            $category_id = 1;
        }
        $current_category = get_category($category_id);
        $categories = get_categories();
        $products = get_products_by_category($category_id);

        // display product list
        include('product_list.php');
        break;
    case 'view_product':
        $categories = get_categories();
        $product_id = filter_input(INPUT_GET, 'product_id', 
                FILTER_VALIDATE_INT);
        $product = get_product($product_id);
        $product_order_count = get_product_order_count($product_id);
        include('product_view.php');
        break;
    case 'delete_product':
        $category_id = filter_input(INPUT_POST, 'category_id', 
                FILTER_VALIDATE_INT);
        $product_id = filter_input(INPUT_POST, 'product_id', 
                FILTER_VALIDATE_INT);
        delete_product($product_id);
        
        // Display the Product List page for the current category
        header("Location: .?category_id=$category_id");
        break;
    case 'show_add_edit_form':
        $product_id = filter_input(INPUT_GET, 'product_id', 
                FILTER_VALIDATE_INT);
        if ($product_id === null) {
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
        $price = filter_input(INPUT_POST, 'price', 
                FILTER_VALIDATE_FLOAT);
        $discount_percent = filter_input(INPUT_POST, 'discount_percent', 
                FILTER_VALIDATE_FLOAT);

        // Validate inputs
        if (empty($code) || empty($name) || empty($description) ||
            $price === false || $discount_percent === false) {
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
        $price = filter_input(INPUT_POST, 'price', 
                FILTER_VALIDATE_FLOAT);
        $discount_percent = filter_input(INPUT_POST, 'discount_percent', 
                FILTER_VALIDATE_FLOAT);

        // Validate inputs
        if (empty($code) || empty($name) || empty($description) ||
            $price === false || $discount_percent === false ) {
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
    case 'upload_image':
        $product_id = filter_input(INPUT_POST, 'product_id', 
                FILTER_VALIDATE_INT);
        $product = get_product($product_id);
        $product_code = $product['productCode'];

        $image_filename = $product_code . '.png';
        $image_dir = $doc_root . $app_path . 'images/';

        if (isset($_FILES['file1'])) {
            $source = $_FILES['file1']['tmp_name'];
            $target = $image_dir . DIRECTORY_SEPARATOR . $image_filename;

            // save uploaded file with correct filename
            move_uploaded_file($source, $target);

            // add code that creates the medium and small versions of the image
            process_image($image_dir, $image_filename);

            // display product with new image
            include('product_view.php');
        }
        break;
}
?>