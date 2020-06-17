<?php include 'view/header.php'; ?>
<?php include 'view/sidebar_admin.php'; ?>
<main>
    <h2>Delete Order</h2>
    <p>Order Number: <?php echo $order_id; ?></p>
    <p>Order Date: <?php echo $order_date; ?></p>
    <p>Customer: <?php echo htmlspecialchars($customer_name) . ' (' . 
            htmlspecialchars($email) . ')'; ?></p>
    <p>Are you sure you want to delete this order?</p>
    <form action="." method="post">
        <input type="hidden" name="action" value="delete">
        <input type="hidden" name="order_id"
               value="<?php echo $order_id; ?>">
        <input type="submit" value="Delete Order">
    </form>
    <form action="." method="post">
        <input type="submit" value="Cancel">
    </form>
</main>
<?php include 'view/footer.php'; ?>