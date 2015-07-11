<?php
$url = "/messages";

//function doesSenderExists($senderID){
////    switch(gettype($senderID)){
////        case "integer":
//            $query = "SELECT * FROM accounts WHERE accountID=$senderID";
//            $ret = mysqli_query($link, $query);
//            $num_rows = mysqli_num_rows($ret);
//
//            if($num_rows <= 0)
//                return false;
//
//            return true;
////        break;
////        
////        case "string":
////            Response::BadRequest("Sender is invalid.");
////        break;
////    }
//}
//
//function doesReceiverExists($receiverID){
//    $query = "SELECT * FROM accounts WHERE accountID=$receiverID";
//    $ret = mysqli_query($link, $query);
//    $num_rows = mysqli_num_rows($ret);
//    
//    if($num_rows <= 0)
//        return false;
//        
//    return true;
//}

function doesAccountExists($accountID){
    $query = "SELECT * FROM accounts WHERE accountID=$accountID";
    $ret = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($ret);
    
    if($num_rows <= 0)
        return false;
    
    return true;
}

$app->post($url, function() use($link){
    if(doesAccountExists($_POST["senderID"]))
    if(doesAccountExists($_POST["receiverID"])){
        $query = "INSERT INTO messages(`senderID`, `receiverID`, `message`, `dateTime`) VALUES({$_POST["senderID"]}, {$_POST["receiverID"]}, '{$_POST["message"]}', NOW())";
        $ret = mysqli_query($link, $query);

        if($ret){
            echo $query;
        }
    }else{
        Response::NotFound("Receiver does not exists.");
    }
});
?>