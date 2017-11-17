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

        //get governor info from database
        $query = "SELECT governor FROM governors WHERE state = :state";
        $query_params = array( ':state' => $_GET['state'] );
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);
        $governor = $stmt->fetch();

        //prepare replay
        $bot_reply2 = "Thank you for stopping by at my platform. I hope to hear from you again.\n\nMake sure you choose to remain happy! Remember, whatever makes you mad, let it go. Whatever makes you smile, hang on to it.\n\nCheers!";
        if ($governor) {
            //if available
            $bot_reply1 = 'The Governor of '.$_GET['state'].' state is '.$governor['governor'];
        }
        else{
            $bot_reply1 ='Oops! '.$_GET['state'].' is not a state in Nigeria. Make sure you type the correct Nigerian State.';
        }

        //prepare chat - user reply
        $chat['party'] = 'user';
        $chat['chat'] = "I'd love to know";
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //prepare chat - bot reply
        $chat['party'] = 'bot';
        $chat['chat'] = "Oh, cool! Now I'm blushing..";
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //prepare chat - bot reply
        $chat['party'] = 'bot';
        $chat['chat'] = "Please enter any state in Nigeria and I'd gladly tell you who the Governor is:";
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //prepare chat - user reply
        $chat['party'] = 'user';
        $chat['chat'] = $_GET['state'];
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //prepare chat - bot reply
        $chat['party'] = 'bot';
        $chat['chat'] = $bot_reply1;
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //prepare chat - bot reply
        $chat['party'] = 'bot';
        $chat['chat'] = $bot_reply2;
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //update conversation in database
        $query  = "UPDATE customers SET conversation = :conversation, updated_at = :updated_at WHERE id = :id";
        $query_params = array(
            ':id' => $row['id'],
            ':conversation' => json_encode($conversation),
            ':updated_at' => date("F j, Y"));
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);

        //send response here
        $messages = array();
        $message["text"] = $bot_reply1;
        array_push($messages, $message);
        $message["text"] = $bot_reply2;
        array_push($messages, $message);
        $response["messages"] = $messages;
        die(json_encode($response));

    }

    else if ($_GET['user_reply'] == 'no') {

        //prepare replay
        $bot_reply = "Aww.. that's okay ".$_GET['first_name'].". I hope to hear from you again.\n\nMake sure you choose to remain happy! Remember, whatever makes you mad, let it go. Whatever makes you smile, hang on to it.\n\nCheers!";

        //prepare chat - user reply
        $chat['party'] = 'user';
        $chat['chat'] = "No, maybe later";
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //prepare chat - bot reply
        $chat['party'] = 'bot';
        $chat['chat'] = $bot_reply;
        $chat['time'] = date("F j, Y");
        array_push($conversation, $chat);

        //update conversation in database
        $query  = "UPDATE customers SET conversation = :conversation, updated_at = :updated_at WHERE id = :id";
        $query_params = array(
            ':id' => $row['id'],
            ':conversation' => json_encode($conversation),
            ':updated_at' => date("F j, Y"));
        $stmt   = $db->prepare($query);
        $result = $stmt->execute($query_params);

        //send response here
        $messages = array();
        $message["text"] = $bot_reply;
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


