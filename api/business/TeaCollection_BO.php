<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/27/18
 * Time: 6:42 PM
 */

interface TeaCollection_BO
{
    public function getToday();
    public function saveTeaCollection($supid, $akg,$bkg);
    public function deleteCollection($purchaseid);
}