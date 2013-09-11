<?php
require_once (realpath(dirname(__FILE__) . '/../lib/autoload.php'));//class of autoloader of this project
autoload::init();

class Dispatcher//very simple dispatcher
{
    public static function getContent()
    {
        $request = new lib_request();
        $get = $_GET;
        $actionClass=new app_controller();
        
        if(!$action = @$get['page'])//name of action
        {
            $action = 'home';//default action
        }
        try{
            if(method_exists($actionClass, $action))
            {
                $actionClass->$action($request);
            }
            else
            {
                $actionClass->err404($request);//reqwested action not found
            }
        }
        catch(Exception $e)
        {
            $actionClass->error($request, $e);//get exeption
        }
    }
}