<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/30/18
 * Time: 1:32 AM
 */
require_once __DIR__."/../Debit_repository.php";
class Debit_repositoryImpl implements Debit_repository
{

    private $connection;
    /*public function __construct()
    {
        $this->connection = new mysqli("aa","hhdh","dvgd","gdgd","hfhf");
    }*/

    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function saveDebit($purchaseid, $debitdate, $supplierid, $amount)
    {
        $pstm = $this->connection->prepare("insert into debit (purchaseid,debitdate,supplierid,amount) values (?,?,?,?)");
        $pstm->bind_param("isid",$param1,$param2,$param3,$param4);
        $param1 = $purchaseid;
        $param2 = $debitdate;
        $param3 = $supplierid;
        $param4 = $amount;
        $result = $pstm->execute();
        if($result){
            return $pstm->insert_id;
        }else{
            return -1;
        }
    }

    public function deleteDebit($debitid)
    {
        $result = $this->connection->query("delete from debit where debitid = $debitid");
        if($result){
            return $this->connection->affected_rows;
        }else{
            return -1;
        }
    }

    public function getDebit($debitid)
    {
        $resultSet = $this->connection->query("select * from debit where debitid = $debitid");
        return $resultSet->fetch_assoc();
    }

    public function getDebitByPurchase($purchaseid)
    {
        $resultSet = $this->connection->query("select * from debit where purchaseid= $purchaseid");
        return $resultSet->fetch_assoc();
    }

    public function updateDebit($debitid,$purchaseid,$debitdate,$supplierid,$amount)
    {
        $result = $this->connection->query("update debit set purchaseid = $purchaseid, debitdate = '{$debitdate}', supplierid = $supplierid , amount = $amount where debitid =$debitid");
        if($result){
            return $this->connection->affected_rows;
        }else{
            return -1;
        }
    }

    public function getDebitBySup($supid)
    {
        $resultSet = $this->connection->query("select * from debit where supplierid= $supid");
        return $resultSet->fetch_all(MYSQLI_ASSOC);
    }
}