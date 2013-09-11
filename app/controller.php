<?php
/**
 * Created by IntelliJ IDEA.
 * User: Yuvielle
 * Date: 09.09.13
 * Time: 12:22
 * To change this template use File | Settings | File Templates.
 */
class app_controller extends app_baseController{

    public function setStatAjax($request){
        if(!$request->isXmlHttpRequest){
           throw new Exception("query must be ajax");
        }
        try{
            $model = new model_requestTable();
            //$model->ip = $request->ip;
            //$model->url = $request->url;
            $model->comment = $request->comment;
            $vars = $request->getServerVars();
            $model->ip = $vars["ip"];
            $model->url = $vars["url"];
            $model->save();
        } catch(Exception $e) {
            //todo exception strategy
        }
    }

    public function setStat($request){
        try{
            $model = new model_requestTable();
            $vars = $request->getServerVars();
            $model->ip = $vars["ip"];
            $model->url = $vars["url"];
            $model->comment="no comments";
            if($request->comment)
                $model->comment = $request->comment;
            $result = $model->save();
            echo "<br>count=" . $result;

        } catch(Exception $e) {
            echo $e->getMessage();
        }
    }

    public function home($request){
        $model = new model_requestTable();
        $result = $model->findAll();
        $this->view->records = $result;
        echo $this->view->render();
    }

    public function showMaxCount($request){
        $model = new model_requestTable();
        $result = $model->getMaxCountRecords();
        $this->view->records = $result;
        echo $this->view->render();
    }

    public function showLimitedCount($request){
        $model = new model_requestTable();
        $result = $model->getLimitedCountRecords();
        $this->view->records = $result;
        echo $this->view->render();
    }

    public function search($request){
        $model = new model_requestTable();
        $result = $model->getUserQueriedRecords($request->search);
        $this->view->records = $result;
        echo $this->view->render();
    }

    public function testPage(){
        echo $this->view->render();
    }

    public function err404($request){
        echo "404 error";
    }

    public function error($request, Exception $e){
        echo "500 error: ";
        echo $e->getMessage();
    }

}
