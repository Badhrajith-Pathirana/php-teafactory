<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/1/18
 * Time: 5:42 AM
 */

interface Credit_type_repository
{
    public function setConnection(mysqli $connection);
    public function getCreditTypes();
    public function getCreditTypeById($id);
    public function getCreditTypeByname($name);
}