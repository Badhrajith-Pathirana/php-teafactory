<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/23/18
 * Time: 9:50 PM
 */
require_once __DIR__."/../Supplier_repository.php";

class Supplier_repositoryImpl implements Supplier_repository
{
    private $connection;


    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function getSupplier($id)
    {
        $resultset = $this->connection->query("select * from supplier where supplierno=$id");
        return $resultset->fetch_assoc();

    }

    public function saveSupplier($id, $name, $address, $contactno, $routeid)
    {
        $pstm = $this->connection->prepare("insert into supplier (name,route,phone,address) values(?,?,?,?)");
        $pstm->bind_param("siss",$param1,$param2,$param3,$param4);
        $param1 = $name;
        $param2 = $routeid;
        $param3 = $contactno;
        $param4 = $address;
        $result = $pstm->execute();
        if($result){
            return $pstm->affected_rows;
        }else{
            return -1;
        }
    }

    public function updateSupplier($id, $name, $address, $contactno, $routeid)
    {
        $pstm = $this->connection->prepare("update supplier set name = ? , address = ? , route = ?, phone = ? where supplierno = ?");
        $pstm->bind_param("ssisi",$param1,$param2,$param3,$param4,$param5);
        $param1 = $name;
        $param2 = $address;
        $param3 = $routeid;
        $param4 = $contactno;
        $param5 = $id;
        $result = $pstm->execute();
        if($result){
            return $pstm->affected_rows;
        }else{
            return -1;
        }
    }

    public function deleteSupplier($id)
    {
        $result = $this->connection->query("delete from supplier where supplierno = $id");
        if($result){
            return $this->connection->affected_rows;
        }else{
            return -1;
        }
    }

    public function getAll()
    {
        $resultset = $this->connection->query("select * from supplier");
        $results = $resultset->fetch_all(MYSQLI_ASSOC);
        return $results;
    }
}