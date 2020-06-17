<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>YouTube Search</title>
        <link rel="stylesheet" type="text/css" href="main.css"/>
    </head>
    <body>
        <div id="page">
            <div id="header"><h1>YouTube Search</h1></div>
            <div id="main">

<h2>Email the YouTube link</h2>

<?php if (isset($error)) : ?>
    <p>Error Sending E-mail: <?php echo $error; ?></p>
<?php endif; ?>

<form action="." method="post" id="email_form">
    <input type="hidden" name="action" value="send_mail"/>
    <input type="hidden" name="url" value="<?php echo $url; ?>"/>
    <input type="hidden" name="text" value="<?php echo $text; ?>"/>

    <label>From:</label>
    <input type="text" name="from"/> Your email address<br />

    <label>To:</label>
    <input type="text" name="to"/> Your friend's email address<br />

    <label>Subject:</label>
    <input type="text" name="subject" value="YouTube Video Link"/><br />

    <label>Video:</label>
    <?php echo $text; ?><br />

    <label>Link:</label>
    <?php echo $url; ?><br />

    <label>Message:</label>
    <textarea name="message">I thought you might enjoy this video.</textarea>
    <br />

    <label>&nbsp;</label>
    <input type="submit" value="Send"/>
</form>

<form action="." method="post" id="cancel_form">
    <label>&nbsp;</label>
    <input type="submit" value="Cancel"/>
</form>

            </div><!-- end main -->
        </div><!-- end page -->
    </body>
</html>
