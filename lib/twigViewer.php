<?php
require_once (realpath(dirname(__FILE__) . '/../twig/lib/Twig/Autoloader.php'));
require_once (realpath(dirname(__FILE__) . 'controller.php'));
Twig_Autoloader::register();
class lib_TwigViewer
{
    static private function setup()
    {
        $loader = new Twig_Loader_Filesystem(realpath(dirname(__FILE__) . '/../templates'));
        $twig = new Twig_Environment($loader, array(
        'cache' => realpath(dirname(__FILE__) . '/../cache'),//folder for twig cache
        ));
        return $twig;
    }
    static public function twigView($templateName, $vars)//render template width layout
    {
        $twig = self::setup();
        
        $twig->addFunction('include_component', new Twig_Function_Function('includeComponent'));//register component call function
        
        $template = $twig->loadTemplate($templateName);//load template
        $content = $template->render($vars);//render template
        $layout = $twig->loadTemplate('layout.html');//layout include
        echo $layout->render(array('content' => $content));//display result
    }
    
    static public function renderBlock($templateName, $vars)//withaut layout output
    {
        echo self::render($templateName, $vars);
    }
    
    static public function render($templateName, $vars)//for component actions render
    {
        try
        {
            $twig = self::setup();
            $template = $twig->loadTemplate($templateName);
            return $template->render($vars);//return rendered content
        }
        catch(Exeption $e)
        {
            $template = "error.html";
            $vars = array('er_kod'=>'500','error'=>$e);
            return $template->render($vars);//return rendered content
        }
    }
    
}

    function includeComponent($class, $function, $args = array())//simple function for calling of component class
    {
        if (class_exists($class) && method_exists($class, $function))
        {
            return call_user_func_array(array($class, $function), $args);
        }
        return null;
    }