<?php

/**
 * Description of ControllerDesktop
 * Запускает интерфейс пользователя
 *
 * @author Илья
 */
class ControllerRandomSQL
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
        $pageName = 'random'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        
        $pageView = new PageView("desktop", $this->getParams(), "uni_desktop_table");
        $pageView->show();
    }
    
    
    public function runAction()
    {
        
        
        $this->showResult();
        
    }
    
    private function showResult()
    {
        $pageName = 'random_result'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        $pageView = new PageView('desktop', $this->getParams(), 'desktop_random_result');
        $pageView->show();
    }

}
