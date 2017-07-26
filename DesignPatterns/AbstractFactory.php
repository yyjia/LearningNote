<?php
// 抽象工厂

abstract class Fruit
{
// 
}

abstract class Vegetable
{
//
}

class NorthFruit extends Fruit
{
    public function __construct()
    {
        echo "i am a " . __CLASS__ . "\n";
    }
}

class NorthVegetable extends Vegetable
{

    public function __construct()
    {
        echo "i am a " . __CLASS__ . "\n";
    }
}

class SouthFruit extends Fruit
{
    public function __construct()
    {
        echo "i am a " . __CLASS__ . "\n";
    }
}

class SouthVegetable extends Vegetable
{
    public function __construct()
    {
        echo "i am a " . __CLASS__ . "\n";
    }
}

abstract class Factory{}

class NorthFactory extends Factory
{
    public function createNorthFruit()
    {
       return new NorthFruit();
    }

    public function createNorthVegetable()
    {
       return new NorthVegetable();
    }
}

class SourthFactory extends Factory
{
    public function createSourthFruit()
    {
        return new SourthFruit();
    }

    public function createSourthVegetable()
    {
        return new SourthVegetable();
    }
}

$a = new NorthFactory();
$a->createNorthFruit();
?>
