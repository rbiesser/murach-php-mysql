<?php
require_once  'message.php';
session_start();

function search_youtube($query) {
    // Set up the URL for the query
    $query = urlencode($query);
    $base_url = 'http://gdata.youtube.com/feeds/api/videos';
    $params = 'alt=json&q=' . $query;
    $url = $base_url . '?' . $params;

    // Use cURL to get data in JSON format
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $json_data = curl_exec($curl);
    curl_close($curl);

    // Get an array of videos from the JSON data and return it
    $data = json_decode($json_data, true);
    $videos = $data['feed']['entry'];
    return $videos;
}

if (isset($_POST['action'])) {
    $action =  $_POST['action'];
} else {
    $action =  'search';
}

if (isset($_POST['query'])) {
    $query = $_POST['query'];
    $_SESSION['query'] = $query;
} else if (isset($_SESSION['query'])) {
    $query = $_SESSION['query'];
} else {
    $query = '';
}

switch ($action) {
    case 'search':
        if (!empty($query)) {
            $videos = search_youtube($query);
        }
        include 'search_view.php';
        break;
    case 'display_email_view':
        $url = $_POST['url'];
        $text = $_POST['text'];
        include 'email_view.php';
        break;
    case 'send_mail':
        // Get the data from the Mail View page
        $from = $_POST['from'];
        $to = $_POST['to'];
        $subject = $_POST['subject'];

        $text = $_POST['text'];
        $url = $_POST['url'];
        $message = $_POST['message'];

        // Create the body
        $body = $text . "\n\n" . $url . "\n\n" . $message;

        try {
            // Send the email
            send_email($to, $from, $subject, $body);

            // Display the Search view for the current query
            $videos = search_youtube($query);
            include 'search_view.php';
        } catch (Exception $e) {
            $error = $e->getMessage();
            include 'email_view.php';
        }
        break;
    default:
        include 'search_view.php';
        break;
}

?>