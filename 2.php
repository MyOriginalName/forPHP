
<?php
    function mySortForKey($a, $b)
    {
        try {
           foreach($a as $key => $value)
            {
                foreach($value as $k => $v)
                {
                    if(!array_key_exists($b,$value))
                    {
                        throw new Exception (array_search(next($value), $value));
                    }
                }
            }
            usort($a, function ($x, $y) use ($b) {
                if ($x[$b] > $y[$b]) {
                    return true;
                } else if ($x[$b] < $y[$b]) {
                    return false;
                } else {
                    return 0;
                }
            });
            print_r($a);
        } catch(Exception $e)
        {
            echo $e->getMessage();
        }
    }

    $arr = [['a' => 1, 'b' => 6],
            ['a' => 5, 'b' => 4],
            ['a' => 4, 'b' => 7]];

    mySortForKey($arr, 'b');


    function  convertString($a, $b)
        {
            if(stripos($a, $b))
            {
                if(strripos($a, $b) && strripos($a, $b) !== stripos($a, $b))
                {

                   // echo str_replace($b,strrev($b), $a);
                    $position = strripos($a, $b);
                    echo substr_replace($a, strrev($b), $position, strlen($b));
                }
                else return false;
            } else return false;
        }

        $input = 'This is the end';
        $search = 'is';
        convertString($input,$search);
