<?php if (empty($item)): ?>
    <div class="ui error message">
        <div class="header">
            <?php echo $error_message ?>
        </div>
        <p>Try one of these choices</p>
    </div>         
<?php else: ?>
    <a href="/cart">
        <div class="ui success message hidden">
            <div class="header">
                Your item has been added to the cart.
            </div>
            <p>Click this message to view the items in your cart.</p>
        </div>
    </a>

    <p><a href="/shop">Back to gallery</a></p>

    <div class="ui two column centered grid">
        <div class="centered row">
            <div class="column">
                <img class="ui massive image" src="/img/placeholder.png">
            </div>
            <div class="column">
                <form method="post" action="/cart/add">
                    <div class="grid">
                        <div class="row">
                            <h2><?php echo $item->getName() ?></h2>
                        </div>
                        <div class="row">
                            <h3>
                                <?php echo $item->getPrice() ?>
                            </h3>
                        </div>
                        <div class="row">
                            <p><?php echo $item->getDescription() ?></p>
                        </div>
                        <div class="row">
                            <label for="quantity">Quantity</label>
                            <input type="number" name="quantity" value='1' min='1'/>
                        </div>
                        <div class="row">
                            <input type="hidden" name="code" value="<?php echo $item->getCode() ?>" />
                            <button class="ui button" type="submit">Add to cart</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="ui centered grid">
        <div class="ui centered row">
            <div class="ui small images">
                <img src="/img/placeholder.png">
                <img src="/img/placeholder.png">
                <img src="/img/placeholder.png">
                <img src="/img/placeholder.png">
            </div>
        </div>
    </div>

    <?php endif ?>

    <h2>Featured Items</h2>
    <div class="ui three cards">
    <?php foreach($featured_items as $item): ?>
        <?php include dirname(__DIR__) . '/View/components/ItemCard.php' ?>
    <?php endforeach ?>
    </div>