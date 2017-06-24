<?php
/**
 * Description of Cfg
 *
 * @author Илья
 */
class Cfg
{

    static function getDB()
    {
        $conn = new PDO("mysql:host=localhost;dbname=test7w;charset=UTF8", "php_client", "1122");
        return $conn;
    }
    
    static function getCurrentRoles()
    {
        return $_SESSION['roles'];
    }
    
    
    static function setCurrentRoles($roles)
    {
        $_SESSION['roles'] = "Guest";
    }
    
    
    static function getCurrentUserId()
    {
        return $_SESSION['userId'];
    }
    
    
}
