<?php
//保证一个类仅有一个实例，并提供一个访问它的全局访问点。

//懒汉式
final class Singleton
{
    private static  $instance;

    private function __construct()
    {

    }
  
    public static function getInstance()
    {
        if( self::$instance === null )
        {
           self::$instance = new self();
        }  

        return self::$instance;
    }
}

$a = Singleton::getInstance();
$b = Singleton::getInstance();

if($a === $b)
   echo "same class a and b\n";
//饿汉式

?>
