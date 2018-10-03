<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/3/18
 * Time: 10:03 PM
 */
require_once __DIR__."/business/impl/Session_BOImpl.php";
header("Content-type: application/json");
$method = $_SERVER["REQUEST_METHOD"];
$sessionBO = new Session_BOImpl();
switch ($method){
    case "GET":
        $action = $_GET["action"];
        switch ($action){
            case "check":
                echo json_encode($sessionBO->checkSession());
                break;
        }
        break;
}