<?php include 'header.php'; ?>
<main>
    <h2>Success</h2>
    <p>The following registration information has been successfully
       submitted.</p>
    <ul>
        <li>Email: <?php echo htmlspecialchars($email); ?></li>
        <li>First Name: <?php echo htmlspecialchars($firstName); ?></li>
        <li>Last Name: <?php echo htmlspecialchars($lastName); ?></li>
        <li>Address: <?php echo htmlspecialchars($address); ?></li>
        <li>City: <?php echo htmlspecialchars($city); ?></li>
        <li>State: <?php echo htmlspecialchars($state); ?></li>
        <li>ZIP: <?php echo htmlspecialchars($zip); ?></li>
        <li>Phone: <?php echo htmlspecialchars($phone); ?></li>
        <li>Card Type: <?php echo htmlspecialchars($cardType); ?></li>
        <li>Card Number: <?php echo htmlspecialchars($cardNumber); ?></li>
        <li>Expiration: <?php echo htmlspecialchars($expDate); ?></li>
    </ul>
</div>
<?php include 'footer.php'; ?>