<?php if (isset($message)) : ?>
    <div class="ui <?php echo $message['type'] ?> message">
        <div class="header">
            <?php echo $message['header'] ?>
        </div>
        <p><?php echo $message['body'] ?></p>
    </div>
<?php endif ?>

<div class="ui grid">

    <div class="row">
        <div class="three wide column">

            <h2>Place an Order</h2>
        </div>
        <?php if (count($cart) > 0) : ?>
            <div class="four wide column right floated right aligned">
                <form method="post" action="/cart/empty">
                    <button type="submit" class="ui inverted secondary button">Empty Cart</button>
                </form>
            </div>
        <?php endif ?>
    </div>
</div>
<?php if (count($cart) > 0) : ?>
    <table class="ui table">
        <thead>
            <tr>
                <th class="one wide"></th>
                <th class="six wide">Item</th>
                <th class="two wide left aligned">Price</th>
                <th class="one wide center aligned"></th>
                <th class="one wide center aligned">Quantity</th>
                <th class="two wide right aligned">Total</th>
                <th class="two wide center aligned"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($cart as $itemInCart) : ?>
                <tr>
                    <td><a href="/shop/view/<?php echo $itemInCart['product']->getCode() ?>"><img class="ui small image" src="<?php echo $itemInCart['product']->getArtwork() ?>" /></a></td>
                    <td><a href="/shop/view/<?php echo $itemInCart['product']->getCode() ?>"><h3><?php echo $itemInCart['product']->getName() ?></h3></a></td>
                    <td class="left aligned"><?php echo "$ " . number_format($itemInCart['product']->getPrice(), 2) ?></td>
                    <td class="center aligned">x</td>
                    <td class="center aligned">
                        <form method="post" action="/cart" class="ui form">
                            <input type="hidden" name="action" value='edit' />
                            <input type="hidden" name="code" value="<?php echo $itemInCart['product']->getCode() ?>" />
                            <div class="fields">
                                <input class="quantity" type="number" min="1" name="quantity" value="<?php echo $itemInCart['quantity'] ?>" />
                            </div>
                            <div class="fields">
                                <button type="submit" class="ui inverted secondary button">Update</button>
                            </div>
                        </form>
                    </td>
                    <td class="right aligned"><?php echo "$ " . number_format($itemInCart['product']->getPrice() * $itemInCart['quantity'], 2) ?></td>
                    <td class="center aligned">
                        <form method="post" action="/cart/delete">
                            <input type="hidden" name="action" value='delete' />
                            <input type="hidden" name="code" value="<?php echo $itemInCart['product']->getCode() ?>" />
                            <button type="submit" class="ui inverted red button">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>


    <div class="ui grid">
        <div class="right floated left aligned five wide column">
            <div class="ui segment">
                <div class="ui grid container">

                    <div class="two column row">
                        <div class="six wide column">Item Total</div>
                        <div class="ten wide right aligned column"><?php echo "$ " . number_format($total_price, 2) ?></div>
                    </div>

                    <div class="two column row">
                        <div class="six wide column">Tax</div>
                        <div class="ten wide right aligned column"><?php echo "$ " . number_format($total_price * .043, 2) ?></div>
                    </div>

                    <div class="two column row">
                        <div class="six wide column large bold text">Subtotal</div>
                        <div class="ten wide right aligned column large bold text">
                            <?php echo "$ " . number_format($total_price + ($total_price * .043), 2) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="center aligned column">
                            <a class="ui big green labeled icon button" href="/cart/checkout">
                                <i class="lock icon"></i>
                                Secure Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="two wide column"></div>
    </div>

<?php else : ?>
    <div class="ui message">
        <p>Your cart is empty.</p>
    </div>
<?php endif ?>

<script>
    // $('.quantity').each(() => {
    //     $(this).change((index) => {
    //         // $('button').toggleClass('disabled')
    //         // // console.log($(this).closest('form'))
    //         // // .
    //         console.log(index)
    //     })
    // })
</script>