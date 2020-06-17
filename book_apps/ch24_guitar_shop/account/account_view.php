<?php include '../view/header.php'; ?>
<?php include '../view/sidebar.php'; ?>
<main>
    <h1>My Account</h1>
    <p><?php echo $customer_name . ' (' . $email . ')'; ?></p>
    <form action="." method="post">
        <input type="hidden" name="action" value="view_account_edit">
        <input type="submit" value="Edit Account">
    </form>
    <h2>Shipping Address</h2>
    <p><?php echo htmlspecialchars($shipping_address['line1']); ?><br>
        <?php if ( strlen($shipping_address['line2']) > 0 ) : ?>
            <?php echo htmlspecialchars($shipping_address['line2']); ?><br>
        <?php endif; ?>
        <?php echo htmlspecialchars($shipping_address['city']); ?>, <?php 
              echo htmlspecialchars($shipping_address['state']); ?>
        <?php echo htmlspecialchars($shipping_address['zipCode']); ?><br>
        <?php echo htmlspecialchars($shipping_address['phone']); ?>
    </p>
    <form action="." method="post">
        <input type="hidden" name="action" value="view_address_edit">
        <input type="hidden" name="address_type" value="shipping">
        <input type="submit" value="Edit Shipping Address">
    </form>
    <h2>Billing Address</h2>
    <p><?php echo htmlspecialchars($billing_address['line1']); ?><br>
        <?php if ( strlen($billing_address['line2']) > 0 ) : ?>
            <?php echo htmlspecialchars($billing_address['line2']); ?><br>
        <?php endif; ?>
        <?php echo htmlspecialchars($billing_address['city']); ?>, <?php 
              echo htmlspecialchars($billing_address['state']); ?>
        <?php echo htmlspecialchars($billing_address['zipCode']); ?><br>
        <?php echo htmlspecialchars($billing_address['phone']); ?>
    </p>
    <form action="." method="post">
        <input type="hidden" name="action" value="view_address_edit">
        <input type="hidden" name="address_type" value="billing">
        <input type="submit" value="Edit Billing Address">
    </form>
    <?php if (count($orders) > 0 ) : ?>
        <h2>Your Orders</h2>
        <ul>
            <?php foreach($orders as $order) :
                $order_id = $order['orderID'];
                $order_date = strtotime($order['orderDate']);
                $order_date = date('M j, Y', $order_date);
                $url = $app_path . 'account' .
                       '?action=view_order&order_id=' . $order_id;
                ?>
                <li>
                    Order # <a href="<?php echo $url; ?>">
                    <?php echo $order_id; ?></a> placed on
                    <?php echo $order_date; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</main>
<?php include '../view/footer.php'; ?>
