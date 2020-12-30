
<?php
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
