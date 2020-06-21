<a class="ui card" href="/view/<?php echo $item->getCode() ?>">
<div class="image">
    <img src="<?php echo $item->getArtwork() ?>">
</div>
<div class="content">
    <div class="header"><?php echo $item->getDescription() ?>
    <span class="right floated">
    <?php echo $item->getPrice() ?>
    </span></div>
    <div class="description">
        <?php echo $item->getPrice() ?>
    </div>
</div>
<!-- <div class="ui bottom attached button">
    <i class="add icon"></i>
    Add to cart
</div> -->
</a>