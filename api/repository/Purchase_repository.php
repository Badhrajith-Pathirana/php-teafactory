<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/27/18
 * Time: 4:44 AM
 */

interface Purchase_repository
{
    public function setConnection(mysqli $connection);
    public function getAll();
    public function saveTeaCollection($purchaseDate,$supid,$akg,$bkg);
    public function updateTeaCollection($purchaseid,$purchaseDate,$supid,$akg,$bkg);
    public function getTeaCollection($purchaseid);
    public function deleteTeaCollection($purchaseid);
    public function getToday();

}