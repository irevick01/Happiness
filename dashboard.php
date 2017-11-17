<?php
/**
 * Created by PhpStorm.
 * User: Victor O. Irechukwu
 * Date: 11/13/2017
 * Time: 11:37 PM
 */
?>

<!DOCTYPE html>
<html>
<title>Dashboard | Happiness</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<body>

<div style="padding: 0 2% 1% 2%">

    <div align="right">
        <a href="login.php">Log Out</a>
    </div>

    <div class="w3-container w3-animate-zoom" align="center">
        <img src="images/happiness.jpg" style="width: 80px; height: 80px">
        <h2>Welcome, <?php echo $row['first_name'] ?>!</h2>
        <p>Click on each customer's tab to view conversation..</p>
    </div>

    <div class="w3-bar w3-black">
        <?php foreach($customers as $index => $customer): ?>
            <button class="w3-bar-item w3-button" onclick="openCity('<?php echo $customer['id']; ?>')"><?php echo $customer['first_name']; ?></button>
        <?php endforeach; ?>
    </div>


    <?php foreach($customers as $index => $customer): ?>
        <div id="<?php echo $customer['id']; ?>" class="w3-container customer w3-animate-bottom">
            <h4>Customer Name: <span style="color:white; background-color: #da3c6d; border-radius: 3px; padding: 0 3px 0 3px;"><?php echo $customer['first_name'].' '.$customer['last_name'] ?></span></h4>
            <p>CONVERSATION HISTORY</p>
            <hr>


            <?php foreach(json_decode($customer['conversation']) as  $chat): ?>

                <?php if($chat->party == 'bot'): ?>
                    <p align="left">Happiness: <span style="color:#da3c6d;"><?php echo time_diff($chat->time); ?></span></p>
                    <div style=" display: inline-block; background-color: #474747; color: white; margin-right: 20%; padding: 10px; border-radius: 5px;">
                        <?php echo $chat->chat; ?>
                    </div>
                <?php endif ?>

                <?php if($chat->party != 'bot'): ?>
                    <div align="right">
                        <p>Customer: <span style="color:#da3c6d;"><?php echo time_diff($chat->time); ?></span></p>
                        <div align="left" style=" display:inline-block; margin-left:20%; background-color: #4cac4e; color: white; padding: 10px; border-radius: 5px;">
                            <?php echo $chat->chat; ?>
                        </div>
                    </div>
                <?php endif ?>

            <?php endforeach ?>
        </div>
    <?php endforeach; ?>

</div>

<br><br>

<script>
    function openCity(cityName) {
        var i;
        var x = document.getElementsByClassName("customer");
        for (i = 0; i < x.length; i++) {
            x[i].style.display = "none";
        }
        document.getElementById(cityName).style.display = "block";
    }
</script>

</body>
</html>


<?php
//use lagos as default time zone for this script
date_default_timezone_set("Africa/Lagos");

//method for getting time difference
 function time_diff($time){
    $time_diff = '';

    $start  = date_create($time);
    $end 	= date_create(); // Current time and date
    $diff  	= date_diff( $start, $end );

    if($diff->y > 0){
        if($diff->y == 1){
            $time_diff = $diff->y.' year ago';
        }
        else{
            $time_diff = $diff->y.' years ago';
        }
    }
    else if($diff->m > 0){
        if($diff->m == 1){
            $time_diff = $diff->m.' month ago';
        }
        else{
            $time_diff = $diff->m.' months ago';
        }
    }
    else if($diff->d > 0){
        if($diff->d == 1){
            $time_diff = $diff->d.' day ago';
        }
        else{
            $time_diff = $diff->d.' days ago';
        }
    }
    else if($diff->h > 0){
        if($diff->h == 1){
            $time_diff = $diff->h.' hour ago';
        }
        else{
            $time_diff = $diff->h.' hours ago';
        }
    }
    else if($diff->i > 0){
        if($diff->i == 1){
            $time_diff = $diff->i.' min ago';
        }
        else{
            $time_diff = $diff->i.' mins ago';
        }
    }
    else if($diff->s > 0){
        if($diff->s == 1){
            $time_diff = $diff->s.' sec ago';
        }
        else{
            $time_diff = $diff->s.' secs ago';
        }
    }
    return $time_diff;
}

?>