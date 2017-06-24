<?php

/**
 * Description of ControllerDesktop
 * Запускает интерфейс пользователя
 *
 * @author Илья
 */
class ControllerRazDvaTri
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
        $pageName = 'razdvatri'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        
        $pageView = new PageView("desktop", $this->getParams(), "desktop_razdvatri");
        $pageView->show();
    }
    
    
    public function runAction()
    {
        $text = $this->getParams()['sourceText'];
        
        $raz = null;
        if (preg_match("/raz\:/", $text) === 1){
            $raz = preg_split("/raz\:/", $text);
            $raz = preg_split("/dva\:/", $raz[count($raz) - 1]);
            $raz = preg_split("/tri\:/", $raz[0]);
            $raz = $raz[0];
        }
 
        $dva = null;
        if (preg_match("/dva\:/", $text) === 1){
            $dva = preg_split("/dva\:/", $text);
            $dva = preg_split("/raz\:/", $dva[count($dva) - 1]);
            $dva = preg_split("/tri\:/", $dva[0]);
            $dva = $dva[0];
        }
        
        $tri = null;
        if (preg_match("/tri\:/", $text) === 1){
            $tri = preg_split("/tri\:/", $text);
            $tri = preg_split("/raz\:/", $tri[count($tri) - 1]);
            $tri = preg_split("/dva\:/", $tri[0]);
            $tri = $tri[0];
        }

        RazDvaTri::deleteAll();
        
        RazDvaTri::insert('raz:', $raz);
        RazDvaTri::insert('dva:', $dva);
        RazDvaTri::insert('tri:', $tri);
        
        
        $this->showResult();
        
    }
    
    private function showResult()
    {
        $pageName = 'razdvatri_result'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        $pageView = new PageView('desktop', $this->getParams(), 'uni_desktop_table');
        $pageView->show();
    }

}
