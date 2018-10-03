<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/4/18
 * Time: 8:47 AM
 */
require_once __DIR__."/../User_repository.php";
class User_repositoryImpl implements User_repository
{

    private $connection;
    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }
    /*public function __construct()
    {
        $this->connection = new mysqli("vbhfbv","nvnvj","bcdhbchdcb","cdbhdbc","bchdbchdcb");
    }*/

    public function getUser($username)
    {
        $resultSet = $this->connection->query("select * from user where username = '{$username}'");
        return $resultSet->fetch_assoc();
    }
}