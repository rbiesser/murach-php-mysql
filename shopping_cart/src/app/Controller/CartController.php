<?php

// echo $action;
// var_dump($_POST);
// die();

$total_price = 0;

// if (!isset($_SESSION['cart'])) {
//     // echo 'new cart session';
//     // var_dump($_SESSION);
//     $_SESSION['cart'] = array();
// }

// $cart = $_SESSION['cart'];
$cart = $session->getCart();

$items = array();

// all actions are performed on a product one at a time
// if ($http_method == 'POST') {

    try {
        $item_code = filter_input(INPUT_POST, 'code');
        $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

        switch ($action) {
            case 'add':
                $item = ProductsTable::getItemByCode($item_code);
                
                $session->addItemToCart($item, $quantity);
                
                // this would be the most complete example of how to display message with header and type.
                $_SESSION['message'] = array(
                    'type' => 'success',
                    'header' => $item->getName() . ' has been added to your cart.',
                    'body' => ''
                );
                
                header("Location: " . $_SERVER['HTTP_REFERER']);
            break;
            case 'edit':
                $item = ProductsTable::getItemByCode($item_code);

                $session->updateItemInCart($item, $quantity);

                $_SESSION['message'] = array(
                    'type' => 'success',
                    'header' => $item->getName() . ' has been updated.',
                    'body' => ''
                );

                header("Location: /cart");
                break;
            case 'delete':
                // var_dump($item);
                // echo 'delete';
                // die();
                $item = ProductsTable::getItemByCode($item_code);

                $session->removeItemFromCart($item);
                $_SESSION['message'] = array(
                    'type' => 'success',
                    'header' => $item->getName() . ' has been remove from your cart.',
                    'body' => ''
                );

                header("Location: /cart");
            break;
            case 'empty':
                $session->emptyCart();

                $_SESSION['message'] = array(
                    'type' => 'success',
                    'header' => 'Your cart has been emptied.',
                    'body' => ''
                );

                header("Location: /cart");
                break;
            case 'checkout':
                require dirname(__DIR__) . '/Controller/CheckoutController.php';
                break;
        }
    } catch (Exception $e) {
        // $item = null;
        $error_message = $e->getMessage();

        $_SESSION['message'] = array(
            'type' => 'error',
            'header' => '',
            'body' => $error_message
        );
    }
    // echo $http_method;
    // var_dump($_POST);

    // die();
    //rewrite this code to work with database


    // validate item_code
// } else {
//     switch ($action) {
//         case 'checkout':
//             require dirname(__DIR__) . '/Controller/CheckoutController.php';
//             break;
//     }

// }

// else viewing the cart

foreach ($cart as $key => $itemInCart) {
    $item = ProductsTable::getItem($itemInCart['productID']);
    $cart[$key]['product'] = $item;
    $total_price += ($item->getPrice() * $itemInCart['quantity']);
}

// var_dump($cart);
// die();


require dirname(__DIR__) . '/View/theme/header.php';
require dirname(__DIR__) . '/View/Cart.php';
require dirname(__DIR__) . '/View/theme/footer.php';
