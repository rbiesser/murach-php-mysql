<?php
/**
 * 5. use the $cart parameter
 * 6. update the session cart after every action
 * 7. update cart_view.php to use new definition for get_subtotal()
 */

// Start session management with a persistent cookie
$lifetime = 60 * 60 * 24 * 14;    // 2 weeks in seconds
// $lifetime = 0;                      // per-session cookie
session_set_cookie_params($lifetime, '/');
session_start();

// Create a cart array if needed
if (empty($_SESSION['cart13'])) $_SESSION['cart13'] = array();

$cart = $_SESSION['cart13'];

// Create a table of products
$products = array();
$products['MMS-1754'] = array('name' => 'Flute', 'cost' => '149.50');
$products['MMS-6289'] = array('name' => 'Trumpet', 'cost' => '199.50');
$products['MMS-3408'] = array('name' => 'Clarinet', 'cost' => '299.50');

// Include cart functions
require_once('cart.php');

// Get the action to perform
$action = filter_input(INPUT_POST, 'action');
if ($action === NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action === NULL) {
        $action = 'show_add_item';
    }
}

// Add or update cart as needed
switch($action) {
    case 'add':
        $key = filter_input(INPUT_POST, 'productkey');
        $quantity = filter_input(INPUT_POST, 'itemqty');
        rbiesser\cart\add_item($cart, $key, $quantity);
        $_SESSION['cart13'] = $cart;
        include('cart_view.php');
        break;
    case 'update':
        $new_qty_list = filter_input(INPUT_POST, 'newqty', 
                FILTER_DEFAULT, FILTER_REQUIRE_ARRAY);
        foreach($new_qty_list as $key => $qty) {
            if ($_SESSION['cart13'][$key]['qty'] != $qty) {
                rbiesser\cart\update_item($cart, $key, $qty);
                $_SESSION['cart13'] = $cart;
            }
        }
        include('cart_view.php');
        break;
    case 'show_cart':
        include('cart_view.php');
        break;
    case 'show_add_item':
        include('add_item_view.php');
        break;
    case 'empty_cart':
        unset($_SESSION['cart13']);
        unset($cart);
        include('cart_view.php');
        break;
}
?>