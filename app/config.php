<?php
/**
 * Created by IntelliJ IDEA.
 * User: Yuvielle
 * Date: 09.09.13
 * Time: 12:21
 * To change this template use File | Settings | File Templates.
 */ 
class app_config {

    private $dbDriver = "mysql"; //oci, pgsql
    private $dbName = "statistic_system";
    private $dbHost = "localhost";
    private $dbUser = "root";
    private $dbPassword = "1234";
    private $dbPort = "1521"; //for oracle
    private static $object = null;
    private $countUrl = 10;
    private $limitCountUrlsValue = 1;

    public static function init(){
        if(!self::$object){
           self::$object = new app_config();
        }
        return self::$object;
    }

    private function  __construct(){

    }

    public function  __get($name){
        return $this->$name;
    }
}
