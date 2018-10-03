<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/30/18
 * Time: 1:14 AM
 */

interface Debit_repository
{
    public function setConnection(mysqli $connection);
    public function saveDebit($purchaseid,$debitdate,$supplierid,$amount);
    public function deleteDebit($debitid);
    public function getDebit($debitid);
    public function getDebitByPurchase($purchaseid);
    public function updateDebit($debitid,$purchaseid,$debitdate,$supplierid,$amount);
    public function getDebitBySup($supid);
}