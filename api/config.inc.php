
<?php

    // These variables define the connection information for your MySQL database
    $username = "laravel_user";
    $password = "laravel_user_password";
    $host = "localhost";
    $dbname = "happiness";


    // UTF-8 is a character encoding scheme that allows you to conveniently store
    // a wide variety of special characters, like ¢ or €, in your database.
    $options = array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4');

    // This statement opens a connection to your database using the PDO library
    try{
        $db = new PDO("mysql:unix_socket={$host};dbname={$dbname};charset=utf8mb4", $username, $password, $options);
    }
    catch(PDOException $ex){
        //end script if failed to connect with the database
        die("Failed to connect to the database.");
    }

    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // This tells the web browser that your content is encoded using UTF-8 and that it should submit content back to you using UTF-8
    header('Content-Type: text/html; charset=utf8mb4');

    // This initializes a session.
    session_start();

?>
