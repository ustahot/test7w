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
        
        $st->bindParam(':id', $id, PDO::PARAM_INT);

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
        
        if (!$st = $db->prepare($sql)){
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
                    , c.name selfname
                    , c.parent
                    , p.name parentname
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

    
    public static function randomFill()
    {
        
        $asciiMin = 65;
        $asciiMax = 90;
        $rootLen = random_int(10, 30);
        
        for ($currentRootPoint = 1; $currentRootPoint <= $rootLen; $currentRootPoint ++){

            $deep = random_int(0, 5);
            
            $parentId = null;
            $parentId[0] = null;
            
            for ($currentDeep = 0; $currentDeep < $deep; $currentDeep ++){

                $pointQuantity = random_int(0, 5);
                
                for ($currentPoint = 1; $currentPoint <= $pointQuantity; $currentPoint ++){
                    $nameLen = random_int(1, 4);
                    $name = '';

                    for ($currentCharPos = 1; $currentCharPos <= $nameLen; $currentCharPos ++){
                        $name = $name . chr(random_int($asciiMin, $asciiMax));
                    }

                    $point = new RandomSQL;

                    $point->setName($name);
                    $point->setParent($parentId[$currentDeep]);

                    $point->insert();
                    $parentId[$currentDeep + 1] = $point->getId();
                }

            }
            
        }

    }
    
    public function getTree()
    {
        /*$sql = "SELECT if(level1.name IS NULL, root.name, '|') root
                    , if(level2.name IS NULL, CONCAT('--', level1.name), '|') level1
                    , if(level3.name IS NULL, CONCAT('--', level2.name), '|') level2
                    , if(level4.name IS NULL, CONCAT('--', level3.name), '|') level3
                    , if(level5.name IS NULL, CONCAT('--', level4.name), '|') level4
                    , level5.name level5
                    
                FROM random_sql root
                    LEFT OUTER JOIN random_sql level1 ON root.id = level1.parent
                        LEFT OUTER JOIN random_sql level2 ON level1.id = level2.parent
                            LEFT OUTER JOIN random_sql level3 ON level2.id = level3.parent
                                LEFT OUTER JOIN random_sql level4 ON level3.id = level4.parent
                                    LEFT OUTER JOIN random_sql level5 ON level4.id = level5.parent
                ORDER BY root.id
                        , level1.id
                        , level2.id
                        , level3.id
                        , level4.id
                        , level5.id
                ";*/
        
        $sql = "SELECT l0.name l0
                    , l1.name l1
                    , l2.name l2
                    , l3.name l3
                    , l4.name l4
                    , l5.name l5

                FROM random_sql l0
                    LEFT OUTER JOIN random_sql l1 ON l0.id = l1.parent
                        LEFT OUTER JOIN random_sql l2 ON l1.id = l2.parent
                            LEFT OUTER JOIN random_sql l3 ON l2.id = l3.parent
                                LEFT OUTER JOIN random_sql l4 ON l3.id = l4.parent
                                    LEFT OUTER JOIN random_sql l5 ON l4.id = l5.parent

                WHERE l0.parent IS NULL
                ORDER BY l0.id
                        , l1.id
                        , l2.id
                        , l3.id
                        , l4.id
                        , l5.id

                ";

        
        $result['header'] = ["Корень", "1-я степень", "2-я степень", "3-я степень", "4-я степень", "5-я степень"];
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на получение дерева!');
        }
        
        
        if (!$st->execute()) {
            die('Не удалось выполнить запрос на получение дерева!');
        }
        
        $result['body'] = [];
        while ($row = $st->fetch(PDO::FETCH_ASSOC)){
            $result['body'][] = ['data' => $row];
        }
        
        $tranzit = $st->fetchall(PDO::FETCH_ASSOC);
        
        
        return $result;
    }


    public function getDescendants()
    {
        $sql = "SELECT DISTINCT root.id, root.name, root.parent
                  FROM random_sql root
                    INNER JOIN random_sql level1 ON root.id = level1.parent
                        INNER JOIN random_sql level2 ON level1.id = level2.parent
                            INNER JOIN random_sql level3 ON level2.id = level3.parent
                  WHERE root.parent IS NULL
                ";
        
        $result['header'] = ["Id", "Имя", "Родитель"];
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на получение потомков!');
        }
        
        
        if (!$st->execute()) {
            die('Не удалось выполнить запрос на получение потомков!');
        }
        
        $result['body'] = [];
        while ($row = $st->fetch(PDO::FETCH_ASSOC)){
            $result['body'][] = ['data' => $row];
        }

            
        return $result;
        
    }

   
    public function getParents()
    {
        $sql = "SELECT DISTINCT level.id, level.name, level.parent
                FROM random_sql level
                  INNER JOIN random_sql parent1 ON level.parent = parent1.id
                      INNER JOIN random_sql parent2 ON parent1.parent = parent2.id
                WHERE level.id NOT IN (
                                        SELECT IFNULL(d.parent, 0)
                                        FROM random_sql d
                                      )
                ";
        
        $result['header'] = ["Id", "Имя", "Потомок"];
        
        if (!$st = Cfg::getDB()->prepare($sql)){
            die('Не удалось подготовить запрос на получение родителей!');
        }
        
        
        if (!$st->execute()) {
            die('Не удалось выполнить запрос на получение родителей!');
        }
        
        $result['body'] = [];
        while ($row = $st->fetch(PDO::FETCH_ASSOC)){
            $result['body'][] = ['data' => $row];
        }

            
        return $result;
    }
        
}
