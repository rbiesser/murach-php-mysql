<!DOCTYPE html>
<html>
<head>
    <title>YouTube Search</title>
    <link rel="stylesheet" type="text/css" href="main.css"/>
</head>
<body>
<header><h1>YouTube Search</h1></header>
<main>
    <h2>Search</h2>
    <form action="." method="post">
        <input type="text" name="query" 
               value="<?php echo htmlspecialchars($query); ?>">
        <input type="submit" value="Search">
    </form>
    <?php if (count($videos) > 0) : ?>
        <h2>Results</h2>
        <table>
        <?php foreach ($videos as $video) :
            $imgsrc = $video['media$group']['media$thumbnail'][0]['url'];
            $url = $video['link'][0]['href'];
            $text = $video['title']['$t'];
        ?>
            <tr>
                <td>
                    <a href="<?php echo htmlspecialchars($url); ?>">
                        <img src="<?php echo htmlspecialchars($imgsrc); ?>" 
                             alt="image missing">
                    </a>
                </td>
                <td>
                    <form action="." method="post">
                        <input type="hidden" name="action"
                               value="display_email_view">
                        <input type="hidden" name="url"
                               value="<?php echo htmlspecialchars($url); ?>">
                        <input type="hidden" name="text"
                               value="<?php echo htmlspecialchars($text); ?>">
                        <input type="submit" value="Email this Link">
                    </form>
                    <a href="<?php echo htmlspecialchars($url); ?>">
                        <?php echo htmlspecialchars($text); ?>
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
        </table>
    <?php endif; ?>
</main>
</body>
</html>
