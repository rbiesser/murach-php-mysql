<!DOCTYPE html>
<html>
<head>
    <title>Date Tester</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <h1>Date Tester</h1>
        <form action="." method="post">
        <input type="hidden" name="action" value="process_data">

        <label>Invoice Date:</label>
        <input type="text" name="invoice_date"
               value="<?php echo htmlspecialchars($invoice_date_s); ?>">
        <br>

        <label>Due Date:</label>
        <input type="text" name="due_date"
               value="<?php echo htmlspecialchars($due_date_s); ?>">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Submit">
        <br>

        </form>
        <h2>Message:</h2>
        <?php if ($message != '') : ?>          
            <p><?php echo $message; ?></p>
        <?php else : ?>
        <table>
            <tr>
                <td>Invoice date:</td>
                <td><?php echo $invoice_date_f; ?></td>
            </tr>
            <tr>
                <td>Due date:</td>
                <td><?php echo $due_date_f; ?></td>
            </tr>
            <tr>
                <td>Current date:</td>
                <td><?php echo $current_date_f; ?></td>
            </tr>
            <tr>
                <td>Current time:</td>
                <td><?php echo $current_time_f; ?></td>
            </tr>
            <tr>
                <td>Due date message:</td>
                <td><?php echo $due_date_message; ?></td>
            </tr>
        </table>
        <?php endif; ?>

    </main>
</body>
</html>