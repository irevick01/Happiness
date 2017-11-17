<?php
/**
 * Created by PhpStorm.
 * User: Victor O. Irechukwu
 * Date: 11/13/2017
 * Time: 11:07 PM
 */

//load and connect to MySQL database
require("../config.inc.php");


if (!empty($_POST)) {

    //get admin's info from database
    $query = "SELECT * FROM admin WHERE email = :email AND password = :password";
    $query_params = array(
        ':email' => $_POST['email'],
        ':password' => hash("sha256", $_POST['password']));

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

    //if admin is registered return a success = 1
    $row = $stmt->fetch();
    if ($row) {
        //create admin array if not set
        if( !isset( $_SESSION['admin'] ) ){
            $_SESSION['admin'] = array();
        }
        //pass student details to session array
        $student['id'] = $row['id'];
        $student['first_name'] = $row['first_name'];
        $student['last_name'] = $row['last_name'];
        $student['email'] = $row['email'];
        $student['key'] = $row['password'];
        header('Location: ../../admin.php?id='.$row['id'].'&key='.$row['password']);
    }
    else{
        $response["success"] = 0;
        $response["message"] = "Invalid Login Details";
        //kill page
        die(json_encode($response));
    }
}

else {
    $response["success"] = 0;
    $response["message"] = "No login details supplied";
    die(json_encode($response));
}


?>


