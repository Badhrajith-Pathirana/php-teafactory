<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/3/18
 * Time: 11:43 PM
 */
require_once __DIR__."/business/impl/User_BOImpl.php";
header("Content-type: application/json");
$method = $_SERVER["REQUEST_METHOD"];
$userBO = new User_BOImpl();
switch ($method){
    case "POST":
        $action = $_POST["action"];
        switch ($action){
            case "authenticate":
                $username = $_POST["username"];
                $password = $_POST["password"];
                echo json_encode($userBO->getUser($username,$password));
                break;
        }

        break;
}