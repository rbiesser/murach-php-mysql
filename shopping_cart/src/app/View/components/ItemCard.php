<a class="ui card" href="/shop/view/<?php echo $item->getCode() ?>">
<div class="image">
    <img src="<?php echo $item->getArtwork() ?>">
</div>
<div class="content">
    <div class="header"><?php echo $item->getName() ?>
    <span class="right floated">
    <?php echo "$ " . number_format($item->getPrice(), 2) ?>
    </span></div>
    <div class="description">
        <?php // echo $item->getDescription() ?>
    </div>
</div>
<!-- <div class="ui bottom attached button">
    <i class="add icon"></i>
    Add to cart
</div> -->
</a>