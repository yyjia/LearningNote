<?php

//静态变量仅在局部函数域中存在，但当程序执行离开此作用域时，其值并不丢失。

function test()
{
	static $count = 0;

    $count++;
    echo $count;
    if ($count < 10) {
        test();
    }
    $count--;
	echo $count;
}

test(); // 123456789109876543210

echo "\n";

// 在非静态环境下，所调用的类即为该对象实例所属的类。
class A {
    private function foo() {
        echo "success!\n";
    }
    public function test() {
        $this->foo();
        static::foo();
    }
}

class B extends A {
	
}

class C extends A {
	private function foo(); // error
}

$b = new B();
$b->test();
//$c = new C();
//$c->test();
?>
