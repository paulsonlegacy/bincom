<?php

/* 

- This file serves as a Vanilla PHP Router
- The .HTACCESS file redirect all URLs here
- This file then calls the appropriate PHP file

NB - This .htaccess is specifically for Apache servers

*/

// Importing all neccessary files
require("./app/init.php");

// Getting the full url
$url = $_GET['url'] ?? '';
// Converting url string to lowercase
$url = strtolower($url);
// Exploding the url into an array using /
$url = explode("/", $url);
// Viewing the the $url array
//print_r($url);

// Generating the path to the file
if (count($url) == 1) {
    // The first item determines the page while second path is the sub path

    $page_name = trim($url[0]);

    if ($url[0] == '') {
        $file_name = APP_PATH . "controllers/lga-total-result.php";
    } else {
        $file_name = APP_PATH . "controllers/$page_name.php";
    }
} else {
    $file_name = APP_PATH . "controllers/404.php";
}

// Checking if page file exists
if (file_exists($file_name)) {
    require($file_name);
} else {
    require_once(APP_PATH . "controllers/404.php");
}