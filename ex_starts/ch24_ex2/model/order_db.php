<?php

// This function calculates a shipping charge of $5 per item
// but it only charges shipping for the first 5 items
function shipping_cost() {
    $item_count = cart_item_count();
    $item_shipping = 5;   // $5 per item
    if ($item_count > 5) {
        $shipping_cost = $item_shipping * 5;
    } else {
        $shipping_cost = $item_shipping * $item_count;
    }
    return $shipping_cost;
}

// This function calcualtes the sales tax,
// but only for orders in California (CA)
function tax_amount($subtotal) {
    $shipping_address = get_address($_SESSION['user']['shipAddressID']);
    $state = $shipping_address['state'];
    $state = strtoupper($state);
    switch ($state) {
        case 'CA': $tax_rate = 0.09; break;
        default: $tax_rate = 0; break;
    }
    return round($subtotal * $tax_rate, 2);
}

function card_name($card_type) {
    switch($card_type){
        case 1: 
           return 'MasterCard';
        case 2: 
            return 'Visa';
        case 3: 
            return 'Discover';
        case 4:
            return 'American Express';
        default:
            return 'Unknown Card Type';
    }
}

function add_order($card_type, $card_number, $card_cvv, $card_expires) {
    global $db;
    $customer_id = $_SESSION['user']['customerID'];
    $billing_id = $_SESSION['user']['billingAddressID'];
    $shipping_id = $_SESSION['user']['shipAddressID'];
    $shipping_cost = shipping_cost();
    $tax = tax_amount(cart_subtotal());
    $order_date = date("Y-m-d H:i:s");

    $query = '
         INSERT INTO orders (customerID, orderDate, shipAmount, taxAmount,
                             shipAddressID, cardType, cardNumber,
                             cardExpires, billingAddressID)
         VALUES (:customer_id, :order_date, :ship_amount, :tax_amount,
                 :shipping_id, :card_type, :card_number,
                 :card_expires, :billing_id)';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->bindValue(':order_date', $order_date);
    $statement->bindValue(':ship_amount', $shipping_cost);
    $statement->bindValue(':tax_amount', $tax);
    $statement->bindValue(':shipping_id', $shipping_id);
    $statement->bindValue(':card_type', $card_type);
    $statement->bindValue(':card_number', $card_number);
    $statement->bindValue(':card_expires', $card_expires);
    $statement->bindValue(':billing_id', $billing_id);
    $statement->execute();
    $order_id = $db->lastInsertId();
    $statement->closeCursor();
    return $order_id;
}

function add_order_item($order_id, $product_id,
                        $item_price, $discount, $quantity) {
    global $db;
    $query = '
        INSERT INTO OrderItems (orderID, productID, itemPrice,
                                discountAmount, quantity)
        VALUES (:order_id, :product_id, :item_price, :discount, :quantity)';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->bindValue(':product_id', $product_id);
    $statement->bindValue(':item_price', $item_price);
    $statement->bindValue(':discount', $discount);
    $statement->bindValue(':quantity', $quantity);
    $statement->execute();
    $statement->closeCursor();
}

function get_order($order_id) {
    global $db;
    $query = 'SELECT * FROM orders WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order = $statement->fetch();
    $statement->closeCursor();
    return $order;
}

function get_order_items($order_id) {
    global $db;
    $query = 'SELECT * FROM OrderItems WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $order_items = $statement->fetchAll();
    $statement->closeCursor();
    return $order_items;
}

function get_orders_by_customer_id($customer_id) {
    global $db;
    $query = 'SELECT * FROM orders WHERE customerID = :customer_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':customer_id', $customer_id);
    $statement->execute();
    $order = $statement->fetchAll();
    $statement->closeCursor();
    return $order;
}

function get_unfilled_orders() {
    global $db;
    $query = 'SELECT * FROM orders
              INNER JOIN customers
              ON customers.customerID = orders.customerID
              WHERE shipDate IS NULL ORDER BY orderDate';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

function get_filled_orders() {
    global $db;
    $query =
        'SELECT * FROM orders
         INNER JOIN customers
         ON customers.customerID = orders.customerID
         WHERE shipDate IS NOT NULL ORDER BY orderDate';
    $statement = $db->prepare($query);
    $statement->execute();
    $orders = $statement->fetchAll();
    $statement->closeCursor();
    return $orders;
}

function set_ship_date($order_id) {
    global $db;
    $ship_date = date("Y-m-d H:i:s");
    $query = '
         UPDATE orders
         SET shipDate = :ship_date
         WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':ship_date', $ship_date);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}

function delete_order($order_id) {
    global $db;
    $query = 'DELETE FROM orders WHERE orderID = :order_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':order_id', $order_id);
    $statement->execute();
    $statement->closeCursor();
}
?>