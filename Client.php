<?php
require_once "API.php";

if (isset($_GET["creatmember"]) && isset($_GET["username"]))
{
    $creat = new APItest();
    $creat->creatmember($_GET["username"]);

    if($apimodel != 0)
    {
        echo "add member successful";
    }
}

if (isset($_GET["userbalance"]) && isset($_GET["username"]))
{
    $getuser = new APItest();
    $userdata = $getuser->userbalance($_GET["username"]);

    // var_dump($userdata);
    if($userdata != 0)
    {
        echo "User: ".$userdata[0][1]."<br>";
        echo "Balance: ".$userdata[0][2];
    }
}

if (isset($_GET["transfer"]) && isset($_GET["username"]) && isset($_GET["type"])
    && isset($_GET["money"]) && isset($_GET["transferId"]))
{
    $moneyIO = new APItest();
    $moneyIO->transfer($_GET["username"], $_GET["type"], $_GET["transferId"], $_GET["money"]);

    if($moneyIO != 0)
    {
        echo "transfer successful";
    }
}

if (isset($_GET["checkrecord"]) && isset($_GET["username"]) && isset($_GET["transferId"]))
{
    $checkrecord = new APItest();
    $transferdata = $checkrecord->checkrecord($_GET["username"], $_GET["transferId"]);

    echo "User: ".$transferdata[0][1]."<br>";
    echo "transferId: ".$transferdata[0][2]."<br>";
    echo "money: ".$transferdata[0][3];
}






?>