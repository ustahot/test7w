<?php

/**
 * Description of RazDvaTri
 *
 * @author Илья
 */
class RandomSQL
{
    
    private $id;
    private $name;
    private $parent;

    
    public function setId($id)
    {
        $this->id = $id;
        
        $sql = 'SELECT id, name, parent FROM random_sql WHERE id = :id';
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на получение точки дерева по Id!');
        }

        if (!$st->execute()){

            die('Не удалось выполнить запрос на получение точки дерева по Id!');
        }
        
        if (!$row = $st->fetch(PDO::FETCH_ASSOC)){
            die('Не удалось точку дерева по указанному Id!');
        }
        
        $this->setName($row['name']);
        $this->setParent($row['parent']);
        
    }
    
    public function getId()
    {
        return $this->id;
    }


    public function setName($name)
    {
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }

    
    public function setParent($parent)
    {
        $this->parent = $parent;
    }
    
    public function getParent()
    {
        return $this->parent;
    }

    
    public static function deleteAll()
    {
        $sql = "DELETE FROM random_sql";

        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на удаление всех записей по random!');
        }

        if (!$st->execute()){

            die('Не удалось выполнить запрос на удаление всех записей по random!');
        }
                
    }
    
    public function insert()
    {
        $sql = "INSERT INTO random_sql (name, parent) VALUES (:name, :parent)";
        
        $db = Cfg::getDB();
        
        if (!$st = $this->prepare($sql)){
            die('Не удалось подготовить запрос добавление записи по random!');
        }
        
        $st->bindParam(':name', $this->getName(), PDO::PARAM_STR);
        $st->bindParam(':parent', $this->getParent(), PDO::PARAM_INT);

        
        if (!$st->execute()){
            die('Не удалось выполнить запрос добавление всех записеи по random!');
        }
        
        $this->setId($db->lastInsertId());
        
    }
    
    public function getList()
    {
        $sql = "SELECT c.id
                    , c.name
                    , c.parent
                    , p.name
                FROM random_sql c
                    LEFT OUTER JOIN random_sql p ON c.parent = p.id
                ";
        
        $result['header'] = ["Id", "Имя", "Id родителя", "Имя родителя"];
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на получение значений random!');
        }
        
        
        if (!$st->execute()) {
            die('Не удалось выполнить запрос на получение значений random!');
        }
        
        $result['body'] = [];
        while ($row = $st->fetch(PDO::FETCH_ASSOC)){
            $result['body'][] = ['data' => $row];
        }

            
        return $result;
    }

    
    public static function fill()
    {
        $treeLen = rand(10, 30);
        
        for ($currentPoint = 1; $currentPoint <= $treeLen; $currentPoint ++){
            $deep = rand(0, 5);ffffffffffffffffffffff
            
            /*$currentParentId = 
            
            for ($currentDeep = 1; $currentDeep < $deep; $currentDeep ++)
            */
        }
    }
        
}
