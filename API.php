<?php
require_once "MyPdo.php";

class APItest
{
    public $dbcon;
    public $dbpdo;

    public function __construct()
    {
        $this->dbpdo = new MyPdo();
        $this->dbcon = $this->dbpdo->getConnection();
    }

    function creatmember($username)
    {
        $sql = "INSERT INTO `Userdata` (`userName`, `balance`) VALUES (:userName, 100000)";
    	$stmt = $this->dbcon->prepare($sql);
    	$stmt->bindValue(':userName',$username);

    	$result = $stmt->execute();
    	$this->dbpdo->closeConnection();

    	return $result;
    }

    function userbalance($username)
    {
        $sql = "SELECT * FROM `Userdata` WHERE `userName` = :userName";
        $stmt = $this->dbcon->prepare($sql);
    	$stmt->bindValue(':userName',$username);

    	$stmt->execute();
        $result = $stmt->fetchAll();
        $this->dbpdo->closeConnection();

        return $result;
    }

    function transfer($username, $type, $transferId, $money)
    {

        if($type == "IN" or $type == "OUT")
        {
            if($type == "OUT")
            {
                $money = $money * -1;
            }
            $sql = "UPDATE `Userdata` SET `balance` = `balance` + :balance WHERE `userName` = :userName";
            $stmt = $this->dbcon->prepare($sql);
            $stmt->bindValue(':balance', $money);
            $stmt->bindValue(':userName', $username);
            $result = $stmt->execute();

            $sql = "INSERT INTO `Balance` (userName, `transferId`, `money`)
                VALUES (:userName, :transferId, :money)";
        	$stmt = $this->dbcon->prepare($sql);
        	$stmt->bindValue(':userName', $username);
        	$stmt->bindValue(':transferId', $transferId);
        	$stmt->bindValue(':money', $money);

        	$result = $stmt->execute();
        }
    }

    function checkrecord($username, $transferId)
    {
        $sql = "SELECT * FROM `Balance` WHERE `userName` = :userName and `transferId` = :transferId";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindValue(':userName', $username);
        $stmt->bindValue(':transferId', $transferId);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $this->dbpdo->closeConnection();

	    return $result;
    }

    function checktransferId($transferId)
    {
        $sql = "SELECT * FROM `Balance` WHERE `transferId` = :transferId";
        $stmt = $this->dbcon->prepare($sql);
        $stmt->bindValue(':transferId', $transferId);
        $stmt->execute();

        $result = $stmt->fetchAll();
        $this->dbpdo->closeConnection();

	    return $result;
    }
}

?>