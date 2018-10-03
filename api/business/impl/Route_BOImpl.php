<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/24/18
 * Time: 3:08 PM
 */
require_once __DIR__ . "/../Route_BO.php";
require_once __DIR__."/../../repository/impl/Route_repositoryImpl.php";
require_once __DIR__."/../../db/DBConnection.php";
class Route_BOImpl implements Route_BO
{

    private $routeRepository;

    public function __construct()
    {
        $this->routeRepository = new Route_repositoryImpl();
    }
    public function getAll()
    {
        $connection = (new DBConnection())->getConnection();
        $this->routeRepository->setConnection($connection);

        $results = $this->routeRepository->getAll();
        mysqli_close($connection);
        return $results;
    }
}