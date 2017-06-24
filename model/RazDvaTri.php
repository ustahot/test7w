<?php

/**
 * Description of RazDvaTri
 *
 * @author Илья
 */
class RazDvaTri
{
    public static function deleteAll()
    {
        $sql = "DELETE FROM raz_dva_tri";

        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на удаление всех записей по раз-два-три!');
        }

        if (!$st->execute()){

            die('Не удалось выполнить запрос на удаление всех записей по раз-два-три!');
        }
                
    }
    
    public static function insert($key, $value)
    {
        $sql = "INSERT INTO raz_dva_tri (key_, value_) VALUES (:key, :value)";

        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос добавление записи по раз-два-три!');
        }
        
        $st->bindParam(':key', $key, PDO::PARAM_STR);
        $st->bindParam(':value', $value, PDO::PARAM_STR);

        
        if (!$st->execute()){
            die('Не удалось выполнить запрос добавление всех записеи по раз-два-три!');
        }
        
    }
    
    public function getList()
    {
        $sql = "SELECT key_
                    , value_
                FROM raz_dva_tri
                ";
        
        $result['header'] = ["Ключ", "Значение"];
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на получение значений раз-два-три!');
        }
        
        
        if (!$st->execute()) {
            die('Не удалось выполнить запрос на получение значений раз-два-три!');
        }
        
        $result['body'] = [];
        while ($row = $st->fetch(PDO::FETCH_ASSOC)){
            $result['body'][] = ['data' => $row];
        }

            
        return $result;
    }

    
}
