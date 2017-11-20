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

if (!empty($_GET && $_GET['token'] == BOT_TOKEN)) {

    //get conversation details from database
    $query = "SELECT id, conversation FROM customers WHERE chatfuel_user_id = :chatfuel_user_id";
    $query_params = array( ':chatfuel_user_id' => $_GET['chatfuel_user_id']);
    $stmt   = $db->prepare($query);
    $result = $stmt->execute($query_params);
    $row = $stmt->fetch();

    //update conversation if existing
    $conversation = json_decode($row['conversation'], true); //convert to array

    if ($_GET['user_reply'] == 'yes') {

        //prepare chat - user reply
        $chat['party'] = 'user';
        $chat['chat'] = "Yes, please";
        $chat['time'] = date("F j, Y, g:i a");
        array_push($conversation, $chat);

        //prepare chat - bot reply
        $chat['party'] = 'bot';
        $chat['chat'] = "Aww.. It's awesome to see you want to know more about today.\n\nToday's date is ".date("F j, Y").".\n\nWould you also like to know the Governors of the states in Nigeria?";
        $chat['time'] = date("F j, Y, g:i a");
        array_push($conversation, $chat);

        //update conversation in database
        $query  = "UPDATE customers SET conversation = :conversation, updated_at = :updated_at WHERE id = :id";
        $query_params = array(
            ':id' => $row['id'],
            ':conversation' => json_encode($conversation),
            ':updated_at' => date("F j, Y, g:i a"));
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);

        //send response here
        $messages = array();
        $message["text"] = $chat['chat'];

        $quick_replies = array();
        $reply['title'] = "I'd love to know";
        $reply['type'] = 'show_block';
        $block_names = array();
        array_push($block_names, 'yes_governor');
        $reply['block_names'] = $block_names;
        array_push($quick_replies, $reply);

        $reply['title'] = 'No, thanks';
        $reply['type'] = 'json_plugin_url';
        $reply['url'] = GOVERNOR_URL.'?user_reply=no&chatfuel_user_id='.$_GET['chatfuel_user_id'].'&first_name='.$_GET['first_name'].'&token='.BOT_TOKEN;
        array_push($quick_replies, $reply);

        $message["quick_replies"] = $quick_replies;

        array_push($messages, $message);
        $response["messages"] = $messages;

        die(json_encode($response));

    }

    else if ($_GET['user_reply'] == 'no') {

        //prepare chat - user reply
        $chat['party'] = 'user';
        $chat['chat'] = "No, thanks";
        $chat['time'] = date("F j, Y, g:i a");
        array_push($conversation, $chat);

        //prepare chat - bot reply
        $chat['party'] = 'bot';
        $chat['chat'] = "Aww.. that's okay.\n\nWould you like to know the Governors of the states in Nigeria?";
        $chat['time'] = date("F j, Y, g:i a");
        array_push($conversation, $chat);

        //update conversation in database
        $query  = "UPDATE customers SET conversation = :conversation, updated_at = :updated_at WHERE id = :id";
        $query_params = array(
            ':id' => $row['id'],
            ':conversation' => json_encode($conversation),
            ':updated_at' => date("F j, Y, g:i a"));
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);

        //send response here
        $messages = array();
        $message["text"] = $chat['chat'];

        $quick_replies = array();
        $reply['title'] = "I'd love to know";
        $reply['type'] = 'show_block';
        $block_names = array();
        array_push($block_names, 'yes_governor');
        $reply['block_names'] = $block_names;
        array_push($quick_replies, $reply);

        $reply['title'] = 'No, maybe later';
        $reply['type'] = 'json_plugin_url';
        $reply['url'] = GOVERNOR_URL.'?user_reply=no&chatfuel_user_id='.$_GET['chatfuel_user_id'].'&first_name='.$_GET['first_name'].'&token='.BOT_TOKEN;
        array_push($quick_replies, $reply);

        $message["quick_replies"] = $quick_replies;

        array_push($messages, $message);
        $response["messages"] = $messages;

        die(json_encode($response));

    }

}

else {
    $messages = array();
    $message["text"] = "Unauthorized access or no details supplied";
    array_push($messages, $message);
    $response["messages"] = $messages;
    die(json_encode($response));
}

?>
