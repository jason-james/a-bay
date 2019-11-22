<?php

// Start session for persistent user permissions
session_start();

// Assign file paths to PHP constants
// __FILE__ returns the current path to this file
// dirname() returns the path to the parent directory
define("PRIVATE_PATH", dirname(__FILE__));
define("PROJECT_PATH", dirname(PRIVATE_PATH));
define("PUBLIC_PATH", PROJECT_PATH . '/public');
define("SHARED_PATH", PRIVATE_PATH . '/shared');

// Assign the root URL to a PHP constant
// Dynamically finds everything in URL up to "/public"
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/public') + 7;
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
define("WWW_ROOT", $doc_root);

// Makes it so every page on website automatically connects to the database, and we can
// interact with the database via $db variable
require_once('database.php');

// Let our functions be accessible by whole app
require_once ('misc_functions.php');
require_once ('deji_query_functions.php');

$db = db_connect();  // so when any page loads initialize.php, it loads up these functions and initiates the first function
?>