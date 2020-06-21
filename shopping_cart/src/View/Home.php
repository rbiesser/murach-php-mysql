<h2>Featured Items</h2>
<div class="ui three cards">
<?php foreach($items as $item): ?>
    <?php include dirname(__DIR__) . '/View/components/ItemCard.php' ?>
<?php endforeach ?>
</div>