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
            
        }elseif ($this->getPageName() === "tree"){
            $result = $this->genArrayTree();
            
        }elseif ($this->getPageName() === "descendants"){
            $result = $this->genArrayDescendants();
            
        }elseif ($this->getPageName() === "parents"){
            $result = $this->genArrayParents();
            
        }elseif ($this->getPageName() === "million"){
            $result = $this->genArrayMillion();
            
        }elseif ($this->getPageName() === "million_result"){
            $result = $this->genArrayMillionResult();
            
        }elseif ($this->getPageName() === "array2d"){
            $result = $this->genArrayArray2D();

        }elseif ($this->getPageName() === "array2d_result"){
            $result = $this->genArrayResultArray2D();
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
            ],
            [
                'itemHref' => 'router.php?params=Descendants_showForm',
                'itemText' => 'Три потомка'
            ],
            [
                'itemHref' => 'router.php?params=Parents_showForm',
                'itemText' => 'Два родителя'
            ],
            [
                'itemHref' => 'router.php?params=Million_showForm',
                'itemText' => 'Лям элементов'
            ],
            [
                'itemHref' => 'router.php?params=Array2D_showForm',
                'itemText' => 'Массив 2D'
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
        $randomSQL = new RandomSQL();        
        
        $result = [
            'title' => "слуЧайное дерево (табличный вид)",
            'sidebar' => [
                [
                    'itemText' => "Заполнить таблицу",
                    'itemHref' => "router.php?params=RandomSQL_reFill"
                ],
                [
                    'itemText' => "Вывести дерево",
                    'itemHref' => "router.php?params=RandomSQL_showTree"
                ]
            ],
            'table' => $randomSQL->getList(),
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){
                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }
        
        return $result;
    }

    private function genArrayTree()
    {
        $randomSQL = new RandomSQL();        
        
        $result = [
            'title' => "слуЧайное дерево (дерево)",
            'sidebar' => [
                [
                    'itemText' => "Заполнить таблицу",
                    'itemHref' => "router.php?params=RandomSQL_reFill"
                ]
            ],
            'table' => $randomSQL->getTree(),
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){
                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }

        return $result;
    }

    
    private function genArrayDescendants()
    {
        $randomSQL = new RandomSQL();        
        
        $result = [
            'title' => "Записи без родителелей, но с тремя потомками (в глубину)",
            'sidebar' => [],
            'table' => $randomSQL->getDescendants(),
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){
                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }

        return $result;
    }
    
    
    private function genArrayParents()
    {
        $randomSQL = new RandomSQL();        
        
        $result = [
            'title' => "Записи без потомков, но с двумя родителями (в иерархии)",
            'sidebar' => [],
            'table' => $randomSQL->getParents(),
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){
                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }

        return $result;
    }

    
    private function genArrayMillion()
    {
        $million = new Million();
        
        $result = [
            'title' => "Лям элементов от 100 тыс. до 1,5 млн.",
            'sidebar' => [
                    [
                        'itemText' => "Новый расчет",
                        'itemHref' => "router.php?params=Million_showForm"
                    ]
            ],
            'table' => $million->getListRandom()
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){
                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }

        return $result;
    }

    private function genArrayArray2D()
    {
        $array2D = new Array2D();
        
        $result = [
            'title' => "Массив 2D",
            'sidebar' => [
                    [
                        'itemText' => "Сгенерить новый массив",
                        'itemHref' => "router.php?params=Array2D_reGen"
                    ],
                    [
                        'itemText' => "Сформировать комбинации",
                        'itemHref' => "router.php?params=Array2D_bildResult"
                    ]
            ],
            'table' => $array2D->getList()
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){

                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }

        return $result;
    }
    
    
    private function genArrayResultArray2D()
    {
        $array2D = new Array2D();
        
        $result = [
            'title' => "Массив 2D",
            'sidebar' => [
                    [
                        'itemText' => "Сгенерить новый массив",
                        'itemHref' => "router.php?params=Array2D_reGen"
                    ]
            ],
            'table' => $array2D->getResultList()
        ];

        foreach ($result['table']['body'] as $key => $row){
                $result['table']['body'][$key]['actions'] = [];

            foreach ($row['data'] as $fieldKey => $value){

                $result['table']['body'][$key]['data'][$fieldKey] =  htmlspecialchars($value);
            }
        }

        return $result;
    }
    
}
