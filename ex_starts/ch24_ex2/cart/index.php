<?php
require_once '../util/main.php';
require_once 'util/validation.php';

require_once 'model/cart.php';
require_once 'model/product_db.php';

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'view';
    }
}

switch ($action) {
    case 'view':
        $cart = cart_get_items();
        break;
    case 'add':
        $product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT);
        $quantity = filter_input(INPUT_GET, 'quantity');

        // validate the quantity entry
        if ($quantity === null) {
            display_error('You must enter a quantity.');
        } elseif (!is_valid_number($quantity, 1)) {
            display_error('Quantity must be 1 or more.');
        }

        cart_add_item($product_id, $quantity);
        $cart = cart_get_items();
        break;
    case 'update':
        $items = filter_input(INPUT_POST, 'items', FILTER_DEFAULT, 
                FILTER_REQUIRE_ARRAY);
        foreach ( $items as $product_id => $quantity ) {
            if ($quantity == 0) {
                cart_remove_item($product_id);
            } else {
                cart_update_item($product_id, $quantity);
            }
        }
        $cart = cart_get_items();
        break;
    default:
        add_error("Unknown cart action: " . $action);
        break;
}
include './cart_view.php';

?>