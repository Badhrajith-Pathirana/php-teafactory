<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/27/18
 * Time: 4:57 AM
 */
require_once __DIR__ . "/../Purchase_repository.php";
class Purchase_repositoryImpl implements Purchase_repository
{
    private $connection;
    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function getAll()
    {
        $resultSet = $this->connection->query("select * from purchase");
        $results = $resultSet->fetch_all(MYSQLI_ASSOC);
        return $results;
    }

    public function saveTeaCollection($purchaseDate, $supid, $akg, $bkg)
    {
        echo $supid;
        $result = $this->connection->query("insert into purchase(purchase_date,supplierid,akg,bkg) values ('$purchaseDate',$supid,$akg,$bkg)");
        if($result){
            $id = $this->connection->insert_id;
            return $id;
        }else{
            return -1;
        }

    }

    public function updateTeaCollection($purchaseid, $purchaseDate, $supid, $akg, $bkg)
    {
        $result = $this->connection->query("update purchase set purchase_date = '{$purchaseDate}', supplierid = $supid , akg = $akg , bkg = $bkg where purchase_id = $purchaseid");
        if($result){
            return $this->connection->affected_rows;
        }else{
            return -1;
        }
    }

    public function getTeaCollection($purchaseid)
    {
        $resultSet = $this->connection->query("select * from purchase where purchase_id = $purchaseid");
        return $resultSet->fetch_assoc();
    }

    public function deleteTeaCollection($purchaseid)
    {
        $result = $this->connection->query("delete from purchase where purchase_id = $purchaseid");
        if($result){
            return $this->connection->affected_rows;
        }else{
            return -1;
        }
    }

    public function getToday()
    {
        $t = time();
        $dte = date("Y-m-d",$t);
        $resultSet = $this->connection->query("select * from purchase where purchase_date = '{$dte}'");
        return $resultSet->fetch_all(MYSQLI_ASSOC);
    }


}