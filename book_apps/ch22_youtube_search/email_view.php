<!DOCTYPE html>
<html>
<head>
    <title>YouTube Search</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
<header><h1>YouTube Search</h1></header>
<main>
    <h2>Email the YouTube link</h2>

    <?php if (isset($error)) : ?>
    <p class="error">
        Error Sending E-mail: <?php echo htmlspecialchars($error); ?>
    </p>
    <?php endif; ?>

    <form action="." method="post" id="email_form">
        <input type="hidden" name="action" value="send_mail">
        <input type="hidden" name="url" 
               value="<?php echo htmlspecialchars($url); ?>">
        <input type="hidden" name="text" 
               value="<?php echo htmlspecialchars($text); ?>">

        <label>From:</label>
        <input type="text" name="from">
        <span>Your email address</span><br>

        <label>To:</label>
        <input type="text" name="to">
        <span>Your friend's email address</span><br>

        <label>Subject:</label>
        <input type="text" name="subject" value="YouTube Video Link"><br>

        <label>Video:</label>
        <span><?php echo htmlspecialchars($text); ?></span><br>

        <label>Link:</label>
        <span><?php echo htmlspecialchars($url); ?></span><br>

        <label>Message:</label>
        <textarea name="message">I thought you might enjoy this video.
        </textarea><br>

        <label>&nbsp;</label>
        <input type="submit" value="Send">
    </form>

    <form action="." method="post" id="cancel_form">
        <label>&nbsp;</label>
        <input type="submit" value="Cancel">
    </form>
</main>
</body>
</html>