<?php

// debug
error_reporting(E_ALL);

require dirname(__DIR__) . '/config/database.php';

$directories = array(
    '../app/Model/Table/',
    '../app/Model/Entity/'
);
foreach ($directories as $directory) {
    foreach(glob($directory . "*.php") as $class) {
        include_once $class;
    }
}

// var_dump(get_declared_classes());
