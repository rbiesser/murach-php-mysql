<?php

// debug
error_reporting(E_ALL);

session_start();

require dirname(__DIR__) . '/config/database.php';

require dirname(__DIR__) . '/app/Controller/AppController.php';