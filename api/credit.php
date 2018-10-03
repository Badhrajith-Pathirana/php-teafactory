<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/31/18
 * Time: 11:43 PM
 */
require_once __DIR__ . "/business/impl/Credit_BOImpl.php";
header("Content-type: application/json");
$creditService = new Credit_BOImpl();
$method = $_SERVER["REQUEST_METHOD"];
switch ($method){
    case "GET":
        $action = $_GET["action"];
        switch ($action){
            case "all":
                echo json_encode($creditService->getCreditsToday());
                break;
            case "types":
                echo json_encode($creditService->getCreditTypes());
                break;
        }
        break;
    case "POST":
        $action = $_POST["action"];
        switch ($action){
            case "save":
                $supid= $_POST["supid"];
                $credittype = $_POST["credittype"];
                $amount = $_POST["amount"];
                echo json_encode($creditService->saveCredit($supid,$credittype,$amount));
                break;
        }
        break;
    case "DELETE":
        $queryString = $_SERVER["QUERY_STRING"];
        $idSet = preg_split("/=/",$queryString);
        if(count($idSet) === 2){
            $creditid = $idSet[1];
            echo json_encode($creditService->deleteCredit($creditid));
        }
        break;
}