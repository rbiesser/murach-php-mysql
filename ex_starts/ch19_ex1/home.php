<?php include 'view/header.php'; ?>
<main>
    <h1>Selected Product List</h1>
    <ul>
    <?php foreach ($products as $product) : ?>
        <li> <?php echo $product['productName']; ?></li>
    <?php endforeach; ?>
    </ul>

    <h1>Delete Message</h1>
    <p> <?php echo $delete_message; ?></p>

    <h1>Insert Message</h1>
    <p> <?php echo $insert_message; ?></p>
</main><!-- end content -->
<?php include 'view/footer.php'; ?>