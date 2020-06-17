<?php
require_once('../util/main.php');
require_once('util/secure_conn.php');
require_once('util/validation.php');

require_once('model/cart.php');
require_once('model/product_db.php');
require_once('model/order_db.php');
require_once('model/customer_db.php');
require_once('model/address_db.php');

if (!isset($_SESSION['user'])) {
    $_SESSION['checkout'] = true;
    redirect('../account');
    exit();
}

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {        
        $action = 'confirm';
    }
}

switch ($action) {
    case 'confirm':
        $cart = cart_get_items();
        if (cart_product_count() == 0) {
            redirect('../cart');
        }
        $subtotal = cart_subtotal();
        $item_count = cart_item_count();
        $item_shipping = 5;
        $shipping_cost = shipping_cost();
        $shipping_address = get_address($_SESSION['user']['shipAddressID']);
        $state = $shipping_address['state'];
        $tax = tax_amount($subtotal);    // function from order_db.php file
        $total = $subtotal + $tax + $shipping_cost;
        include 'checkout_confirm.php';
        break;
    case 'payment':
        if (cart_product_count() == 0) {
            redirect($app_path . 'cart');
        }
        $card_number = '';
        $card_cvv = '';
        $card_expires = '';
        
        $cc_number_message = '';
        $cc_ccv_message = '';
        $cc_expiration_message = '';
        
        $billing_address = get_address($_SESSION['user']['billingAddressID']);
        include 'checkout_payment.php';
        break;
    case 'process':
        if (cart_product_count() == 0) {
            redirect('Location: ' . $app_path . 'cart');
        }
        $cart = cart_get_items();
        $card_type = filter_input(INPUT_POST, 'card_type', FILTER_VALIDATE_INT);
        $card_number = filter_input(INPUT_POST, 'card_number');
        $card_cvv = filter_input(INPUT_POST, 'card_cvv');
        $card_expires = filter_input(INPUT_POST, 'card_expires');

        $billing_address = get_address($_SESSION['user']['billingAddressID']);

        // Validate card data
        // NOTE: This uses functions from the util/validation.php file
        if ($card_type === false) {
            display_error('Card type is required.');
        } elseif (!is_valid_card_type($card_type)) {
            display_error('Card type ' . $card_type . ' is invalid.');
        }
        
        $cc_number_message = '';
        if ($card_number == null) {
            $cc_number_message = 'Required.';
        } elseif (!is_valid_card_number($card_number, $card_type)) {
            $cc_number_message = 'Invalid.';
        }
        
        $cc_ccv_message = '';
        if ($card_cvv == null) {
            $cc_ccv_message = 'Required.';
        } elseif (!is_valid_card_cvv($card_cvv, $card_type)) {
            $cc_ccv_message = 'Invalid.';
        }
        
        $cc_expiration_message = '';        
        if ($card_expires == null) {
            $cc_expiration_message = 'Required.';
        } elseif (!is_valid_card_expires($card_expires)) {
            $cc_expiration_message = 'Invalid.';
        }

        // If error messages are not empty, 
        // redisplay Checkout page and exit controller
        if (!empty($cc_number_message) || !empty($cc_ccv_message) ||
                !empty($cc_expiration_message)) {
            include 'checkout/checkout_payment.php';
            break;
        }

        $order_id = add_order($card_type, $card_number,
                              $card_cvv, $card_expires);

        foreach($cart as $product_id => $item) {
            $item_price = $item['list_price'];
            $discount = $item['discount_amount'];
            $quantity = $item['quantity'];
            add_order_item($order_id, $product_id,
                           $item_price, $discount, $quantity);
        }
        clear_cart();
        redirect('../account?action=view_order&order_id=' . $order_id);
        break;
    default:
        display_error('Unknown cart action: ' . $action);
        break;
}
?>
