<?php
/**
 * Created by IntelliJ IDEA.
 * User: Yuvielle
 * Date: 09.09.13
 * Time: 12:21
 * To change this template use File | Settings | File Templates.
 */

/** @noinspection PhpIncludeInspection */

class lib_dbConnect {

    private static $object;
    private $conn = null;

    public static function init(){
        if(!self::$object){
            self::$object = new lib_dbConnect();
        }
        return self::$object;
    }

    private function __construct(){
        $config = app_config::init();
        $driver = $config->dbDriver;
        $name = $config->dbName;
        $user = $config->dbUser;
        $pass = $config->dbPassword;

        if($name == "oci"){
            $host = "
            (DESCRIPTION =
                (ADDRESS_LIST =
                    (ADDRESS = (PROTOCOL = TCP)(HOST = " . $config->dbHost . ")(PORT = " . $config->dbPort . "))
                )
                (CONNECT_DATA =
                    (SERVICE_NAME = orcl)
                )
            )";
        } else {
            $host = ";host=" . $config->dbHost;
        }

        try{
            $db = $driver . ":dbname=" . $name . $host;    //pgsql:dbname=$dbname;host=$host  oci:dbname=yoursid
            //echo "db=" . $db . "<br>";
            $conn = new PDO($db,$user,$pass);

        } catch(PDOException $e){
            //echo $e->getMessage();
            $conn = false;
              //todo add exception strategy
        }
        $this->conn = $conn;
    }

    public function getConnection(){
        return $this->conn;
    }
}
