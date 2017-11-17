<?php
//This will start buffering the output, so that nothing is really output until the PHP script ends
ob_start();

// This initializes a session.
session_start();

$servername = "localhost";
$username = "laravel_user";
$password = "laravel_user_password";
$database = "happiness";

try {
    $db = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// set the PDO error mode to exception
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

?>

