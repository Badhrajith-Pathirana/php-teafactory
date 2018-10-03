<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/27/18
 * Time: 5:21 PM
 */
require_once __DIR__ . "/business/impl/TeaCollection_BOImpl.php";
header("Content-type: application/json");
$method = $_SERVER["REQUEST_METHOD"];
//echo $method;
$teaCollection = new TeaCollection_BOImpl();
switch ($method){
    case "GET":
        $action = $_GET["action"];
        switch ($action){
            case "allToday":
                echo json_encode($teaCollection->getToday());
                break;
        }
        break;
    case "POST":
        $action = $_POST["action"];
        switch ($action){
            case "save":
                $supid = $_POST["supid"];
                $akg = $_POST["akg"];
                $bkg = $_POST["bkg"];
                echo json_encode($teaCollection->saveTeaCollection($supid,$akg,$bkg));
                break;
        }
        break;
    case "DELETE":
        $queryStr = $_SERVER["QUERY_STRING"];
        $queryArr = preg_split("/=/",$queryStr);
        if(count($queryArr) === 2){
            echo json_encode($teaCollection->deleteCollection($queryArr[1]));
        }
        break;
}