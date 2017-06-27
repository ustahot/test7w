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
class Million
{

    public function getListRandom()
    {
        
        $result['header'] = ["Чисел, имющих повторы"];
        
        $result['body'][] = ['data' => ['item_value' => self::findRep()]];
            
        return $result;
    }

    
    public static function gen()
    {
        for ($i = 1; $i <= 1000000; $i ++){
            $result[] = random_int(100000, 1500000);
        }
        return $result;
    }
    
    
    public static function findRep()
    {
        $array = self::gen();
        
        foreach ($array as $value){
            
            if (isset($newArray[$value])){
                $newArray[$value] = $newArray[$value] + 1;
            } else {
                $newArray[$value] = 1;
            }
        }
        
        arsort($newArray);
        $qtyRep = 0;
        foreach ($newArray as $key => $value){
            if ($value < 2){
                break;
            }
            $qtyRep ++;
        }
        
        return $qtyRep;
    }

}
