<aside>
    <!-- These links are for testing only.
         Remove them from a production application. -->
    <h2>Links</h2>
    <ul>
        <li>
            <a href="<?php echo $app_path; ?>">Home</a>
        </li>
        <li>
            <a href="<?php echo $app_path . 'admin'; ?>">Admin</a>
        </li>
    </ul>
    <h2>Categories</h2>
    <ul>
        <!-- display links for all categories -->
        <?php foreach ($categories as $category) : ?>
        <li>
            <a href="<?php echo $app_path . 'catalog' . 
                '?action=list_products' .
                '&amp;category_id=' . $category['categoryID']; ?>">
                <?php echo $category['categoryName']; ?>
            </a>
        </li>
        <?php endforeach; ?>
        <li>&nbsp;</li>
    </ul>
</aside>
