<?php
    $url = "/accounts";

$app->get($url, function() use($link){
    $query = "SELECT * FROM accounts";
    $ret = mysqli_query($link, $query);
    $results = array();
    
    if($ret){
        while($row = mysqli_fetch_assoc($ret)){
            $results[] = $row;
        }
        
        Response::Ok($results, JSON_PRETTY_PRINT);
    }
});

$app->get($url . "/:accountID", function($accountID) use($link){
    $query = "SELECT * FROM accounts WHERE accountID=$accountID";
    $ret = mysqli_query($link, $query);
    
    if($ret){
        $result = mysqli_fetch_assoc($ret);
        $num_rows = mysqli_num_rows($ret);

        if($num_rows > 0){
            $return = [
                "id"=>$result["accountID"],
                "firstName"=>$result["firstName"],
                "lastName"=>$result["lastName"]
            ];

            Response::Ok($return);

        }else{
            Response::NotFound("Account with ID $accountID does not exists.");
        }
    }
    
});

$app->post($url, function() use($link, $url){
    $query = "INSERT INTO accounts(`firstName`, `lastName`) VALUES('{$_POST["firstName"]}', '{$_POST["lastName"]}')";
    $ret = mysqli_query($link, $query);
    
    if($ret){
        $id = mysqli_insert_id($link);
    }
    
    Response::Created($url . "/$id");
});

$app->delete($url, function() use($link){
    $query = "DELETE FROM accounts";
    $ret = mysqli_query($link, $query);
    
    if($ret){
        Response::Ok("Accounts are all successfully deleted.");
    }
});

$app->delete($url . "/:accountID", function($accountID) use($link){
    $query = "DELETE FROM accounts WHERE accountID=$accountID";
    $ret = mysqli_query($link, $query);
    
    if($ret){
        Response::Ok("Account with ID $accountID was successfully deleted.");
    }
});

$app->put($url, function(){
    Response::NotFound("Can't update all accounts simultaneously.");
});

$app->put($url . "/:id", function($accountID) use($link){
    $query = "UPDATE accounts SET firstName='{$_POST["firstName"]}', lastName='{$_POST["lastName"]}' WHERE accountID=$accountID";
    $ret = mysqli_query($link, $query);
    $num_rows = mysqli_num_rows($ret);
    
    if($num_rows <= 0){
        Response::NotFound("Account with ID $accountID does not exists.");
    }
    
    echo $app->request->put("account");
});
?>