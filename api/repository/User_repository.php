<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/4/18
 * Time: 8:43 AM
 */

interface User_repository
{
    public function setConnection(mysqli $connection);
    public function getUser($username);

}