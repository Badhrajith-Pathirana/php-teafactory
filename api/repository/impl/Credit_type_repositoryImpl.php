<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/1/18
 * Time: 5:44 AM
 */
require_once __DIR__."/../Credit_type_repository.php";
class Credit_type_repositoryImpl implements Credit_type_repository
{

    private $connection;
    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }
    /*public function __construct()
    {
        $this->connection = new mysqli("hfihf","jvidjvd","hcduhuhv","hvuhufhv","vfvfv");
    }*/

    public function getCreditTypes()
    {
        $resultSet = $this->connection->query("select * from credit_type");
        return $resultSet->fetch_all(MYSQLI_ASSOC);
    }

    public function getCreditTypeById($id)
    {
        $resultSet = $this->connection->query("select * from credit_type where typeid = $id");
        return $resultSet->fetch_assoc();
    }

    public function getCreditTypeByname($name)
    {
        $resultSet = $this->connection->query("select * from credit_type where type_name = '{$name}'");
        return $resultSet->fetch_assoc();
    }
}