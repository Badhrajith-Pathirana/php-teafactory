<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/4/18
 * Time: 8:42 AM
 */
require_once __DIR__."/../User_BO.php";
require_once __DIR__."/../../repository/impl/User_repositoryImpl.php";
require_once __DIR__."/../../db/DBConnection.php";
require_once __DIR__."/Session_BOImpl.php";
class User_BOImpl implements User_BO
{
    private $userRepository;
    private $sessionBO;
    public function __construct()
    {
        $this->sessionBO = new Session_BOImpl();
        $this->userRepository = new User_repositoryImpl();
    }


    public function getUser($username,$password)
    {
        $connection = (new DBConnection())->getConnection();
        $this->userRepository->setConnection($connection);

        $result = $this->userRepository->getUser($username);
        if($result === null){
            mysqli_close($connection);
            return -1;
        }
        if($result["password"] === $password){
            $this->sessionBO->setSession($username,$result["acc_type"]);
            mysqli_close($connection);
            return 1;
        }
        mysqli_close($connection);
        return 0;
    }
}