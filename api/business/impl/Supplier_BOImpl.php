<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/24/18
 * Time: 8:15 AM
 */

require_once __DIR__ . "/../Supplier_BO.php";
require_once __DIR__."/../../repository/impl/Supplier_repositoryImpl.php";
require_once __DIR__."/../../db/DBConnection.php";
class Supplier_BOImpl implements Supplier_BO
{
    private $supplierRepository;

    public function __construct()
    {
        $this->supplierRepository = new Supplier_repositoryImpl();
    }

    public function getAllSuppliers()
    {
        $connection = (new DBConnection())->getConnection();
        $this->supplierRepository->setConnection($connection);

        $result = $this->supplierRepository->getAll();
        mysqli_close($connection);
        return $result;
    }

    public function saveSupplier($supid, $supname, $address, $contact, $routeid)
    {
        $connection = (new DBConnection())->getConnection();
        $this->supplierRepository->setConnection($connection);

        $result = $this->supplierRepository->saveSupplier($supid,$supname,$address,$contact,$routeid);
        mysqli_close($connection);
        return $result;
    }

    public function deleteSupplier($id)
    {
        $connection = (new DBConnection())->getConnection();
        $this->supplierRepository->setConnection($connection);

        $result = $this->supplierRepository->deleteSupplier($id);
        mysqli_close($connection);
        return $result;
    }

    public function getSupplier($id)
    {
        $connection = (new DBConnection())->getConnection();
        $this->supplierRepository->setConnection($connection);

        $result = $this->supplierRepository->getSupplier($id);
        mysqli_close($connection);
        return $result;
    }
}