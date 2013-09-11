<?php
/**
 * Created by IntelliJ IDEA.
 * User: Yuvielle
 * Date: 10.09.13
 * Time: 21:41
 * To change this template use File | Settings | File Templates.
 */ 
class app_baseController {

    private $view;

    public function __construct(){
        $this->view = new view_viewer();
    }

    public function __get($name){
        if($name = "view"){
            $callers=debug_backtrace();
            $defaultTemplateName =  $callers[1]['function'];
            $this->view->setTemplate($defaultTemplateName);
            return $this->view;
        }
        return $this->$name;
    }
}
