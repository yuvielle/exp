<?php
class lib_request
{
    protected $pathInfoArray = null;
    protected $serverVars = array();
    protected $options = array(
			    'path_info_key'   => 'PATH_INFO',
			    'path_info_array' => 'SERVER',
			    'http_port'       => null,
			    'https_port'      => null,
			    'default_format'  => null, // to maintain bc
			    );
    
    public function isXmlHttpRequest()
    {
        return ($this->getHttpHeader('X_REQUESTED_WITH') == 'XMLHttpRequest');
    }
    
    private function getHttpHeader($name, $prefix = 'http')
    {
        if ($prefix)
        {
            $prefix = strtoupper($prefix).'_';
        }

        $name = $prefix.strtoupper(strtr($name, '-', '_'));

        $pathArray = $this->getPathInfoArray();

        return isset($pathArray[$name]) ? stripslashes($pathArray[$name]) : null;
    }
    
    private function getPathInfoArray()
    {
        if (!$this->pathInfoArray)
        {
            // parse PATH_INFO
            switch ($this->options['path_info_array'])
            {
                case 'SERVER':
                $this->pathInfoArray =& $_SERVER;
                break;

                case 'ENV':
                default:
                $this->pathInfoArray =& $_ENV;
            }
        }

        return $this->pathInfoArray;
    }

    public function post(){
        return $_POST;
    }

    public function get(){
        return $_GET;
    }

    public function session(){
        return $_SESSION;
    }

    public function getRequest(){
        return $_REQUEST;
    }

    public function __get($name){
        if(!array_key_exists($name, $_REQUEST)){
             return false;
        }
        return $_REQUEST[$name];
    }

    public function getServerVars(){
        $this->serverVars["ip"] = $_SERVER["REMOTE_ADDR"];
        $this->serverVars["url"] = $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
        return $this->serverVars;
    }
}