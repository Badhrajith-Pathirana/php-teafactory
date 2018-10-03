
<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/30/18
 * Time: 2:10 PM
 */
require_once __DIR__."/../Rates_repository.php";
class Rates_repositoryImpl implements Rates_repository
{

    private $connection;
    public function setConnection(mysqli $connection)
    {
        $this->connection = $connection;
    }

    public function __construct()
    {
        $this->connection = (new DBConnection())->getConnection();
    }

    public function getRate($month)
    {
        $resultset = $this->connection->query("select * from rate where MONTH(rateMonth) = MONTH('{$month}')");
        return $resultset->fetch_assoc();
    }
}