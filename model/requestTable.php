<?php
/**
 * Created by IntelliJ IDEA.
 * User: Yuvielle
 * Date: 09.09.13
 * Time: 22:10
 * To change this template use File | Settings | File Templates.
 */

class model_requestTable extends model_baseModel{

    protected $tablename = "ss_request";
    protected $fields = array("id"=>null, "url"=>null, "ip"=>null, "comment"=>null, "created_at"=>null);

    public function getMaxCountRecords(){
        $query = self::getConnect()->prepare("SELECT *, count(*) as count FROM " . $this->tablename . " GROUP BY url ORDER BY count DESC LIMIT " . $this->config->countUrl);
        $query->execute();
        return $query->fetchAll();
    }

    public function getLimitedCountRecords(){
        $query = self::getConnect()->prepare("SELECT *, count(*) as count FROM " . $this->tablename . " GROUP BY url HAVING count > " . $this->config->limitCountUrlsValue);
        $query->execute();
        return $query->fetchAll();
    }

    public function getUserQueriedRecords($query_string){
        $query = self::getConnect()->prepare("SELECT * FROM " . $this->tablename . " WHERE url LIKE \"%" . $query_string . "%\"");
        $query->execute();
        return $query->fetchAll();
    }
}
