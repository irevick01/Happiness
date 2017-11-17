<?php
/**
 * Created by PhpStorm.
 * User: Victor O. Irechukwu
 * Date: 11/13/2017
 * Time: 11:37 PM
 */


require("api/config.inc.php");

//check if admin is already logged in else redirect to login page
if(!isset($_SESSION['admin'])){
    header('Location: login.php');
}

//if admin is logged in
else if(isset($_SESSION['admin'])){
    //get user's info from database
    $query = "SELECT * FROM admin WHERE id = :id AND password = :password";
    $query_params = array(
        ':id' => $_SESSION['admin']['id'],
        ':password' => $_SESSION['admin']['key']);
    try {
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
    }
    catch (PDOException $ex) {
        $response["success"] = 0;
        $response["message"] = "DB Error";
        //kill page
        die(json_encode($response));
    }
    //fetching row of the query
    $row = $stmt->fetch();
    if ($row) {

        //get conversation details
        $query = "SELECT * FROM customers";
        $stmt   = $db->prepare($query);
        $stmt->execute();
        $customers = $stmt->fetchAll();

        //show dashboard here
        require("dashboard.php");
    }
    else{
        /*false credentials: redirect to login page */
        header('Location: login.php');
    }
}
//if no parameters are sent redirect to login page
else{
    header('Location: login.php');
}