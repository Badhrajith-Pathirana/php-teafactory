<?php
/**
 * Created by IntelliJ IDEA.
 * User: beempz
 * Date: 8/3/18
 * Time: 9:55 PM
 */
require_once __DIR__."/../Session_BO.php";
class Session_BOImpl implements Session_BO
{

    public function checkSession()
    {
        session_set_cookie_params(60*60*24*7);
        ini_set("session.gc_maxlifetime",60*60*24*7);
        session_start();
        if(isset($_SESSION["exists"])){
            return true;
        }
        session_unset();
        session_destroy();
        return false;
    }

    public function setSession($username, $accType)
    {
        session_set_cookie_params(60*60*24*7);
        ini_set("session.gc_maxlifetime",60*60*24*7);
        session_start();
        $_SESSION["user"] = $username;
        $_SESSION["acc_type"] = $accType;
        $_SESSION["exists"] = true;
    }
}