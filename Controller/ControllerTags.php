<?php

/**
 * Description of ControllerDesktop
 * Запускает интерфейс пользователя
 *
 * @author Илья
 */
class ControllerTags
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
        $pageName = 'tags'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        
        $pageView = new PageView("desktop", $this->getParams(), "desktop_tags");
        $pageView->show();
    }
    
    
    public function runAction()
    {
        $text = $this->getParams()['sourceText'];

        $tranzit = explode("[", $text);
        
        unset($tranzit[0]);
        $tranzit = array_values($tranzit);
        

        TagasAndArray::deleteAll();
        while (count($tranzit) > 1){
        
            $description = explode(':', $tranzit[0]);

            if (count($description) > 1){
                
                $key = $description[0];
                
                $description = explode(']', $description[1]);
                $description = $description[0];
            } else {
                
                $key = explode(']', $description[0]);
                $key = $key[0];
                
                $description = null;
            }

            $data = explode(']', $tranzit[0]);
            $data = explode('[', $data[1]);
            $data = $data[0];
            
            $arrayOne[$key] = $description;
            $arrayTwo[$key] = $data;
            
            unset($tranzit[0]);
            unset($tranzit[1]);
            $tranzit = array_values($tranzit);

            TagasAndArray::insert($key, $description, $data);
            
        }
        
        $this->showResult();
        
    }
    
    private function showResult()
    {
        $pageName = 'tags_result'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        $pageView = new PageView('desktop', $this->getParams(), 'uni_desktop_table');
        $pageView->show();
    }

}
