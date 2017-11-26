
## Redis 持久化 ##
   - RDB：
        - 优点：
              - 文件紧凑，适用于备份数据。
              - 紧凑的单一文件，方便传送，适合灾难恢复。
              - 持久化方式可以最大化redis的性能。//通过fork子进程做io操作
              - 恢复大的数据比AOF快
        - 缺点：
              - 意外断电，或者宕机会损失 间隔的数据
              - 当数据比较大的时候，fork子进程过程很耗时，无法响应客户端。
                 AOF也需要fork子进程，但可以调节重写日志频率，提高数据集的耐久度。
   - AOF：
        - 优点:
              - redis更加耐久，可以使用不同fsync（）策略。
              - 当AOF文件体积过大时，后台可自动对文件重写。
              - AOF文件有序保存了对数据执行的所有写入操作，容易读懂，分析。
              - AOF只是进行追加日志文件。
        - 缺点：
              - 对相同数据集，AOF体积相对大于RDB体积
              - 根据使用的策略，速度可能慢于RDB，处理巨大的写入，RDB可以保证最大延迟时间。

## Redis 复制 ##
   配置：在slave配置文件加 slaveof 192.168.1.1 6379

## Redis 管理 ##
   - 安装，
       - linux ，向/etc/sysctl.conf添加vm.overcommit_memory = 1然后重启
       - 禁用Linux内核特性transparent huge pages， 过命令echo never > sys/kernel/mm/transparent_hugepage/enabled来完成。
   - 重启升级
       - 配置slave， 
       - 等待复制同步完成， 使用config set slave-read-only no，允许写slave。
       - 配置所有客户端使用新的实列
       - 确认住实列不再接受任何请求，使用 SLAVEOF NO ONE 命令切换从实例为主实例，然后关闭原先的主实例。
## Redis 安全 ##
   - 网路安全： 
       - redis.conf配置 bind 127.0.0.1//只有本地用户可以访问
       - 防护墙屏蔽redis端口
   - 常规安全设计： Redis被设计成仅有可信环境下的可信用户才可以访问。
   - 认证的特性： 开启认证授权方式， 密码尽量长。
   - 禁用或者重命名特殊命令：在redis.conf配置文件中， rename-command $command sfsdfsafs/"" //空是禁用命令
   - 控制运行redis服务器用户的权限。

**全部数据类型都可以用：exists, del, type, expire, persist, ttl**
```
string : set, get, getset, mset, mget, incr, decr, decrby, 

list : lpush, rpush, lrange, lpop, rpop, ltrim, blpop, brpop, rpoplpush, brpoplpush, llen, 

hash : hmset, hget, hgetall, hmget, 

set : sadd, scard, interset(交集), sdiff(相减)， 

sorted set: zadd, zrange, zrevrange, zremrangebyscore,  zrangebyscore, zrank, zrevrank

bitmaps: 
```
**lua 脚本**：redis.call() redis.pcall(),  redis.error_reply(), redis.status_reply()
         脚本是原子执行的
         脚本缓存 刷新命令（script flush）
         script命令 ： script flush, script exists, script load, script kill
        

**事物**: multi, exec, discard, watch, unwatch

## 内存优化技术：##
      - 内存压缩技术（特殊编码技术 ）
      - 尽可能使用散列表，hashes
      - 使用位级别和自级别操作
      - 设置maxmemory
      - 使用散列结构高效存储抽象的键值对。
## 插入大量数据 ##
      - 差： (cat data.txt; sleep 10) | nc localhost 6379 > /dev/null
      - 好： cat data.txt | redis-cli --pipe

