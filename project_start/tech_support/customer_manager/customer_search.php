<?php include '../view/header.php'; ?>
<main>
    <?php if (isset($message)): ?>
        <!-- the alert popup method -->
        <!-- <script>alert('<?php echo $message ?>')</script> -->
    <div class="alert <?php echo $message_type ?>">
        <?php echo $message ?>
    </div>
    <?php endif ?>

    <h2>Customer Search</h2>
    <form id="customer_search_form" method="post">
        <label for="lastname">Last Name:</label>
        <input type="text" name="lastname" />
        <button type="submit" class="btn btn-primary">Search</button>
    </form>
    <br />
    <h2>Add a new customer</h2>
    <form id="add_customer_form" method="post" action="/customer_manager?action=customer_add">
        <button type="submit" class="btn btn-success">Add customer</button>
    </form>

    <?php if (!empty($customers)): ?>

    <h1>Customer List</h1>
    <section>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>&nbsp;</th>
            </tr>
            <?php foreach ($customers as $customer) : ?>
            <tr>
                <td>
                    <a href="?action=customer_update&customer_id=<?php echo $customer->getCustomerID(); ?>">
                        <?php echo $customer->getName(); ?>
                    </a>
                </td>
                <td><?php echo $customer->getEmail(); ?></td>
                <td><?php echo $customer->getPhone(); ?></td>
                <td><form action="." method="post"
                          id="delete_customer_form">
                    <input type="hidden" name="action"
                           value="customer_delete" />
                    <input type="hidden" name="customer_id"
                           value="<?php echo $customer->getCustomerID(); ?>" />
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form></td>
            </tr>
            <?php endforeach; ?>
        </table>
        <!-- <p><a href="?action=show_add_form">Add Product</a></p> -->
    </section>

    <?php endif ?>
    
</main>
<?php include '../view/footer.php'; ?>