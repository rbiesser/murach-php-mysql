<?php
function add_tags($text) {

    // Convert return characters to the Unix new lines
    $text = str_replace("\r\n", "\n", $text);  // convert Windows
    $text = str_replace("\r", "\n", $text);    // convert Mac

    // Get an array of paragraphs
    $paragraphs = explode("\n\n", $text);

    // Add tags to each paragraph
    $text = '';
    foreach($paragraphs as $p) {
        $p = ltrim($p);

        $first_char = substr($p, 0, 1);
        if ($first_char == '*') {
            // Add <ul> and <li> tags
            $p = '<ul>' . $p . '</li></ul>';
            $p = str_replace("*", '<li>', $p);
            $p = str_replace("\n", '</li>', $p);
        } else {
            // Add <p> tags
            $p = '<p>' . $p . '</p>';
        }
        $text .= $p;
    }

    return $text;
}
?>
