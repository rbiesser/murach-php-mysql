<h2>Featured Items</h2>
<?php if (empty($items)): ?>
    <h3>We're still working to bring you the hottest items!</h3>            
<?php else: ?>
    <div class="ui three cards">
    <?php foreach($items as $item): ?>
        <?php include dirname(__DIR__) . '/View/components/ItemCard.php' ?>
    <?php endforeach ?>
    </div>
<?php endif ?>