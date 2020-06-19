<?php
/**
 * 4. add $cart parameter to all functions
 *      - replace all occurrences of $_SESSION['cart13'] with $cart
 *      - functions now return $cart
 */

// Add an item to the cart
function add_item($cart, $key, $quantity) {
    global $products;
    if ($quantity < 1) return;

    // If item already exists in cart, update quantity
    if (isset($cart[$key])) {
        $quantity += $cart[$key]['qty'];
        // fix error from instruction screenshots !!!!
        $cart = update_item($cart, $key, $quantity);
        return $cart;
    }

    // Add item
    $cost = $products[$key]['cost'];
    $total = $cost * $quantity;
    $item = array(
        'name' => $products[$key]['name'],
        'cost' => $cost,
        'qty'  => $quantity,
        'total' => $total
    );
    $cart[$key] = $item;

    return $cart;
}

// Update an item in the cart
function update_item($cart, $key, $quantity) {
    $quantity = (int) $quantity;
    if (isset($cart[$key])) {
        if ($quantity <= 0) {
            unset($cart[$key]);
        } else {
            $cart[$key]['qty'] = $quantity;
            $total = $cart[$key]['cost'] *
                     $cart[$key]['qty'];
            $cart[$key]['total'] = $total;
        }
    }

    return $cart;
}

// Get cart subtotal
function get_subtotal ($cart) {
    $subtotal = 0;
    foreach ($cart as $item) {
        $subtotal += $item['total'];
    }
    $subtotal_f = number_format($subtotal, 2);
    return $subtotal_f;
}
?>