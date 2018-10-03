<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/24/18
 * Time: 8:27 AM
 */
require_once __DIR__ . "/business/impl/Supplier_BOImpl.php";
header("Content-type: application/json");
$method = $_SERVER["REQUEST_METHOD"];
$supplier_services = new Supplier_BOImpl();
switch ($method){
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $idSet = preg_split("/=/",$queryString);
        if(count($idSet) === 2){
            $id = $idSet[1];
            echo json_encode($supplier_services->deleteSupplier($id));
        }
        break;
    case "GET":
        $action = $_GET["action"];
        switch ($action){
            case "all":
              echo json_encode($supplier_services->getAllSuppliers());
              break;
        }
        break;
    case "POST":
        $action = $_POST["action"];
        switch ($action){
            case "save":
                $supid = $_POST["id"];
                $supname = $_POST["name"];
                $address = $_POST["address"];
                $contactno = $_POST["contact"];
                $routeid = $_POST["routeid"];
                echo json_encode($supplier_services->saveSupplier($supid,$supname,$address,$contactno,$routeid));
                break;
        }
        break;

}