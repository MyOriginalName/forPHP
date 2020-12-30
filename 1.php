<!DOCTYPE html>
<html lang="ru">
<head>
    <title> PHP веб сайт</title>
</head>
<body>
<?php
//------------------------------------------------Task First-----------------------------------------------------------------
echo "Task first";
echo "<br/><br/>";

function findSimple($a, $b)
{
    $arr = array();

    for($i=$a; $i <= $b; $i++)
    {
       $check = false;
       for($j=2; $j < $i && !$check; $j++)
       {
           if($i%$j == 0)
           {
               $check = true;
               break;
           }
       }
       if(!$check && $i != 1)
       {
           $arr[] = $i;
       }
    }
    return $arr;
}
$num1 = 1;
$num2 = 47;
print_r (findSimple($num1, $num2));

//------------------------------------------------Task Second-----------------------------------------------------------------
echo "<br/><br/>";
echo "Task second";
echo "<br/><br/>";


function createTrapeze($a)
{
    $arr = array();
    for($i=0; $i < count($a); $i+=3)
    {
        $arr[$i] = array(
            'a' => $a[$i],
            'b' => $a[$i+1],
            'c' => $a[$i+2]
        );
    }
    return $arr = array_values($arr);
}
print_r(createTrapeze(findSimple($num1, $num2)));

//------------------------------------------------Task Third-----------------------------------------------------------------
echo "<br/><br/>";
echo "Task third";
echo "<br/><br/>";

function squareTrapeze($a)
{
    foreach($a as $k => &$n){

        $n['s'] = (($n['a']+$n['b'])/2)*$n['c'];

    }
    return $a;
}

print_r(squareTrapeze(createTrapeze(findSimple($num1, $num2))));

//------------------------------------------------Task Fourth-----------------------------------------------------------------
echo "<br/><br/>";
echo "Task fourth";
echo "<br/><br/>";
function getSizeForLimit($a, $b)
{
    $arr = array();
    foreach($a as $k => $v)
    {
        if($v['s'] <= $b) $arr[] = $v['s'];
    }
    return $arr;
}

$b = 67.5;
print_r(getSizeForLimit(squareTrapeze(createTrapeze(findSimple($num1, $num2))), $b));

//------------------------------------------------Task fifth-----------------------------------------------------------------
echo "<br/><br/>";
echo "Task fifth";
echo "<br/><br/>";

function getMin($a)
{
    $min = $a[0];
    foreach($a as $k => $v)
    {
        if($v < $min) $min = $v;
    }
    return $min;
}

$array = array(
    8, 90, 5, 16, 29, 32, 5, 9, 2, 35
);
print_r (getMin($array));

//------------------------------------------------Task sixth-----------------------------------------------------------------
echo "<br/><br/>";
echo "Task sixth";
echo "<br/><br/>";

function printTrapeze($a)
{
    echo '<table border="5" width="50%" align="center">';
    foreach($a as $k => $v)
    {
        echo "<tr>";
        foreach($v as $key => $value)
        {
            if($key == 's' && $value%2)
            {
                echo "<td style = 'background-color: #0033FF'>$value</td>";
            } else
                echo "<td>$value</td>";
        }
        echo "</tr>"."<br/>";
    }
    echo "</table>";
}
printTrapeze(squareTrapeze(createTrapeze(findSimple($num1, $num2))));


//------------------------------------------------Task sixth-----------------------------------------------------------------
echo "<br/><br/>";
echo "Task seventh";
echo "<br/><br/>";

abstract class BaseMath
{
    function exp1($a, $b, $c)
    {
        return $a*(pow($b, $c));
    }

    function exp2($a, $b, $c)
    {
        return pow(($a/$b), $c);
    }
    abstract public function getValue();
}

class F1 extends BaseMath
{
    private $f;
    function __constructor($a, $b, $c)
    {

        $this->f = $this->exp1($a, $b, $c) + pow($this->exp2($a, $b, $c)%3, min($a, $b, $c));
    }
    function getValue()
    {
        return $this->f;
    }
}

$user = new F1(2,1,3);
echo $user->getValue();
?>
</body>
</html>