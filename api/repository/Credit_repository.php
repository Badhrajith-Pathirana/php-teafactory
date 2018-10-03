<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/31/18
 * Time: 8:45 PM
 */

interface Credit_repository
{
    public function setConnection(mysqli $connection);
    public function saveCredit($supid,$credit_type,$date,$amount);
    public function updateCredit($creditid,$supid,$credit_type,$date,$amount);
    public function getAll();
    public function getCredit($creditid);
    public function deleteCredit($creditid);
}