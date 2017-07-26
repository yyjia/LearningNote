<?php
//策略模式作为一种软件设计模式，指对象有某个行为，但是在不同的场景中，该行为有不同的实现算法

interface Strategy
{
    public function action();
}

class PersonA implements Strategy
{
    public function action()
    {
        echo "do cooking\n";
    }
}

class PersonB implements Strategy
{
   public function action()
   {
       echo "do washing\n";
   }
}

class PersonC implements Strategy
{
   public function action()
   {
       echo "do dancing\n";
   }
}

class Life 
{
   public function __construct($strategy)
   {
       $this->strategy = new $strategy();
   }
  
  public function work()
  {
       $this->strategy->action();
  }
}

$mylife = new Life(new PersonC());
$mylife->work();
?>
