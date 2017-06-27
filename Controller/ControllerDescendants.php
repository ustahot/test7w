<?php

/**
 * Description of ControllerDesktop
 * Запускает интерфейс пользователя
 *
 * @author Илья
 */
class ControllerDescendants
{
        
    private $params;
    
    public function __construct($params)
    {
        $this->setParams($params);
    }
    
    private function setParams($params)
    {
        $this->params = $params;
    }
    
    private function getParams()
    {
        return $this->params;
    }

    
    public function showForm()
    {
        
        $pageName = 'descendants'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        
        $pageView = new PageView("desktop", $this->getParams(), "uni_desktop_table");
        $pageView->show();
    }
    

}
