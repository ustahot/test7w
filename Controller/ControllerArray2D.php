<?php

/**
 * Description of ControllerDesktop
 * Запускает интерфейс пользователя
 *
 * @author Илья
 */
class ControllerArray2D
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
        
        $pageName = 'array2d'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        
        $pageView = new PageView("desktop", $this->getParams(), "uni_desktop_table");
        $pageView->show();
    }
    
    public function showResult()
    {
        
        $pageName = 'array2d_result'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        
        $pageView = new PageView("desktop", $this->getParams(), "uni_desktop_table");
        $pageView->show();
    }
    

    public function reGen()
    {
        
        $array2d = new Array2D();
        
        $array2d->gen();
        $array2d->writeArrayToSession();
        
        $pageName = 'array2d'; // Делаю через переменную для наглядности
        
        $this->setParams([null, $pageName]);
        
        $pageView = new PageView("desktop", $this->getParams(), "uni_desktop_table");
        $pageView->show();
    }
    
    
    public function bildResult()
    {
        $array2d = new Array2D();
        $array = $array2d->getArray();

        $indexArray = [];
        
        $maxFieldsCount = 0;
        
        
        foreach ($array as $row){
            $currenCount = count($row);
            if ($currenCount > $maxFieldsCount) {
                $maxFieldsCount = count($row);
            }
            $indexArray[] = ['current' => 0, 'max' => $currenCount];
        }

                
        $rowCount = count($array);
        
        $resultArray = [];
        $continue = true;
        while ($continue){
            
            $resultRow = [];

            foreach ($array as $key => $row){
                $resultRow[] = $row[$indexArray[$key]['current']];
            }
            
            $resultArray[] = $resultRow;
            
            $continue = !self::overStop($indexArray);
            $indexArray = self::revolver($indexArray);
        }
        
        
        // Костыль на NULL-ы в результате
        foreach ($resultArray as $key => $row){
            foreach ($row as $field){
                if (!isset($field)) {
                    unset($resultArray[$key]);
                }
            }
        }
        $resultArray = array_values($resultArray);
        // конец костыля
        
        
        $array2d->setResult($resultArray);
        $array2d->deleteResult();
        $array2d->writeResult();
        
        header('Location: router.php?params=Array2D_showResult');

        
        return;
    }
    
    private static function overStop($indexArray)
    {
        $result = true;
        foreach ($indexArray as $row){
            if ($row['current'] < $row['max']){
                $result = false;
            }
        }
        return $result;
    }
    
    private static function revolver($indexArray)
    {
        $rowsCount = count($indexArray);
        
        $currentRow = $rowsCount - 1;
        while ($currentRow >= 0){
            $indexArray[$currentRow]['current'] ++;
            if ($indexArray[$currentRow]['current'] <= $indexArray[$currentRow]['max']){
                break;
            }
            
            $indexArray[$currentRow]['current'] = 0;
            $currentRow --;
        }
        
        return $indexArray;
    }

    private static function revolver2($indexArray)
    {
        $rowsCount = count($indexArray);
        
        $currentRow = $rowsCount - 1;
        while ($currentRow >= 0){
            $indexArray[$currentRow]['current'] ++;
            if ($indexArray[$currentRow]['current'] <= $indexArray[$currentRow]['max']){
                break;
            }
            
            $indexArray[$currentRow]['current'] = 0;
            $currentRow --;
        }
        
        return $indexArray;
    }
}
