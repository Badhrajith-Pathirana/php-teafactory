<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/27/18
 * Time: 8:35 PM
 */
require_once __DIR__ . "/../TeaCollection_BO.php";
require_once __DIR__."/../../repository/impl/Purchase_repositoryImpl.php";
require_once __DIR__."/../../db/DBConnection.php";
require_once __DIR__ . "/Supplier_BOImpl.php";
require_once __DIR__."/../../repository/impl/Rates_repositoryImpl.php";
require_once __DIR__."/../../repository/impl/Debit_repositoryImpl.php";
class TeaCollection_BOImpl implements TeaCollection_BO
{
    private $purchaseRepository;
    private $supplier_Services;
    private $rates_repository;
    private $debit_repository;
    public function __construct()
    {
        $this->purchaseRepository = new Purchase_repositoryImpl();
        $this->supplier_Services = new Supplier_BOImpl();
        $this->rates_repository = new Rates_repositoryImpl();
        $this->debit_repository = new Debit_repositoryImpl();
    }

    public function getToday()
    {
        $res = null;
        $i = 0;
        $connection = (new DBConnection())->getConnection();
        $this->purchaseRepository->setConnection($connection);

        $results = $this->purchaseRepository->getToday();
        foreach($results as $result){
            $supplier = $this->supplier_Services->getSupplier($result["supplierid"]);
            $res[$i]["purchase_id"] = $result["purchase_id"];
            $res[$i]["purchase_date"] = $result["purchase_date"];
            $res[$i]["supplierid"] = $result["supplierid"];
            $res[$i]["akg"] = $result["akg"];
            $res[$i]["bkg"] = $result["bkg"];
            $res[$i]["suppliername"] = $supplier["name"];
            $i++;

        }
        return $res;
    }


    public function saveTeaCollection($supid, $akg, $bkg)
    {
        $connection = (new DBConnection())->getConnection();
        $connection->autocommit(false);

        $this->purchaseRepository->setConnection($connection);
        $t = time();
        $date = date("Y-m-d",$t);
        $purchaseid = $this->purchaseRepository->saveTeaCollection($date,$supid,$akg,$bkg);
        if($purchaseid <= 0){
            $connection->rollback();
            $connection->autocommit(true);
            mysqli_close($connection);
            return false;
        }

        $this->rates_repository->setConnection($connection);
        $rates = $this->rates_repository->getRate($date);
        if($rates === null){
            $connection->rollback();
            $connection->autocommit(true);
            mysqli_close($connection);
            return false;
        }
        $akgPer =(double) $rates["akgper"];
        $bkgPer =(double) $rates["bkgper"];
        $travelling =(double) $rates["travelling"];
        $amount = (double) (($akgPer*$akg)+($bkgPer*$bkg)-(($akg+$bkg)*$travelling));
        $this->debit_repository->setConnection($connection);
        $debitid = $this->debit_repository->saveDebit($purchaseid,$date,$supid,$amount);
        if($debitid <=0){
            $connection->rollback();
            $connection->autocommit(true);
            mysqli_close($connection);
            return false;
        }
        $connection->commit();
        $connection->autocommit(true);
        mysqli_close($connection);
        return true;


    }

    public function deleteCollection($purchaseid)
    {
        $connection = (new DBConnection())->getConnection();
        $connection->autocommit(false);

        $this->debit_repository->setConnection($connection);
        $debit = $this->debit_repository->getDebitByPurchase($purchaseid);
        $delDebit = $this->debit_repository->deleteDebit($debit["debitid"]);
        if($delDebit<=0){
            $connection->rollback();
            $connection->autocommit(true);
            mysqli_close($connection);
            return false;
        }

        $this->purchaseRepository->setConnection($connection);
        $delPurchase = $this->purchaseRepository->deleteTeaCollection($purchaseid);
        if($delPurchase<=0){
            $connection->rollback();
            $connection->autocommit(true);
            mysqli_close($connection);
            return false;
        }
        $connection->commit();
        $connection->autocommit(true);
        mysqli_close($connection);
        return true;
    }
}