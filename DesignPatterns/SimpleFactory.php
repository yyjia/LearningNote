<?php

//简单工厂模式
//简单工厂模式是由一个工厂对象决定创建出哪一种产品类的实例

abstract class Operation
{
    private $numA, $numB;
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    abstract public function getResult();
} 


class OperateAdd extends Operation
{
    public function getResult()
    {
        $res = $this->numA + $this->numB;
        return $res;
    }
}

class OperateSub extends Operation
{
    public function getResult()
    {
       return $this->numA - $this->numB;
    }
}

class SimpleFactory
{
    public static function createOperate( $op)
    {
        switch($op)
        {
            case '+':
                $operate = new OperateAdd();
                break;
            case '-':
                $operate = new OperateSub();
                break;
            default:
                break;
        }   
        return $operate; 
    }

} 

$oper = SimpleFactory::createOperate('+');
$oper->numA = 5;
$oper->numB = 10;
echo $oper->getResult();
?>
