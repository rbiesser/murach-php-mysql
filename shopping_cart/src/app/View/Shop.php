<?php if (empty($items)): ?>
    <div class="ui error message">
        <div class="header">
            <?php echo $error_message ?>
        </div>
    </div> 
<?php else: ?>
    <div class="ui three cards">
    <?php foreach($items as $item): ?>
        <?php include dirname(__DIR__) . '/View/components/ItemCard.php' ?>
    <?php endforeach ?>
    </div>

    <div class="ui centered grid">
        <div class="ui centered row">
            <div class="ui pagination menu">
            <?php for ($page = 1; $page < $items_count / $items_per_page + 1; $page++):?>

                <a class="<?php echo ($page == $current_page) ? 'active' : '' ?> item" href="/<?php echo $controller ?>/page/<?php echo $page ?>">
                    <?php echo $page ?>
                </a>

            <?php endfor ?>
            </div>

        </div>
    </div>
<?php endif ?>