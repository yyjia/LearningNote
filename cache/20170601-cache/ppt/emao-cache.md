title: 一猫缓存的若干使用姿势
speaker: 周邦军
url: https://github.com/ksky521/nodePPT
transition: cards
files: /css/catalog.css


[slide data-transition="newspaper"]

# 一猫缓存的若干使用姿势
## 演讲者：周邦军
### 2017-05-31

[slide data-transition="move"]
##目录
+ 缓存在网站架构演进的使用
+ WEB缓存介绍
+ 一猫使用了哪些缓存
+ 缓存的使用介绍
+ 使用缓存遇到的问题
+ FAQ

[slide]
+ <p class="catalog">缓存在网站架构演进的使用
+ WEB缓存介绍
+ 一猫使用了哪些缓存
+ 缓存的使用介绍
+ 使用缓存遇到的问题
+ FAQ

[slide]
+ 初始阶段 {:&.moveIn}
<img src='/img/architectureEvolutionChart/1.png'>


[slide]
+ 应用服务和数据服务分离
<img src='/img/architectureEvolutionChart/2.png'>


[slide]
+ 使用缓存
<img src='/img/architectureEvolutionChart/3.png'>

[slide]
+ 应用服务器集群
<img src='/img/architectureEvolutionChart/4.png'>

[slide]
+ 数据库读写分离
<img src='/img/architectureEvolutionChart/5.png'>

[slide]
+ 使用反向代理
<img src='/img/architectureEvolutionChart/6.png'>

[slide]
+ 使用CDN
<img src='/img/architectureEvolutionChart/7.png'>

[slide]
+ 一猫网站架构
<img src='/img/architectureEvolutionChart/emao.png'>

[slide]
+ 缓存在网站架构演进的使用
+ <p class="catalog">WEB缓存介绍
+ 一猫使用了哪些缓存
+ 缓存的使用介绍
+ 使用缓存遇到的问题
+ FAQ

[slide]
+ web缓存是什么
    + Web缓存是指一个Web资源（如html页面，图片，js，数据等）存在于Web服务器和客户端（浏览器）之间的副本。 {:&.moveIn}

[slide]
+ web缓存的优点
    + 减少网络延迟，加快页面打开速度 {:&.moveIn}
    + 减少网络带宽消耗
    + 降低服务器压力

[slide]
+ web缓存的类型
	+ 浏览器缓存 {:&.moveIn}
	+ CDN缓存
	+ 代理服务器缓存，如Varnish、Squid、Nginx
	+ 应用层缓存
	+ 数据库缓存，如Redis、Memcached

[slide]
+ 各层缓存简介
<img src='/img/httpCache/cache_level.png'>

[slide]
+ 缓存在网站架构演进的使用
+ WEB缓存介绍
+ <p class="catalog">一猫使用了哪些缓存
+ 缓存的使用介绍
+ 使用缓存遇到的问题
+ FAQ

[slide]
<img src='/img/architectureEvolutionChart/emao_cache.png'>

[slide]
+ 一个完整的用户请求
<img src='/img/architectureEvolutionChart/user_request.png'>

[slide]
+ 缓存在网站架构演进的使用
+ WEB缓存介绍
+ 一猫使用了哪些缓存
+ <p class="catalog">缓存的使用介绍
+ 使用缓存遇到的问题
+ FAQ

[slide]
## 浏览器缓存
+ 浏览器缓存机制
    + 根据HTTP协议定义的缓存机制进行缓存。

 [slide]
## HTTP协议中与缓存控制相关字段
+ 通用首部字段 {:&.moveIn}
<div>
    <img src='/img/httpCache/general_header.jpg'>
</div>

+ 请求首部字段
<div>
    <img src='/img/httpCache/request_header.jpg'>
</div>
+ 响应首部字段
<div>
    <img src='/img/httpCache/response_header.jpg'>
</div>

+ 实体首部字段
<div>
    <img src='/img/httpCache/entry_header.jpg'>
</div>

[slide]
## Cache-Control
+ 作为请求首部时，cache-directive 的可选值有 {:&.moveIn}
<img src='/img/httpCache/cc_request_header.jpg'>

[slide]
+ 作为响应首部时，cache-directive 的可选值有
<img src='/img/httpCache/cc_response_header.jpg'>

[slide]
## 缓存校验字段
+ Last-Modified {:&.moveIn}
	+ If-Modified-Since: Last-Modified-value
	+ If-unmodified-Since: Last-Modified-value
+ Etag
    + If-None-Match: Etag-value
    + If-Match: Etag-value

[slide]
+ 缓存头部对比
<img src='/img/httpCache/diff_cache_header.png'>

[slide]
+ 用户操作行为对缓存的影响
<img src='/img/httpCache/user_action_cache.png'>

+ 强制刷新 – 当按下ctrl+F5来刷新页面的时候, 浏览器将绕过各种缓存(本地缓存和协商缓存), 直接让服务器返回最新的资源;
+ 普通刷新 – 当按下F5来刷新页面的时候,浏览器将绕过本地缓蹲来发送请求到服务器, 此时, 协商缓存是有效的
+ 回车或转向 – 当在地址栏上输入回车或者按下跳转按钮的时候, 所有缓存都生效

[slide]
##浏览器请求与缓存
+ 首次请求 {:&.moveIn}
<div>
    <img src='/img/httpCache/browser_first_request.png'>
</div>

[slide]
+ 再次请求
<div>
    <img src='/img/httpCache/browser_request_again.png'>
</div>

[slide]
#CDN缓存

+ CDN是什么 {:&.moveIn}
    + CDN的全称是Content Delivery Network，即内容分发网络。

+ CDN的优点
    + 优化跨ISP网络访问速度
    + 安全防护
	
[slide]
# CDN工作原理
+ 使用CDN的网站访问 {:&.moveIn}
<img src='/img/cdn/aliyun_cdn_workflow.png'>

[slide]
+ 阿里云的CDN节点分布
<img src='/img/cdn/aliyun_cdn_node.jpg'>

[slide]
+ 阿里云CDN默认的缓存策略
<img src='/img/cdn/aliyun_cdn_default_cache_strategy.png'>

[slide]
+ 阿里云CDN默认的缓存时间
<img src='/img/cdn/aliyun_cdn_default_cache_time.png'>


[slide]
#Varnish缓存
+ Varnish是什么
    + Varnish是一款高性能且开源的反向代理服务器和HTTP缓存加速器。

[slide]
+ 常见反向代理服务器对比
<img src="/img/reverseProxyServer/reverse_proxy_server_vs.png">

[slide]
+ 安装与启动
    + CentOS: yum install varnish {:$.moveIn}
    + /etc/init.d/varnish {start|stop|restart}
    + /etc/init.d/varnishnsca {start|stop|restart}

[slide]
+ 配置
    + /etc/sysconfig/varnish
    + /etc/varnish/default.vcl
[slide]
## 一猫Varnish的配置
+ 定义后端服务器
<img src="/img/reverseProxyServer/backend_02.png">

[slide]
+ 定义轮询规则
<div>
    <img src="/img/reverseProxyServer/round-robin.png">
</div>

[slide]
+ 定义处理请求规则
<div>
    <img src="/img/reverseProxyServer/vcl_recv.png">
</div>

[slide]
+ 强制缓存与日志记录
<img src="/img/reverseProxyServer/vcl_fetch.png">

[slide]
+ Varnish解决了我们的哪些问题
	+ 分流 {:&.moveIn}
	+ 强制缓存
	+ 清除cookies

[slide]
### Varnish的缓存（存储）方式
+ **malloc**
+ **file**
+ persistent (experimental)
+ transient storage

[slide]
+ Varnish的默认缓存策略

+ Varnish的默认缓存时间

[slide]
###应用层缓存
+ 模版缓存
+ 静态化
+ opcode cache
+ realpath cache

[slide]
#数据库缓存
+ redis
    + Redis 是完全开源免费的，遵守BSD协议，是一个高性能的key-value数据库。
+ memcached
    + 一个高性能的分布式内存对象缓存系统，用于动态Web应用以减轻数据库负载。

[slide]
### Redis
+ 安装
    + yum install redis
+ 简单使用
    + 连接：redis-cli -h ip -p port
    + 存储：echo 'key value' | redis-cli -h ip -p port
    + 获取：echo 'get key' | redis-cli -h ip -p port

[slide]
## 一猫Redis架构
+ 架构模式
    + 主从架构
    + 哨兵机制

[slide]
+ Redis架构图
<img src='/img/architectureEvolutionChart/redis.png'>

[slide]
###Memcached
+ 安装
    + yum install memcached

[slide]
## 一猫是这么使用的
+ 哪些业务使用到
    + 图片服务

[slide]
+ 缓存在网站架构演进的使用
+ WEB缓存介绍
+ 一猫使用了哪些缓存
+ 缓存的使用介绍
+ <p class="catalog">使用缓存遇到的问题
+ FAQ

[slide]
+ CDN缓存问题
    + 代码上线后未能及时刷新CDN，导致客户端看不到更新后的效果。
+ varnish缓存问题
    + 部分域名经过了CDN后又经过了Varnish，需要先刷新Varnish，再刷新CDN
+ realpath缓存问题
    + 代码上线后会切换代码目录的软连接（即改变了代码实际所在的运行目录），导致代码不生效


[slide]
+ 缓存在网站架构演进的使用
+ WEB缓存介绍
+ 一猫使用了哪些缓存
+ 缓存的使用介绍
+ 使用缓存遇到的问题
+ <p class="catalog">FAQ

[slide]
1. 代码上线成功但页面上看不到效果如何处理？
2. 什么时候需要刷新varnish？


[slide]
+ 网站架构参考文档
    1. http://www.jianshu.com/p/ed144a7185e2
    2. http://itindex.net/detail/36828-%E9%97%A8%E6%88%B7%E7%BD%91%E7%AB%99-%E6%9E%B6%E6%9E%84-%E5%88%86%E6%9E%90
    3. http://www.imooc.com/article/17545
    4. http://www.jcodecraeer.com/a/chengxusheji/chengxuyuan/2016/0121/3899.html

[slide]
+ HTTP缓存参考文档
	1. https://developers.google.com/web/fundamentals/performance/optimizing-content-efficiency/http-caching?hl=zh-cn
	2. http://imweb.io/topic/5795dcb6fb312541492eda8c
	3. https://www.fir3net.com/Networking/Protocols/http-caching-http-1-0-vs-http-1-1.html
	4. https://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.32
	5. http://stackoverflow.com/questions/1046966/whats-the-difference-between-cache-control-max-age-0-and-no-cache
	6. https://developer.mozilla.org/en-US/docs/Web/HTTP/Headers
    7. http://www.jianshu.com/p/52d86558ca57
    8. http://www.alloyteam.com/2016/07/httphttp2-0spdyhttps-reading-this-is-enough/

[slide]
+ CDN参考文档
	1. https://help.aliyun.com/document_detail/27101.html?spm=5176.product27099.6.539.XjURvL
	2. https://help.aliyun.com/document_detail/27136.html?spm=5176.doc34999.6.576.Qmt6z6
	3. https://help.aliyun.com/knowledge_detail/47580.html

+ varnish参考文档
	1. http://www.varnish-cache.org/docs/trunk/users-guide/storage-backends.html
    2. https://sites.google.com/site/shuzhifeng/varnish-wen-jian-huan-chong-de-shi-xian
    3. https://fournines.wordpress.com/2011/12/02/improving-page-speed-cdn-vs-squid-varnish-nginx/
    4. http://www.361way.com/varnish-grace-saint-mode/2929.html

[slide]
+ smarty缓存参考文档
	1. http://www.cnblogs.com/-run/archive/2012/06/04/2532801.html
    2. http://blog.unvs.cn/archives/php-smarty-cached-method.html
+ OpCode Cache参考文档:
    1. https://support.cloud.engineyard.com/hc/en-us/articles/205411888-PHP-Performance-I-Everything-You-Need-to-Know-About-OpCode-Caches
    2. https://blog.linuxeye.cn/361.html
+ realpath cache参考文档:
    1. https://www.zhuyanbin.com/?p=196

