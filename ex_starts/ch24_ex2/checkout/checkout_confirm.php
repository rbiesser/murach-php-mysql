<?php include '../view/header.php'; ?>
<main>
    <h1>Confirm Order</h1>
    <table id="cart">
        <tr id="cart_header">
            <th class="left" >Item</th>
            <th class="right">Price</th>
            <th class="right">Quantity</th>
            <th class="right">Total</th>
        </tr>
        <?php foreach ($cart as $product_id => $item) : ?>
            <tr>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item['unit_price']); ?>
                </td>
                <td class="right">
                    <?php echo $item['quantity']; ?>
                </td>
                <td class="right">
                    <?php echo sprintf('$%.2f', $item['line_price']); ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr id="cart_footer">
            <td colspan="3" class="right"><b>Subtotal</b></td>
            <td class="right">
                <?php echo sprintf('$%.2f', $subtotal); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="right"><?php echo $state; ?> Tax</td>
            <td class="right">
                <?php echo sprintf('$%.2f', $tax); ?>
            </td>
        </tr>
        <tr>
            <td colspan="3" class="right">Shipping</td>
            <td class="right">
                <?php echo sprintf('$%.2f', $shipping_cost); ?>
            </td>
        </tr>
            <tr>
            <td colspan="3" class="right"><b>Total</b></td>
            <td class="right">
                <?php echo sprintf('$%.2f', $total); ?>
            </td>
        </tr>
</table>
    <p>
        Proceed to: <a href="<?php echo '?action=payment'; ?>">Payment</a>
    </p>
</main>
<?php include '../view/footer.php'; ?>