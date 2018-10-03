<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/24/18
 * Time: 8:14 AM
 */

interface Supplier_BO
{
    public function getAllSuppliers();
    public function saveSupplier($supid, $supname , $address , $contact, $routeid);
    public function deleteSupplier($id);
    public function getSupplier($id);
}