<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/31/18
 * Time: 12:23 PM
 */
require_once __DIR__ . "/../Debit_BO.php";
require_once __DIR__."/../../db/DBConnection.php";
require_once __DIR__."/../../repository/impl/Debit_repositoryImpl.php";
class Debit_BOImpl implements Debit_BO
{

    private $debit_Repository;

    public function __construct()
    {
        $this->debit_Repository = new Debit_repositoryImpl();
    }

    public function getbySupplier($supid)
    {
        $connection = (new DBConnection())->getConnection();
        $this->debit_Repository->setConnection($connection);

        $result = $this->debit_Repository->getDebitBySup($supid);
        mysqli_close($connection);
        return $result;
    }
}