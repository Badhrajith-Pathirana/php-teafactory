<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 7/24/18
 * Time: 12:54 PM
 */

interface Route_repository
{
    public function setConnection(mysqli $connection);
    public function getRoute($id);
    public function saveRoute($id, $routename);
    public function updateRoute($id, $routename);
    public function deleteRoute($id);
    public function getAll();
}