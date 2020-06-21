<div class="ui three cards">
<?php foreach($items as $item): ?>
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
        <div class="ui bottom attached button">
            <i class="add icon"></i>
            Add to cart
        </div>
    </a>
<?php endforeach ?>
</div>

<div class="ui centered grid">
    <div class="ui centered row">
<div class="ui pagination menu">
  <a class="active item">
    1
  </a>
  <!-- <div class="disabled item">
    ...
  </div>
  <a class="item">
    10
  </a>
  <a class="item">
    11
  </a>
  <a class="item">
    12
  </a> -->
</div>

</div>
</div>