<?php
require_once "API.php";

if (isset($_GET["creatmember"]) && isset($_GET["username"]))
{
    $creat = new APItest();

    $result = $creat->userbalance($_GET["username"]);
    if($result[0][1] != $_GET["username"])
    {
        $creat->creatmember($_GET["username"]);

        if($creat != 0)
        {
            echo "add member successful!";
        }
    }else{
        echo "member repeat";
    }
}

if (isset($_GET["userbalance"]) && isset($_GET["username"]))
{
    $getuser = new APItest();
    $userdata = $getuser->userbalance($_GET["username"]);

    if($userdata != 0)
    {
        echo "User: ".$userdata[0][1]."<br>";
        echo "Balance: ".$userdata[0][2];
    }
}

if (isset($_GET["transfer"]))
{
    if($_GET["username"] == NULL or $_GET["type"] == NULL or $_GET["money"] == NULL or $_GET["transferId"] == NULL)
    {
        echo "參數不足";
        exit;
    }
    else
    {
        $moneyIO = new APItest();
        $result = $moneyIO->checktransferId($_GET["transferId"]);

        if($result[0][2] != $_GET["transferId"])
        {
            $result = $moneyIO->transfer($_GET["username"], $_GET["type"], $_GET["transferId"], $_GET["money"]);

            if($result)
            {
                echo "transfer successful";
            }
        }else{
            echo "transferId repeat!";
        }
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