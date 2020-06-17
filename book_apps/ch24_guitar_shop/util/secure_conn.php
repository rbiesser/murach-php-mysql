<?php
    // make sure the page uses a secure connection
    $https = filter_input(INPUT_SERVER, 'HTTPS');
    if (!$https) {
        $host = filter_input(INPUT_SERVER, 'HTTP_HOST', FILTER_SANITIZE_STRING);
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);
        $url = 'https://' . $host . $uri;
        header("Location: " . $url);
        exit();
    }
?>