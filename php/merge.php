<?php

$arrA = ['one' => 'a', 'two' => 'b', 3 => 'three', 4 => 8];
$arrB = ['one' => 'c',  'hello' => 'world', 4 => 10, 3 => 'ten', '3'=>'ggg'];

$arrC = $arrA + $arrB;

var_dump($arrC);
echo "============================\n";
$arrD = array_merge($arrA, $arrB);

var_dump($arrD);
//array(5) {
//  ["one"]=>
//  string(1) "a"
//  ["two"]=>
//  string(1) "b"
//  [3]=>
//  string(5) "three"
//  [4]=>
//  int(8)
//  ["hello"]=>
//  string(5) "world"
//}
//============================
//array(7) {
//  ["one"]=>
//  string(1) "c"
//  ["two"]=>
//  string(1) "b"
//  [0]=>
//  string(5) "three"
//  [1]=>
//  int(8)
//  ["hello"]=>
//  string(5) "world"
//  [2]=>
//  int(10)
//  [3]=>
//  string(3) "ten"
//}
//
?>
