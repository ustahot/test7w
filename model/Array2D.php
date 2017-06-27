<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Million
 *
 * @author Илья
 */
class Array2D
{
    
    private $array;
    private $result;
    
    
    public function __construct()
    {
        if (isset($_SESSION['test7w']['array2D'])){
            $this->readArrayFromSession();
        } else {
            $this->gen();
            $this->writeArrayToSession();
        }
    }
    
    
    public function setResult($result)
    {
        $this->result = $result;
    }
    
    private function getResult()
    {
        return $this->result;
    }
    
    
    private function setArray($array)
    {
        $this->array = $array;
    }
    
    public function getArray()
    {
        return $this->array;
    }
    

    public function getList()
    {
        
        $array = $this->getArray();
        
        foreach ($array as $row){
        
            $result['body'][] = ['data' => $row];
            $result['header'] = [];
            
        }
            
        return $result;
    }

    
    public function gen()
    {
        $asciiStart = 65;

                
        $maxRows =  random_int(1, 10);            

        $result = [];
        
        for ($currentRowNum = 1; $currentRowNum <= $maxRows; $currentRowNum ++){

            $maxItems = random_int(1, 5);            
            $operRow = [];
            $currentRowIndex = chr($asciiStart + $currentRowNum - 1);
            
            for ($currentItemNum = 1; $currentItemNum <= $maxItems; $currentItemNum ++){
                $operRow[$currentItemNum] = $currentRowIndex . $currentItemNum;
            }
            
            $result[] = $operRow;
            
        }
        $this->setArray($result);
    }
    
    public function gen_new_pilot()
    {
        $asciiStart = 65;

                
        $maxRows =  random_int(0, 9);            

        $result = [];
        
        for ($currentRowNum = 0; $currentRowNum <= $maxRows; $currentRowNum ++){

            $maxItems = random_int(0, 4);            
            $operRow = [];
            $currentRowIndex = chr($asciiStart + $currentRowNum);
            
            for ($currentItemNum = 0; $currentItemNum <= $maxItems; $currentItemNum ++){
                $operRow[$currentItemNum] = $currentRowIndex . $currentItemNum;
            }
            
            $result[] = $operRow;
            
        }
        $this->setArray($result);
    }

    
    public function deleteResult()
    {
        $sql = 'DELETE FROM array2d';

        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на удаление результата 2D');
        }

        if (!$st->execute()){

            die('Не удалось выполнить запрос на удаление результата 2D');
        }
        
    }


    public function writeResult()
    {
        foreach ($this->getResult() as $row){
        
            $sql = 'INSERT INTO array2d (c00, c01, c02, c03, c04, c05, c06, c07, c08, c09)
                        VALUES (:c00, :c01, :c02, :c03, :c04, :c05, :c06, :c07, :c08, :c09)
                    ';

            if (!$st = Cfg::getDB()->prepare($sql)){
                die('Не удалось подготовить запрос на запись результата 2D');
            }

            $st->bindParam(':c00', $row[0], PDO::PARAM_STR);
            $st->bindParam(':c01', $row[1], PDO::PARAM_STR);
            $st->bindParam(':c02', $row[2], PDO::PARAM_STR);
            $st->bindParam(':c03', $row[3], PDO::PARAM_STR);
            $st->bindParam(':c04', $row[4], PDO::PARAM_STR);
            $st->bindParam(':c05', $row[5], PDO::PARAM_STR);
            $st->bindParam(':c06', $row[6], PDO::PARAM_STR);
            $st->bindParam(':c07', $row[7], PDO::PARAM_STR);
            $st->bindParam(':c08', $row[8], PDO::PARAM_STR);
            $st->bindParam(':c09', $row[9], PDO::PARAM_STR);


            if (!$st->execute()){

                die('Не удалось выполнить запрос на запись результата 2D');
            }
            
        }

    }
    
    public function writeArrayToSession()
    {
        $_SESSION['test7w']['array2D'] = $this->getArray();
    }
    
    private function readArrayFromSession()
    {
        $this->setArray($_SESSION['test7w']['array2D']);
    }

    public function getResultList()
    {
        $sql = "SELECT c00, c01, c02, c03, c04, c05, c06, c07, c08, c09
                FROM array2d
                ";
        
        //$result['header'] = ["Id", "Имя", "Id родителя", "Имя родителя"];
        $result['header'] = [];
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на чтение результата 2D!');
        }
        
        
        if (!$st->execute()) {
            die('Не удалось выполнить запрос на чтение результата 2D!');
        }
        
        $result['body'] = [];
        while ($row = $st->fetch(PDO::FETCH_ASSOC)){
            $result['body'][] = ['data' => $row];
        }

            
        return $result;
    }
    
    
}
