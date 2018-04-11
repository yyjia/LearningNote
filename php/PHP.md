1. 比较 [array_merge](merge.php) 和 + 的区别。

>	** array_merge() ** :
>		将一个或多个数组的单元合并起来，一个数组中的值附加在前一个数组的后面。返回作为结果的数组。
>		如果输入的数组中有相同的字符串键名，则该键名后面的值将覆盖前一个值。然而，如果数组包含数字键名，
>		后面的值将不会覆盖原来的值，而是附加到后面。如果只给了一个数组并且该数组是数字索引的，则键名会以连续方式重新索引。</br>
>	** "+" ** :
>	    当键名相同的时候（包括字符串和数字键名）， 前面的会覆盖后面的。不相同的会附加到后面

注意： 数字键名 3 和 ‘3’ 可以认为他们相同。

3. static 在 php中的使用

   static 关键字来定义静态方法和属性。static 也可用于定义静态变量以及后期静态绑定, ****静态声明是在编译时解析的****  。

   *** self:: 或者 \__CLASS\__ *** 使用 self:: 或者 \__CLASS\__ 对当前类的静态引用，取决于定义当前方法所在的类  

   *** parent ***
   - 定义静态方法和属性    
   - 定义静态变量
   - 后期静态绑定

1. php 发送HTTP请求的方式
  - cURL
  - stream 流的方式
    ```php
    <?php
        $data = array("uid" => $userid, "coin" => $stamps, "sign" => $sign, "type" => 'vip_act_chaihongbao');
        $data = http_build_query($data);
        $opts = array(
            'http' => array(
                'method'  => "POST",
                'header'  => "Content-type: application/x-www-form-urlencoded\r\nContent-length:" . strlen($data) . "\r\n",
                'content' => $data,
            )
        );
        $context = stream_context_create($opts);
        $result = file_get_contents("http://api.example.com/user/addCoin", false, $context);
        $result = json_decode($result, true);
        if (isset($result['ret']) && $result['ret'] == 0) {
            return true;
        }
    ?>
    ```
  - socket 方式
    ```php
    <?php
        $fp = fsockopen("www.example.com", 80, $errno, $errstr, 30);
        if (!$fp) {
            echo "$errstr ($errno)<br />\n";
        } else {
            $out = "GET / HTTP/1.1\r\n";
            $out .= "Host: www.example.com\r\n";
            $out .= "Connection: Close\r\n\r\n";
            fwrite($fp, $out);
            while (!feof($fp)) {
                echo fgets($fp, 128);
            }
            fclose($fp);
        }
    ?>
    ```
    [小谈博客](https://blog.tanteng.me/)
## PSR-4
## PSR-7
## PSR-11
## PSR-15
