<?php if (empty($item)) : ?>
    <div class="ui error message">
        <div class="header">
            <?php echo $error_message ?>
        </div>
        <p>Try one of these choices</p>
    </div>
<?php else : ?>
    <p><a href="/shop" class="ui button">Back to Gallery</a></p>

    <?php if (isset($message)) : ?>
        <div class="ui <?php echo $message['type'] ?> message">
            <div class="header">
                <?php echo $message['header'] ?>
            </div>
            <p><?php echo $message['body'] ?></p>
        </div>
    <?php endif ?>

    <div class="ui two column centered grid">
        <div class="centered row">
            <div class="column">
                <img class="ui massive image" src="/img/placeholder.png">
            </div>
            <div class="column">
                <div class="grid">
                    <h2><?php echo $item->getName() ?></h2>
                    <div class="row">
                        <p><?php echo $item->getDescription() ?></p>
                    </div>
                    <h3>
                        <?php echo "$ " . number_format($item->getPrice(), 2) ?>
                    </h3>
                    <form class="ui form" method="post" action="/cart/add">
                        <div class="fields">
                            <div class="three wide field">
                                <label>Quantity</label>
                                <input type="number" name="quantity" value='1' min='1' />
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="code" value="<?php echo $item->getCode() ?>" />
                            <button class="ui big blue button" type="submit">Add to cart</a>
                        </div>
                    </form>
                </div>
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

<h2>Related Items</h2>
<div class="ui three cards">
    <?php foreach ($featured_items as $item) : ?>
        <?php include dirname(__DIR__) . '/View/components/ItemCard.php' ?>
    <?php endforeach ?>
</div>