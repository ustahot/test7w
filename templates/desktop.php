<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of admin_desktop
 *
 * @author Илья
 */
class Desktop
{
    //private $templateName = "admin_desktop";
    private $templateName;
    private $pageName;


    public function __construct($params)
    {
        $this->setPageName($params[1]);
    }
    
    protected function setTemplateName($templateName)
    {
        $this->templateName = $templateName;
    }
    
    public function getTemplateName()
    {
        return $this->templateName;
    }
    

    protected function setPageName($pageName)
    {
        $this->pageName = $pageName;
    }
    
    public function getPageName()
    {
        return $this->pageName;
    }

    
    //function GenArray($mode = NULL, $params = NULL)
    function GenArray()
    {
        
        
        if ($this->getPageName() === "tags"){
            $result = $this->genArrayTags();

        }elseif ($this->getPageName() === "tags_result"){
            $result = $this->genArrayTagsResult();
        
        }elseif ($this->getPageName() === "razdvatri"){
            $result = $this->genArrayRazDvaTri();

        }elseif ($this->getPageName() === "razdvatri_result"){
            $result = $this->genArrayRazDvaTriResult();
        
        }elseif ($this->getPageName() === "random"){
            $result = $this->genArrayRandom();
        }     

        
        $result['desktopTitle'] = 'test7w';
        $result['navbar'] = [
            [
                'itemHref' => 'router.php?params=Tags_showForm',
                'itemText' => 'ТЕКСТ-МАССИВЫ'
            ],
            [
                'itemHref' => 'router.php?params=RazDvaTri_showForm',
                'itemText' => 'Раз-Два-Три'
            ],
            [
                'itemHref' => 'router.php?params=RandomSQL_showForm',
                'itemText' => 'слуЧайное дерево'
            ]
        ];

        return $result;
    }
    
    private function genArrayTags()
    {
                
        $result = [
            'title' => "Преобразовать текст с тегами в 2 массива",
            'sidebar' => []
        ];

        return $result;
    }
    
    private function genArrayTagsResult()
    {
        $tagsAndArray = new TagasAndArray();
                
        $result = [
            'title' => "Темы",
            'sidebar' => [
                            [
                                'itemText' => "Вернуться на начало теста",
                                'itemHref' => "router.php?params=Tags_showForm"
                            ]
            ],
            'table' => $tagsAndArray->getList(),
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){
                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }
        
        return $result;
        
        
    }

    private function genArrayRazDvaTri()
    {
                
        $result = [
            'title' => "Парсинг по raz: dva: tri:",
            'sidebar' => []
        ];

        return $result;
    }
    
    private function genArrayRazDvaTriResult()
    {
        $razDvaTri = new RazDvaTri();
                
        $result = [
            'title' => "Темы",
            'sidebar' => [
                            [
                                'itemText' => "Вернуться на начало теста",
                                'itemHref' => "router.php?params=RazDvaTri_showForm"
                            ]
            ],
            'table' => $razDvaTri->getList(),
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){
                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }
        
        return $result;
    }


    private function genArrayRandom()
    {
                
        $result = [
            'title' => "слуЧайное дерево",
            'sidebar' => [
                [
                    'itemText' => "Заполнить таблицу",
                    'itemHref' => "router.php?params=RandomSQL_reFill"
                ],
                [
                    'itemText' => "Вывести дерево",
                    'itemHref' => "router.php?params=RandomSQL_showTree"
                ]
            ]
        ];

        return $result;
    }

}
