<?php if (empty($items)): ?>
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
        <tr>
        <td data-label="Name">James</td>
        <td data-label="Age">24</td>
        <td data-label="Job">Engineer</td>
        </tr>
        <tr>
        <td data-label="Name">Jill</td>
        <td data-label="Age">26</td>
        <td data-label="Job">Engineer</td>
        </tr>
        <tr>
        <td data-label="Name">Elyse</td>
        <td data-label="Age">24</td>
        <td data-label="Job">Designer</td>
        </tr>
    </tbody>
    </table>

    <div class="ui left action input">
    <a class="ui teal labeled icon button" href="/checkout">
        <i class="cart icon"></i>
        Checkout
    </a>
    <input type="text" value="$52.03">
    </div>
<?php endif ?>