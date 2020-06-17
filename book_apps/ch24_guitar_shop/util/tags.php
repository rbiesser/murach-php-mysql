<?php
// Function to ensure HTML text is only encoded once
function html_convert($text) {
    if ( htmlspecialchars_decode($text) == $text ) {
        return htmlspecialchars($text);
    } else {
        return $text;
    }
}

// Function to add some HTML tags to unformatted text
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

// Function to remove some HTML tags from text
function remove_tags($text) {
    // Remove <ul> and <li> tags
    $text = str_replace('<ul>', '', $text);        // start of list
    $text = str_replace('</li></ul>', '', $text);  // end of list
    $text = str_replace('<li>', '*', $text);       // each item

    // Remove <p> tags
    $text = str_replace('</p><p>', "\n\n", $text);
    $text = str_replace('<p>', '', $text);
    $text = str_replace('</p>', '', $text);
    return $text;
}
?>