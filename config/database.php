<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'edd');
define('DB_PASSWORD', 'Fd6I@yTno@Kn(Bcx');
define('DB_NAME', 'php_dev');


// Create connection
$conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check connection
if ($conn -> connect_error) {
    die('Connection failed ' . $conn->connect_error);
};

$message = "SUCCESSFULLY CONNECTED TO THE DATABASE ✨";
echo "<script>console.log(" . json_encode($message) . ");</script>";
