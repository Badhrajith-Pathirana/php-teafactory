<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/24/18
 * Time: 12:57 PM
 */
require_once __DIR__."/../Route_repository.php";

class Route_repositoryImpl implements Route_repository
{

    private $connection;



    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function getRoute($id)
    {
        $resultset = $this->connection->query("select * from route where routeid = {$id}");
        return $resultset;
    }

    public function saveRoute($id, $routename)
    {
        $result = $this->connection->query("insert into route (routename) values('{$routename}')");
        if($result){
            return $this->connection->affected_rows;
        }else{
            return -1;
        }
    }

    public function updateRoute($id, $routename)
    {
        $result= $this->connection->query("update route set routename = '{$routename}' where routeid = '{$id}'");
        if($result) {
            return $this->connection->affected_rows;
        }
        else{
            return -1;
        }
    }

    public function deleteRoute($id)
    {
        $result = $this->connection->query("delete from route where routeid= {$id}");
        if($result){
            return $this->connection->affected_rows;
        }else{
            return -1;
        }
    }

    public function getAll()
    {
        $resultset = $this->connection->query("select * from route");
        $routes = $resultset->fetch_all(MYSQLI_ASSOC);
        return $routes;
    }
}