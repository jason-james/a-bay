<?php

require_once('db_credentials.php');

// Create a database connection
function db_connect() {
    $connection = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
    return $connection;
}

// If connection exists (is set), close it
function db_disconnect($connection) {
    if(isset($connection)) {
        mysqli_close($connection);
    }
}
// i suck dick
?>
