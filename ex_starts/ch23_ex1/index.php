<?php
// phpinfo();
require_once 'file_util.php';  // the get_file_list function
require_once 'image_util.php'; // the process_image function

$image_dir = 'images';
$image_dir_path = getcwd() . DIRECTORY_SEPARATOR . $image_dir;

$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = '';
    }
}

switch ($action) {
    case 'upload':        
        // echo '<pre>';
        // var_dump($_FILES);
        // echo '</pre>';
        foreach ($_FILES as $file){
            // there's no need to check isset
            // uncomment for use with multiple file input array
            // foreach ($file['name'] as $index => $filename) {

                $filename = $file['name'];
                // change logic to skip if $filename is empty
                if (!empty($filename)) {
                    $source = $file['tmp_name'];

                    // uncomment for use with multiple file input array
                    // $source = $file['tmp_name'][$index];
                    $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
                    move_uploaded_file($source, $target);
        
                    // create the '400' and '100' versions of the image
                    process_image($image_dir_path, $filename);
                }
            // }
        }
        // die();
        header("Location: .");

        break;
    case 'delete':
        $filename = filter_input(INPUT_GET, 'filename', 
                FILTER_SANITIZE_STRING);
        $target = $image_dir_path . DIRECTORY_SEPARATOR . $filename;
        if (file_exists($target)) {
            unlink($target);
        }
        header("Location: .");
        break;
}

$files = get_file_list($image_dir_path);
include('uploadform.php');
?>