<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/31/18
 * Time: 12:16 PM
 */
require_once __DIR__ . "/business/impl/Debit_BOImpl.php";
header("Content-type: application/json");
$debitServices = new Debit_BOImpl();
$method = $_SERVER["REQUEST_METHOD"];
switch ($method){
    case "GET":
        $action = $_GET["action"];
        switch ($action){
            case "getSup":
                $id = $_GET["supplierid"];
                echo json_encode($debitServices->getbySupplier($id));
                break;
        }
        break;
}