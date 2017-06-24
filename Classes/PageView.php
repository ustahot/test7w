<?php

/**
 * Description of UserView
 *
 * @author Илья
 */
class PageView
{
    
    private $viewName;
    private $params;
    private $template;
            
    function __construct($viewName, $params = NULL, $template = NULL)
    {
        
        $this->setViewName($viewName);
        $this->setParams($params);
        $this->setTemplate($template);
    }
    
    private function setTemplate($template)
    {
        if ($template == FALSE){
            $this->template = $this->viewName;
        } else {
            $this->template = $template;
        }
    }
    
    private function getTemplate()
    {
        return $this->template;
    }
            
    private function setViewName($value){
        $this->viewName = $value;
    }
    
    private function setParams($value){
        $this->params = $value;
    }
            
    //function show($viewName, $mode = NULL)
    function show()
    {
        
        global $twig;
        
        if (file_exists("templates/" . $this->viewName . ".php")){
            $view = new $this->viewName($this->params);
            $array = $view->genArray();

            echo $twig->render($this->template . ".twig", $array);
            
        } else {
            
            echo $twig->render($this->template . ".twig");
        }
        
    }
    
}
