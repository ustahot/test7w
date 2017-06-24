<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of TagasAndArray
 *
 * @author Илья
 */
class TagasAndArray
{
    public static function deleteAll()
    {
        $sql = "DELETE FROM tags_and_array";

        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на удаление всех записей по массивам!');
        }

        if (!$st->execute()){

            die('Не удалось выполнить запрос на удаление всех записей по массивам!');
        }
                
    }
    
    public static function insert($key, $array1, $array2)
    {
        $sql = "INSERT INTO tags_and_array (key_, array1, array2) VALUES (:key, :array1, :array2)";

        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос добавление записи по массивам!');
        }
        
        $st->bindParam(':key', $key, PDO::PARAM_STR);
        $st->bindParam(':array1', $array1, PDO::PARAM_STR);
        $st->bindParam(':array2', $array2, PDO::PARAM_STR);

        if (!$st->execute()){
            die('Не удалось выполнить запрос добавление всех записеи по массивам!');
        }
        
    }
    
    public function getList()
    {
        $sql = "SELECT key_
                    , array1
                    , array2
                FROM tags_and_array
                ";
        
        $result['header'] = ["Ключ", "Массив-1", "Массив-2"];
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на получение значений массивов!');
        }
        
        
        if (!$st->execute()) {
            die('Не удалось выполнить запрос на получение значений массивов!');
        }
        
        $result['body'] = [];
        while ($row = $st->fetch(PDO::FETCH_ASSOC)){
            $result['body'][] = ['data' => $row];
        }

            
        return $result;
    }

    
}
