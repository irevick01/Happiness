<?php

// This initializes a session.
session_start();

if(isset($_SESSION['admin'])){
    header('Location: admin.php');
}
else{
    header('Location: login.php');
}
?>