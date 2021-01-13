<?php

namespace Test3;

use Exception; // без этой строки PhpStorm думал что Exception это неопределенный класс

class newBase
{
    static private int $count = 0;
    static private array $arSetName = [];
    protected $property = null;
    /**
     * @param string $name
     */
    function __construct($name = 0)
    {
        if (empty($name)) {
            while (array_search(self::$count, self::$arSetName) != false) {
                ++self::$count;
            }
            $name = self::$count;
        }
        $this->name = $name;
        self::$arSetName[] = $this->name;
    }
    protected $name;
    /**
     * @return string
     */
    public function getName(): string
    {
        return '*' . $this->name  . '*';
    }
    protected $value = null;
    /**
     * @param mixed $value
     */
    public function setValue($value)
    {
        $this->value = $value;
        return $this->value;                                         // добавил return
    }
    /**
     * @return string
     */
    public function getSize()
    {
        $size = strlen(serialize($this->value));
        return (int) strlen($size) + $size;                       // преобразование возвращаемоего значения в int
    }
    public function __sleep()
    {
        return ['value'];
    }
    /**
     * @return string
     */
    public function getSave(): string
    {
        $value = serialize($this->value);                                   // $this-> на переменную value
        return $this->name . ':' . strlen($value) . ':' . $value;           // заменил sizeof() на strlen()
    }
    /**
     * @return void
     */
    static public function load($value)
    {
        $arValue = explode(':', $value);
        return (new newBase($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1]) + 1), $arValue[1]));
    }
}
class newView extends newBase
{
    private $type = null;
    private $size = 0;
    protected $property = null;
    /**
     * @param mixed $value
     */
    public function __construct($value) // создал конструктор
    {
        parent::__construct($value); // вызвал родительский конструктор
    }

    public  function setValue($value)
    {
        parent::setValue($value);
        $this->setType();
        $this->setSize();
    }
    public function setProperty($value):string
    {
        $this->property = $value;
        return $this->property;                                      // заменил $this на $this->property
    }
    private function setType()
    {
        $this->type = gettype($this->value);                         // добавил аргумент в функцию gettype
    }
    private function setSize()
    {
        if (is_subclass_of($this->value, "newView")) {
            $this->size = parent::getSize() + 1 + strlen($this->property);
        } elseif ($this->type == 'test') {
            $this->size = parent::getSize();
        } else {
            $this->size = strlen($this->value);
        }
    }
    /**
     * @return string
     */
    public function __sleep() : string                                  // добавил тип возвращаемого значения
    {
        return 'property';
    }
    /**
     * @return string
     */
    public function getName(): string
    {
        if (empty($this->name)) {
            throw new Exception('The object doesn\'t have name');
        }
        return '"' . $this->name  . '": ';
    }
    /**
     * @return string
     */
    public function getType(): string
    {
        return ' type ' . $this->type  . ';';
    }
    /**
     * @return string
     */
    public function getSize(): string
    {
        return ' size ' . $this->size . ';';
    }
    public function getInfo()
    {
        try {
            echo $this->getName()
                . $this->getType()
                . $this->getSize()
                . "\r\n";
        } catch (Exception $exc) {
            echo 'Error: ' . $exc->getMessage();
        }
    }
    /**
     * @return string
     */
    public function getSave(): string
    {
        if ($this->type == 'test') {
            $this->value = $this->value->getSave();
        }
        return parent::getSave() . serialize($this->property);
    }

    /**
     * @param $value
     * @return newView
     */
    static public function load($value)
    {
        $arValue = explode(':', $value);
        return (new newBase($arValue[0]))
            ->setValue(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1] + 1), $arValue[1])))
            ->setProperty(unserialize(substr($value, strlen($arValue[0]) + 1
                + strlen($arValue[1] + 1), $arValue[1])));
    }
}
function gettype($value)
{
    if (is_object($value)) {
        $type = get_class($value);
        do {
            if (strpos($type, "newBase") !== false) { // newBase
                return 'test';
            }
        } while ($type == get_parent_class($type));
    }
    return gettype($value);
}


$obj = new newBase('12345');
$obj->setValue('text');

$obj2 = new newView('O9876');
$obj2->setValue($obj);
$obj2->setProperty('field');
$obj2->getInfo();

$save = $obj2->getSave();

$obj3 = newView::load($save);

var_dump($obj2->getSave() == $obj3->getSave());

