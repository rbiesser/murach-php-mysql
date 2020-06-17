<?php include 'view/header.php'; ?>
<?php include 'view/sidebar_admin.php'; ?>
<main>
    <h1>Outstanding Orders</h1>
    <?php if (count($new_orders) > 0 ) : ?>
        <ul>
            <?php foreach($new_orders as $order) :
                $order_id = $order['orderID'];
                $order_date = strtotime($order['orderDate']);
                $order_date = date('M j, Y', $order_date);
                $url = $app_path . 'admin/orders' .
                       '?action=view_order&amp;order_id=' . $order_id;
                ?>
                <li>
                    <a href="<?php echo $url; ?>">Order # 
                    <?php echo $order_id; ?></a> for
                    <?php echo $order['firstName'] . ' ' .
                               $order['lastName']; ?> placed on
                    <?php echo $order_date; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>There are no shipped orders.</p>
    <?php endif; ?>
    <h1>Shipped Orders</h1>
    <?php if (count($old_orders) > 0 ) : ?>
        <ul>
            <?php foreach($old_orders as $order) :
                $order_id = $order['orderID'];
                $order_date = strtotime($order['orderDate']);
                $order_date = date('M j, Y', $order_date);
                $url = $app_path . 'admin/orders' .
                       '?action=view_order&amp;order_id=' . $order_id;
                ?>
                <li>
                    <a href="<?php echo $url; ?>">Order #
                    <?php echo $order_id; ?></a> for
                    <?php echo htmlspecialchars($order['firstName']) . ' ' .
                               htmlspecialchars($order['lastName']); ?> placed on
                    <?php echo $order_date; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>There are no shipped orders.</p>
    <?php endif; ?>
</main>
<?php include 'view/footer.php'; ?>