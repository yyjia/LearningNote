<?php
/**
 * 中介者模式， 用一个中介者对象来封装一系列对象之间的交互
 * 中介者使各个对象之间不需要显示的引用，从而可以松散的耦合
 *  而其可以独立的改变他们之间的交互
 */
interface MediatorInterface
{
  public function declared(string $message,Colleague $colleague);
}

/**
 * 中介者类
 */
class MediatorUnit implements MediatorInterface
{
  private $colleagueUsa;
  private $colleagueChina;

  public function setUsaCountry(Colleague $colleague)
  {
      $this->colleagueUsa = $colleague;
  }

  public function setChinaCountry(Colleague $colleague)
  {
      $this->colleagueChina = $colleague;
  }

  public function declared(string $message, Colleague $colleague)
  {
    if ($colleague == $this->colleagueUsa) {
      $this->colleagueChina->getMessage($message);
    }

    if ($colleague == $this->colleagueChina) {
      $this->colleagueUsa->getMessage($message);
    }
  }
}

abstract class Colleague
{
  private $mediator;

  public function setMediator(MediatorInterface $mediator)
  {
    $this->mediator = $mediator;
  }

  public function declared($message)
  {
    $this->mediator->declared($message, $this);
  }
}

/**
 * colleague china
 */
class ChinaColleague extends Colleague
{
  public function getMessage($message)
  {
    echo "use says : ".$message;
  }
}

/**
 * colleague usa
 */
class UsaColleague extends Colleague
{
  public function getMessage($message)
  {
    echo "china says :".$message;
  }
}


$unit = new MediatorUnit();
$china = new ChinaColleague();
$usa = new UsaColleague();

$unit->setUsaCountry($usa);
$unit->setChinaCountry($china);

$china->setMediator($unit);
$usa->setMediator($unit);

$usa->declared("hello i am usa \n");
$china->declared("hello i am china \n");
?>
