<?php
//simplexml_load_file('__DIR__\file.xml'); // Комментируем эту строку, так как она закомментирована и не влияет на выполнение кода.

function mySortForKey($a, $b)
{
    try {
        foreach ($a as $key => $value) {
            foreach ($value as $k => $v) {
                if (!array_key_exists($b, $value)) {
                    throw new Exception($key);
                }
            }
        }
        // Сортируем массив $a по ключу $b во вложенных массивах.
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
    } catch (Exception $e) {
        echo $e->getMessage(); // Выводим сообщение об ошибке, если она произошла.
    }
}

$arr = [['a' => 1, 'b' => 6],
        ['a' => 5, 'b' => 4],
        ['a' => 4, 'b' => 7]];

mySortForKey($arr, 'b'); // Вызываем функцию сортировки массива.

echo '<br/>';

function convertString($a, $b)
{
    if (stripos($a, $b)) {
        if (strripos($a, $b) && strripos($a, $b) !== stripos($a, $b)) {
            // Заменяем первое вхождение $b в $a на $b, перевернутое задом наперед.
            $position = strripos($a, $b);
            echo substr_replace($a, strrev($b), $position, strlen($b));
        } else {
            return false; // Если условие не выполнено, возвращаем false.
        }
    } else {
        return false; // Если $b не найдено в $a, возвращаем false.
    }
}

$input = 'This is the end';
$search = 'is';
convertString($input, $search); // Вызываем функцию для преобразования строки.
?>
