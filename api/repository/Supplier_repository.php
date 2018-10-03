<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/23/18
 * Time: 9:43 PM
 */

interface Supplier_repository
{
    public function setConnection(mysqli $connection);
    public function getSupplier($id);
    public function saveSupplier($id,$name,$address,$contactno,$routeid);
    public function updateSupplier($id,$name,$address,$contactno,$routeid);
    public function deleteSupplier($id);
    public function getAll();
}