<?php if (isset($message)) : ?>
    <div class="ui <?php echo $message['type'] ?> message">
        <div class="header">
            <?php echo $message['header'] ?>
        </div>
        <p><?php echo $message['body'] ?></p>
    </div>
<?php endif ?>

<h1>My Account</h1>
<h2><?php echo $customer->getFullName() . ' (' . $customer->getEmailAddress() . ')'; ?></h2>
<a href="/account/edit" class="ui blue button">Edit Account</a>
<h2>Saved Address</h2>
<?php if (count($addresses) > 0) : ?>
    <table class="ui table">
        <thead>
            <tr>
                <th class="three wide"></th>
                <th class="twelve wide"></th>
                <th class="three wide"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($addresses as $address) : ?>
                <tr>
                    <td>
                        <a href="/address" type="button" class="ui inverted secondary button">Edit Address</a>
                    </td>
                    <td>
                        <h3><?php echo $address->getOneLiner() ?></h3>
                    </td>
                    <td class="center aligned">
                    <form method="post" action="/cart/delete">
                            <input type="hidden" name="action" value='delete' />
                            <input type="hidden" name="code" value="" />
                            <button type="submit" class="ui inverted red button">Remove</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach ?>
        <tfoot>
            <tr>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </tfoot>
    </table>
<?php else : ?>
    <div class="ui message">
        <p>You have not added an address yet.</p>
    </div>
<?php endif ?>
<div>

    <a href="/address/add" class="ui blue button">Add an Address</a>
</div>
<!-- <h2>Billing Address</h2>
<?php if (isset($shipping_address)) : ?>
<p><?php echo htmlspecialchars($billing_address['line1']); ?><br>
    <?php if (strlen($billing_address['line2']) > 0) : ?>
        <?php echo htmlspecialchars($billing_address['line2']); ?><br>
    <?php endif; ?>
    <?php echo htmlspecialchars($billing_address['city']); ?>, <?php
                                                                echo htmlspecialchars($billing_address['state']); ?>
    <?php echo htmlspecialchars($billing_address['zipCode']); ?><br>
    <?php echo htmlspecialchars($billing_address['phone']); ?>
</p>
<form action="." method="post">
    <input type="hidden" name="action" value="view_address_edit">
    <input type="hidden" name="address_type" value="billing">
    <input type="submit" value="Edit Billing Address">
</form>
<?php else : ?>
    <div class="ui message">
        <p>No information for shipping address saved.</p>
    </div>
<?php endif ?> -->
<?php if (count($orders) > 0) : ?>
    <h2>Your Orders</h2>
    <ul>
        <?php foreach ($orders as $order) :
            $order_id = $order['orderID'];
            $order_date = strtotime($order['orderDate']);
            $order_date = date('M j, Y', $order_date);
            $url = $app_path . 'account' .
                '?action=view_order&order_id=' . $order_id;
        ?>
            <li>
                Order # <a href="<?php echo $url; ?>">
                    <?php echo $order_id; ?></a> placed on
                <?php echo $order_date; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>