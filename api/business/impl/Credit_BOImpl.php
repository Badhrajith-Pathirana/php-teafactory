<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/31/18
 * Time: 11:15 PM
 */
require_once __DIR__ . "/../Credit_BO.php";
require_once __DIR__."/../../repository/impl/Credit_repositoryImpl.php";
require_once __DIR__."/../../db/DBConnection.php";
require_once __DIR__ . "/Supplier_BOImpl.php";
require_once __DIR__."/../../repository/impl/Credit_type_repositoryImpl.php";
class Credit_BOImpl implements Credit_BO
{
    private $credit_Repository;
    private $creditType_repository;
    private $supplierServices;
    public function __construct()
    {
        $this->credit_Repository = new Credit_repositoryImpl();
        $this->creditType_repository = new Credit_type_repositoryImpl();
        $this->supplierServices = new Supplier_BOImpl();
    }

    public function getCreditsToday()
    {
        $newRes=null;
        $connection = (new DBConnection())->getConnection();
        $this->credit_Repository->setConnection($connection);
        $this->creditType_repository->setConnection($connection);

        $results = $this->credit_Repository->getAll();
        $i = 0;
        foreach ($results as $result){
            $supplier = $this->supplierServices->getSupplier($result["supplierid"]);
            $name = $supplier["name"];
            $creditType = $this->creditType_repository->getCreditTypeById(((int)$result["credit_type"]));
            $ctypeName = $creditType["type_name"];
            $newRes[$i]["creditid"] = $result["creditid"];
            $newRes[$i]["supid"] = $result["supplierid"];
            $newRes[$i]["supname"] = $name;
            $newRes[$i]["ctype"] = $ctypeName;
            $newRes[$i]["amount"] = $result["amount"];
            $i++;
        }
        return $newRes;
    }

    public function deleteCredit($creditid){
        $connection = (new DBConnection())->getConnection();
        $this->credit_Repository->setConnection($connection);

        $result = $this->credit_Repository->deleteCredit($creditid);
        mysqli_close($connection);
        return $result;
    }

    public function saveCredit($supid, $creditType, $amount)
    {
        $connection = (new DBConnection())->getConnection();
        $this->credit_Repository->setConnection($connection);
        $this->creditType_repository->setConnection($connection);

        $t = time();
        $date = date("Y-m-d",$t);
        $typeid = ($this->creditType_repository->getCreditTypeByname($creditType))["typeid"];
        $result = $this->credit_Repository->saveCredit($supid,$typeid,$date,$amount);
        if($result>0){
            return true;
        }else{
            return false;
        }
    }

    public function getCreditTypes()
    {
        $connection = (new DBConnection())->getConnection();
        $this->creditType_repository->setConnection($connection);

        $result = $this->creditType_repository->getCreditTypes();
        mysqli_close($connection);
        return $result;
    }
}