<!DOCTYPE html>
<html>
<head>
    <title>Number Tester</title>
    <link rel="stylesheet" type="text/css" href="main.css">
</head>

<body>
    <main>
        <h1>Number Tester</h1>
        <form action="." method="post">
        <input type="hidden" name="action" value="process_data">

        <label>Number 1:</label>
        <input type="text" name="number1"
               value="<?php echo htmlspecialchars($number1); ?>">
        <br>

        <label>Number 2:</label>
        <input type="text" name="number2"
               value="<?php echo htmlspecialchars($number2); ?>">
        <br>

        <label>Number 3:</label>
        <input type="text" name="number3"
               value="<?php echo htmlspecialchars($number3); ?>">
        <br>

        <label>&nbsp;</label>
        <input type="submit" value="Submit">
        <br>

        </form>

        <h2>Message:</h2>
        <p><?php echo nl2br(htmlspecialchars($message), FALSE); ?></p>

    </main>
</body>
</html>