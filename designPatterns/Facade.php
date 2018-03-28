<?php

/**
 * 它向现有的系统添加一个接口，来隐藏系统的复杂性。
 *
 */
interface Shape
{
  public function draw();
}

class Circle implements Shape
{
  public function draw()
  {
    echo "draw a circle ! \n";
  }
}

class Square implements Shape
{
  public function draw()
  {
    echo "draw a square ! \n";
  }
}

class Facade
{
  protected $circle;

  public function __construct(Shape $shape)
  {
      $this->shape = $shape;
  }

}

 ?>
