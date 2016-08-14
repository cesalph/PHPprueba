<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Database
{
    private static $dbName = 'store' ;
    private static $dbHost = 'localhost';
    private static $dbUserPassword = '';
    private static $dbUsername = 'root';
    private static $cont  = null;
   
    public function __construct() {
        die('Init function is not allowed');
    }
   
    public static function connect()
    {
       // One connection through whole application
       if ( null == self::$cont )
       {    
        try
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword);
        }
        catch(PDOException $e)
        {
          die($e->getMessage());
        }
       }
       return self::$cont;
    }
   
    public static function disconnect()
    {
        self::$cont = null;
    }
}