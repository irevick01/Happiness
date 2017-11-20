<?php
/**
 * Created by PhpStorm.
 * User: Victor O. Irechukwu
 * Date: 11/13/2017
 * Time: 11:55 PM
 */

//load and connect to MySQL database
require("../config.inc.php");

//set content type to json
header('Content-Type: application/json');

//get constants
require('constants.php');

if (!empty($_POST)) {

    //authenticate token
    if($_POST['token'] == BOT_TOKEN){

        if(isset($_POST['user_input']) && $_POST['user_input']=='start'){

            //check if user already exists
            $query = "SELECT id, conversation FROM customers WHERE chatfuel_user_id = :chatfuel_user_id";
            $query_params = array( ':chatfuel_user_id' => $_POST['chatfuel_user_id']);
            try {
                $stmt   = $db->prepare($query);
                $result = $stmt->execute($query_params);
            }
            catch (PDOException $ex) {
                $response["success"] = 0;
                $response["message"] = "DB Error1";
                die(json_encode($response));
            }
            $row = $stmt->fetch();
            if ($row) {
                //update conversation if existing
                $conversation = json_decode($row['conversation'], true); //convert to array

                //prepare chat
                $chat['party'] = 'bot';
                $chat['chat'] = "Hello ".$_POST['first_name'].",\n\nIt's nice to have you here. My name is Happiness.\n\nThe day looks pretty amazing! Would you like to know what the day is?";
                $chat['time'] = date("F j, Y, g:i a");
                array_push($conversation, $chat);

                //update conversation in database
                $query  = "UPDATE customers SET conversation = :conversation, updated_at = :updated_at WHERE id = :id";
                $query_params = array(
                    ':id' => $row['id'],
                    ':conversation' => json_encode($conversation),
                    ':updated_at' => date("F j, Y, g:i a"));
                try {
                    $stmt   = $db->prepare($query);
                    $result = $stmt->execute($query_params);
                }
                catch (PDOException $ex) {
                    $response["success"] = 0;
                    $response["message"] = "DB Error2";
                    die(json_encode($response));
                }

                //send response here
                $messages = array();
                $message["text"] = $chat['chat'];

                $quick_replies = array();
                $reply['title'] = 'Yes please';
                $reply['type'] = 'json_plugin_url';
                $reply['url'] = DATE_URL.'?user_reply=yes&chatfuel_user_id='.$_POST['chatfuel_user_id'].'&first_name='.$_POST['first_name'].'&token='.BOT_TOKEN;
                array_push($quick_replies, $reply);

                $reply['title'] = 'No, thanks';
                $reply['type'] = 'json_plugin_url';
                $reply['url'] = DATE_URL.'?user_reply=no&chatfuel_user_id='.$_POST['chatfuel_user_id'].'&first_name='.$_POST['first_name'].'&token='.BOT_TOKEN;
                array_push($quick_replies, $reply);

                $message["quick_replies"] = $quick_replies;

                array_push($messages, $message);
                $response["messages"] = $messages;

                die(json_encode($response));

            }
            else{
                //else add new user to the database and add conversation
                $chatfuel_user_id = $_POST['chatfuel_user_id'];
                $first_name = $_POST['first_name'];
                $last_name = $_POST['last_name'];

                $conversation = array(); //conversations are stored in array to be converted to json
                //prepare chat
                $chat['party'] = 'bot';
                $chat['chat'] = "Hello ".$_POST['first_name'].",\n\nIt's nice to have you here. My name is Happiness.\n\nThe day looks pretty amazing! Would you like to know what the day is?";
                $chat['time'] = date("F j, Y, g:i a");
                array_push($conversation, $chat);

                $query = "INSERT INTO customers ( chatfuel_user_id, first_name, last_name, conversation, created_at )
			              VALUES (:chatfuel_user_id, :first_name, :last_name, :conversation, :created_at ) ";

                //Update tokens with the actual data:
                $query_params = array(
                    ':chatfuel_user_id' => $chatfuel_user_id,
                    ':first_name' => $first_name,
                    ':last_name' => $last_name,
                    ':conversation' => json_encode($conversation),
                    ':created_at' => date("F j, Y, g:i a") );

                //Run query, and create the user
                try {
                    $stmt   = $db->prepare($query);
                    $result = $stmt->execute($query_params);
                }

                catch (PDOException $ex) {
                    $response["success"] = 0;
                    $response["message"] = "Database Error2";
                    die(json_encode($response));
                }

                //send response here
                $messages = array();
                $message["text"] = $chat['chat'];

                $quick_replies = array();
                $reply['title'] = 'Yes please';
                $reply['type'] = 'json_plugin_url';
                $reply['url'] = DATE_URL.'?user_reply=yes&chatfuel_user_id='.$_POST['chatfuel_user_id'].'&first_name='.$_POST['first_name'].'&token='.BOT_TOKEN;
                array_push($quick_replies, $reply);

                $reply['title'] = 'No, thanks';
                $reply['type'] = 'json_plugin_url';
                $reply['url'] = DATE_URL.'?user_reply=no&chatfuel_user_id='.$_POST['chatfuel_user_id'].'&first_name='.$_POST['first_name'].'&token='.BOT_TOKEN;
                array_push($quick_replies, $reply);

                $message["quick_replies"] = $quick_replies;

                array_push($messages, $message);
                $response["messages"] = $messages;

                die(json_encode($response));

            }


        }



    }
    else{
        $messages = array();
        $message["text"] = "Unauthorized access";
        array_push($messages, $message);
        $response["messages"] = $messages;
        die(json_encode($response));
    }

}

else {
    $messages = array();
    $message["text"] = "No details supplied";
    array_push($messages, $message);
    $response["messages"] = $messages;
    die(json_encode($response));
}



?>


