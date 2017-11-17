<?php
/**
 * Created by PhpStorm.
 * User: Victor O. Irechukwu
 * Date: 11/13/2017
 * Time: 11:02 PM
 */

//if user logged out, destroy session
session_start();
session_destroy();

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Happy Login</title>

</head>
<body>

<div align="center" style="padding: 10%">
    <img src="images/happiness.jpg" style="width: 80px; height: 80px">
    <h1><b>Admin Happy Login!</b></h1>
    <form id="loginForm" method="post" action="api/admin/login.php">
        <input placeholder="Email" type="email" required="required" name="email" style="width: 25%; height: 20px">
        <br><br>
        <input placeholder="Password" type="password" required="required" name="password" style="width: 25%; height: 20px">
        <br><br>
        <input type="submit" value="Login">
    </form>
</div>


</body>
</html>









