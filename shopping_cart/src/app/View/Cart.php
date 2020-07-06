<?php if (empty($cart)): ?>
    <p>No items in cart</p>            
<?php else: ?>
    <h2>Cart</h2>
    <table class="ui celled table">
    <thead>
        <tr>
            <th>Item</th>
            <th>Quantity</th>
            <th>Price</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cart as $item_code => $quantity): ?>
            <tr>
                <td><?php echo $items[$item_code]->getName() ?></td>
                <td><?php echo $quantity ?></td>
                <td><?php echo $items[$item_code]->getPrice() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
    </table>

    <div class="ui right action input">
        <a class="ui teal labeled icon button" href="/checkout">
            <i class="cart icon"></i>
            Checkout
        </a>
        <input type="text" value="<?php echo $total_price ?>">
    </div>
<?php endif ?>