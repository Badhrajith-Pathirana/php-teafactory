<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/31/18
 * Time: 10:36 PM
 */

interface Credit_BO
{
    public function getCreditsToday();
    public function deleteCredit($creditid);
    public function saveCredit($supid,$creditType,$amount);
    public function getCreditTypes();
}