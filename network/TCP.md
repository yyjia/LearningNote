### 三次握手
   同步双方的序列号和确认号，并交换tcp的窗口大小
   1. 客户端向服务端发送一个包含 初始序列号x + 窗口大小 的tcp报文
   2. 服务器接到报文后， 回复一个 初始序列号y + 确认客户端序列号x+1 + 窗口大小 tcp报文
   3. 客户端接受到服务端报文后， 发送 确认序列号y+1 + 序列号x+1 报文

   **注意**： 三次握手而不是俩次握手主要为了防止已经过期连接再次传到被连接的主机。
       如果俩次握手可能导致死锁。
## tcp 和 udp 区别


### 四次挥手
    1.  A端发起断开连接，A关闭向B发送数据
    2.  B回复A，停止接受A端数据
    3.  B发送A  停止向A发送数据
    4.  A回复B  关闭接受A的数据

### 完整的http请求
但我们在浏览器输入一个地址的时候，发生的事情
域名解析->发起tcp3次握手->建立连接后发起http请求->服务器响应http请求，浏览器得到html代码->浏览器解析html代码,并请求html代码中的资源(js, css, imge)->浏览器对页面进行渲染呈现给用户
- 域名解析
 - 浏览器自身DNS缓存
 - 操作系统自身的DNS缓存
 - hosts文件
 - DNS系统调用(运营商提供的)
- 发起TCP三次握手，建立连接
- 发起http请求
- 响应http请求，返回html代码
- 解析html代码，请求资源
- 页面渲染，呈现

### Nginx

1. nginx 的负载均衡实现方式
 - round-robin 默认,轮询/权重轮询
 - least-connected,最少连接数/权重最少连接
 - ip-hash,用户ip哈希

2. Nginx, CGI, FastCgi, php-fpm之间的关系
  - CGI 是什么？
    - CGI是协议，保证web server(Nginx)传递过来的数据是标准格式。
    - （每个请求）server接到动态文件 启动/交给cgi解释器（php-cgi）
      1. cgi会解析php.ini
      2. 初始化执行环境，
      3. 执行请求，
      4. 返回cgi格式数据给server，
      5. 退出进程。
  - FastCgi 是什么？
    - FastCgi是用来提高CGI程序性能的，也是协议
      1. FastCgi启动一个master，解析php.ini文件，初始化执行环境，
      然后在启动多个worker
      2. 接到请求，master传递给一个worker处理。master可以接受下一个请求。master根据配置预先启动多个worker等着，多余的worker可以停掉。避免每次重启cgi，节省时间，提高性能。
 - php-fpm 是什么？
    - 是实现了FastCgi的程序
    - php-cgi是php的解释器，只是一个cgi程序，本身只能解析请求，返回结果，不会进程管理。php-fpm就是可以调度php-cgi进程的程序。
