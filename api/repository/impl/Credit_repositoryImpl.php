<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/31/18
 * Time: 9:06 PM
 */
require_once __DIR__."/../Credit_repository.php";
class Credit_repositoryImpl implements Credit_repository
{

    private $connection;
    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }
    /*public function __construct()
    {
        $this->connection = new mysqli("cdcd","cdscd","ccdc","scc","csc");
    }*/

    public function saveCredit($supid, $credit_type, $date, $amount)
    {
        $pstm = $this->connection->prepare("insert into credit(supplierid,credit_type,date,amount) values (?,?,?,?)");
        $pstm->bind_param("iisd",$param1,$param2,$param3,$param4);
        $param1 = (int) $supid;
        $param2 = (int) $credit_type;
        $param3 = $date;
        $param4 = (double) $amount;
        $result=$pstm->execute();
        if($result){
            return $pstm->insert_id;
        }else{
            return -1;
        }
    }

    public function updateCredit($creditid, $supid, $credit_type, $date, $amount)
    {
        $pstm = $this->connection->prepare("update credit set supplierid = ?, credit_type = ?, date = ?, amount = ? where debitid= ?");
        $pstm->bind_param("iisdi",$param1,$param2,$param3,$param4,$param5);
        $param1 = (int) $supid;
        $param2 = (int) $credit_type;
        $param3 = $date;
        $param4 = (double) $amount;
        $param5 = (int) $creditid;
        $result = $pstm->execute();
        if($result){
            return $pstm->affected_rows;
        }else{
            return -1;
        }
    }

    public function getAll()
    {
        $resultSet = $this->connection->query("select * from credit where date = curdate()");
        return $resultSet->fetch_all(MYSQLI_ASSOC);
    }

    public function getCredit($creditid)
    {
        $result = $this->connection->query("select * from credit where creditid = $creditid");
        return $result->fetch_assoc();
    }

    public function deleteCredit($creditid)
    {
        $result = $this->connection->query("delete from credit where creditid = $creditid");
        return $result;
    }
}