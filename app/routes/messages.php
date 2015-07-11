<?php
$url = "/messages";

function doesAccountExists($accountID){
    echo intval($accountID);
    $query = "SELECT * FROM accounts WHERE accountID=$accountID";
    $ret = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($ret);
    
    if($num_rows <= 0)
        return false;
    
    return true;
}

$app->post($url, function() use($link){
    if(!doesAccountExists($_POST["senderID"]))
        Response::NotFound("Sender does not exists.");
    if(!doesAccountExists($_POST["receiverID"]))
        Response::NotFound("Receiver does not exists.");
    
    $query = "INSERT INTO messages(`senderID`, `receiverID`, `message`, `dateTime`) VALUES({$_POST["senderID"]}, {$_POST["receiverID"]}, '{$_POST["message"]}', NOW())";
    $ret = mysqli_query($link, $query);

    if($ret){
        Response::Created("Message was successfully created.");
    }
});

$app->get($url, function() use($link){
    $query = "SELECT * FROM messages";
    $ret = mysqli_query($link, $query);
    $results = array();
    
    if($ret){
        while($row = mysqli_fetch_assoc($ret)){
            $results[] = $row;
        }
        
        Response::Ok($results, JSON_PRETTY_PRINT);
    }
});

$app->get($url . "/:id", function($messageID) use($link){
    $query = "SELECT * FROM messages WHERE messageID=$messageID";
    $ret = mysqli_query($link, $query);
    $result = mysqli_fetch_assoc($ret);
    
    if(mysqli_num_rows($ret) <= 0)
        Response::NotFound("Message with ID $messageID does not exists.");
    
    $return = [
        "messageID"=>$result["messageID"],
        "senderID"=>$result["senderID"],
        "receiverID"=>$result["receiverID"],
        "message"=>$result["message"],
        "dateTime"=>$result["dateTime"]
    ];
    
    Response::Ok($return, JSON_PRETTY_PRINT);
});

$app->delete($url, function() use($link){
    $query = "DELETE FROM messages";
    $ret = mysqli_query($link, $query);
    
    if($ret){
        Response::Ok("Messages were successfully deleted.");
    }
});

$app->delete($url . "/:id", function($messageID) use($link){
    $query = "DELETE FROM messages WHERE messageID=$messageID";
    $ret = mysqli_query($link, $query);
    
    if(mysqli_num_rows($ret) <= 0)
        Response::NotFound("Message with ID $messageID does not exists.");
    
    Response::Ok("Message was successfully deleted.");
});
?>