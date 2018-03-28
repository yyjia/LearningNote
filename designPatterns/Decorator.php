<?php
  /**
   * 接口
   */
  interface Shape
  {
    public function draw();
  }


  /**
   * 具体实现类 圆
   */
  class Circle implements Shape
  {

    function __construct()
    {
      # code...
    }

    public function draw()
    {
      echo "draw a circle ! \n";
    }
  }

  /**
   * 具体实现类 方框
   */
  class Rectangle implements Shape
  {

    function __construct()
    {
      # code...
    }

    public function draw ()
    {
      echo "draw a Rectangle! \n";
    }
  }

  /**
   * 抽象装饰器类
   */
  abstract class ShapeDecorator implements Shape
  {
    protected $shape;

    function __construct(Shape $shape)
    {
      $this->shape = $shape;
    }

    public function draw()
    {
      $this->shape->draw();
    }
  }

  /**
   * 装饰器的实现类
   */
  class RedShapeDecorator extends ShapeDecorator
  {

    public function draw()
    {
      $this->shape->draw();
      $this->setColor();
    }

    protected function setColor()
    {
      echo "set the color red ! \n";
    }
  }

  $circle = new Circle();
  $rectangle = new Rectangle();
  $circle->draw();
  $rectangle->draw();

  $circleDec = new RedShapeDecorator(new Circle());
  $rectangleDec = new RedShapeDecorator(new Rectangle());

  $circleDec->draw();
  $rectangleDec->draw();
?>
