<?php
require 'Slim/Slim.php';
require_once("app/lib/response.php");
require_once("dbconn.php");

\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();


Response::setApp($app);
// GET route
$app->get(
    '/',
    function () {
        echo json_encode(["message"=>"Urls should be here"]);
    }
);


//--------All-Routes-Here-----------
require_once("app/routes/messages.php");
require_once("app/routes/accounts.php");
//--------All-Routes-Here-----------



$app->run();
