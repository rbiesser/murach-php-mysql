<?php
// use cookie or database?
// if you want the user to pick up a session on another machine, use database.
require dirname(__DIR__) . '/Model/Table/ProductsTable.php';

$ProductsDB = new ProductsTable($db);

$total_price = 0;

if (!isset($_SESSION['cart'])) {
    // echo 'new cart session';
    // var_dump($_SESSION);
    $_SESSION['cart'] = array();
}

$cart = $_SESSION['cart'];

$items = array();

// handle add item to cart
if ($http_method == 'POST') {
    // echo $http_method;
    // var_dump($_POST);
    
    $item_code = filter_input(INPUT_POST, 'code');
    $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

    // validate item_code
    try {
        // var_dump($quantity);
        $item = $ProductsDB->getItemByCode($item_code);
        // $items[$item_code] = $item;
        // $total_price += ($item->getPrice() * $quantity);

        // if the item was found in the db, add to cart
        if (isset($cart[$item_code])) {
            // echo 'update cart';
            $cart[$item_code] += $quantity;
        } else {
            // echo 'new item in cart';
            $cart[$item_code] = $quantity;
        }
    
        // save cart back to session variable
        $_SESSION['cart'] = $cart;

        $_SESSION['message'] = array(
            'type' => 'success', 
            'header' => 'Your item has been added to the cart.', 
            'body' => 'Click this message to view the items in your cart.'
        );

    } catch (Exception $e) {
        // $item = null;
        $error_message = $e->getMessage();

        $_SESSION['message'] = array(
            'type' => 'error', 
            'header' => '', 
            'body' => $error_message
        );
    }

    header("Location: ".$_SERVER['HTTP_REFERER']);
}

foreach($cart as $item_code => $quantity) {
    // lookup product
    try {
        // var_dump($quantity);
        $item = $ProductsDB->getItemByCode($item_code);
        $items[$item_code] = $item;
        $total_price += ($item->getPrice() * $quantity);
    } catch (Exception $e) {
        // $item = null;
        // $error_message = $e->getMessage();
    }
}



// var_dump($_SESSION);

require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Cart.php';
require dirname(__DIR__) . '/View/theme/footer.php';