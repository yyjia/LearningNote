<?php
abstract class Subject
{
    private $observers = [];
    public function attach($observer)
    {
        $this->observers[] = $observer;
    }

    public function detach($observer)
    {
        foreach( $this->observers as $value)
        {
            if($value != $observer)
            {
               $this->observers[] = $value;
               break;
            }
        }
    }

   public function notify()
   {
       foreach($this->observers as $observer)
       {
           $observer->update();
       }
   }
}

abstract class Observer
{
    public abstract function update();
}

class ConcreteSubject extends Subject
{
    public function __set($name, $value)
    {
        $this->$name = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }
}

class ConcreteObserver extends Observer
{
    public function __construct($subject, $name)
    {
        $this->subject = $subject;
        $this->name    = $name;
    }

    public function __set($name, $value)
    {
       $this->$name = $value;
    }

    public function __get($name)
    {
       return $this->$name;
    }

    public function update()
    {
        $this->observerState = $this->subject->subjectState;
        var_dump("Observer:" . $this->name . " state is:" . $this->observerState);
    }
}

$a = new ConcreteSubject();
$a->attach(new ConcreteObserver($a , 'X'));
$a->attach(new ConcreteObserver($a , 'Y'));
$a->attach(new ConcreteObserver($a , 'Z'));
$a->subjectState = 'ABC';
$a->notify();
?>
