<?php
// Get the document root
$doc_root = $_SERVER['DOCUMENT_ROOT'];

// Get the application path
$uri = $_SERVER['REQUEST_URI'];
$dirs = explode('/', $uri);

// fails if app is hosted from localhost without nested directories
// $app_path = '/' . $dirs[1] . '/' . $dirs[2] . '/';
$app_path = '/';

// Set the include path
set_include_path($doc_root . $app_path);
?>