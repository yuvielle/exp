<?php
/**
 * Created by IntelliJ IDEA.
 * User: Yuvielle
 * Date: 09.09.13
 * Time: 12:21
 * To change this template use File | Settings | File Templates.
 */

abstract class model_baseModel {

    protected $tablename;
    private $conn = false;
    protected $fields;
    private $is_new;
    protected $config;

    public function findById($id){
        $query = self::getConnect()->prepare("SELECT * FROM " . $this->tablename . " WHERE id=?");
        $query->execute(array($id));
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function findAll(){

        $query = self::getConnect()->prepare("SELECT * FROM " . $this->tablename);
        $query->execute();
        return $query->fetchAll();
    }

    public function __construct(){
        $dbObject = lib_dbConnect::init();
        $this->conn =$dbObject->getConnection();
        $this->is_new = true;
        $this->config = app_config::init();
    }

    protected static function  getConnect(){
        $dbObject = lib_dbConnect::init();
        return $dbObject->getConnection();
    }

    public function isNew(){
        return $this->is_new;
    }

    public function save(){
        $this->fields["created_at"] = date("Y-m-d h:m:s");
        $fields = implode(",", array_keys($this->fields));
        $values = implode(",", array_values($this->fields));
        $pars = '';
        $first = true;
        $sym = "";
        foreach($this->fields as $i=>$field){

            $pars .= $sym . $i . "=" . $field;
            if($first)
            {
                $first = false;
                $sym = " ,";
            }
        }

        if($this->isNew()) $this->conn->exec("INSERT INTO " . $this->tablename ." ($fields) VALUES ($values)");
        else $this->conn->exec("UPDATE " . $this->tablename ." SET $pars WHERE id = " . $this->id);
        $this->is_new = false;
    }

    public function __set($name, $value){
        if(!array_key_exists($name, $this->fields)){
            throw new Exception("this field in not exist");
        }
        $this->fields[$name] = $value;
    }

    public function __get($name){
        if(!array_key_exists($name, $this->fields)){
            throw new Exception("this field in not exist");
        }
        return $this->fields[$name];
    }
}
