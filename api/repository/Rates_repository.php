<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/30/18
 * Time: 2:08 PM
 */

interface Rates_repository
{
    public function setConnection(mysqli $connection);
    public function getRate($month);
}