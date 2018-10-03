<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/24/18
 * Time: 3:30 PM
 */
require_once __DIR__ . "/business/impl/Route_BOImpl.php";
header("Content-type: application/json");
$method = $_SERVER["REQUEST_METHOD"];
$route_services = new Route_BOImpl();
switch ($method){
    case "GET":
        $action = $_GET["action"];
        switch ($action){
            case "all":
                echo json_encode($route_services->getAll());
                break;
        }
        break;
}