1. 应用服务器负载均衡
  A，链路负载均衡  dns
  B，软件负载均衡  lvs
  C，硬件负载均衡  cdn

2. 图片服务器分离
  A，图片单独存放在一个服务器

3. 尽量使用缓存，

4. 能使用静态页面的，多使用静态页面，减少容器的解析

5. 优化数据库查询语句
   少用select × ，in not in 尽量使用join替换，where 少用 !=, <> 会导致索引放弃使用
   分库，分表
   读写分离

6. 分布式部署
   把不同的应用部署在不同的服务器，应用相关的统一调度机制，调度所有的应用程序。

### 示例 ###

- 添加一个列
```sql
	alter table tob_electronic_certificate add column mail_send tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态：0-未发过邮件，1-已发过邮件';

	alter table tob_electronic_certificate modify column mail_send tinyint(2) unsigned NOT NULL DEFAULT '0' COMMENT '状态：0-未发过邮件，1- 已发过邮件';
```

## MySQL 分页的优化
> select * from product limit start, count
limit语句的查询时间与起始记录的位置成正比。
mysql的limit语句是很方便，但是对记录很多的表并不适合直接使用。
可以优化方案
> SELECT * FROM product 
WHERE ID > =(select id from product limit 866613, 1) limit 20