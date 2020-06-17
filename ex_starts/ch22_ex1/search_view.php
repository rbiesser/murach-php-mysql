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

<h2>Search</h2>
<form action="." method="post">
    <input type="text" name="query" value="<?php echo $query; ?>"/>
    <input type="submit" value="Search"/>
</form>
<?php if (count($videos) != 0) : ?>
    <h2>Results</h2>
    <table>
    <?php foreach ($videos as $video) :
        $imgsrc = $video['media$group']['media$thumbnail'][0]['url'];
        $url = $video['link'][0]['href'];
        $text = $video['title']['$t'];
    ?>
        <tr>
            <td>
                <a href="<?php echo $url; ?>">
                    <img src="<?php echo $imgsrc; ?>"/>
                </a>
            </td>
            <td>
                <form action="." method="post">
                    <input type="hidden" name="action"
                           value="display_email_view"/>
                    <input type="hidden" name="url"
                           value="<?php echo $url; ?>"/>
                    <input type="hidden" name="text"
                           value="<?php echo $text; ?>"/>
                    <input type="submit" value="Email this Link"/>
                </form>
                <a href="<?php echo $url; ?>">
                    <?php echo $text; ?>
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
    </table>
<?php endif; ?>

            </div><!-- end main -->
        </div><!-- end page -->
    </body>
</html>
