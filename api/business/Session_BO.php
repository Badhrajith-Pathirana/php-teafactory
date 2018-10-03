<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/3/18
 * Time: 9:53 PM
 */

interface Session_BO
{
    public function checkSession();
    public function setSession($username,$accType);
}