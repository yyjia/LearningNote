### 数据库范式
- **第一范式** 每个列都是不可分割的，不能包含多个值
- **第二范式** 满足第一范式前提下，每个行都可以被唯一区分。即每个表都有主键，非主属性完全依赖于主键的所有属性，
- **第三范式** 满足第二范式前提下，一个数据库表中不包含已在其他表中已包含的非主关键字信息

1. show databases   只显示有权限的
2. use              
3. 授权  GRANT ALL ON menagerie.* TO 'your_mysql_name'@'your_client_host';
4. mysql 大小写敏感, 在unix下
5. LOAD DATA LOCAL INFILE '/path/pet.txt' INTO TABLE pet; 可以直接在文件中载入数据，单个tab分割字段，\N 代替 NULL
6. NULL  不可以和数学运算符比较 例如：>, <, <>, = 默认结果都是NULL。应该用 is nul， is not null.
7. 0 和 NULL 是false， 其他都是 true，包括‘’
8. mysql pattern eg: '%', '___'。 REGEXP: [...], [a-z], '^' , '$'
9. select database();
10. bit_or()   bit_count(); auto_increment,
11. explain select .... //主要关注type列，优》》》差
```
    system>const>eq_ref>ref>ref_or_null>index_merge>unique_subquery>index_subquery>range>index>all;
```
### 官网对于优化的建议 ###
    1. select 查询的速度优化，针对myisam表
```
      装在数据后，使用 analyze table，优化俩个表链接的时候，选择哪个索引
      根据一个索引排序一个索引和数据， myisamchk --sort-index --sort-records=1(在索引1上排序)
```
    2. 优化where 子句
```
      去除多余的括号，常量重叠， 去除常量条件
```
    3. 删除表的数据，可以用 truncate table $table_name 比 delete 快
    4. 删除或者更新大量数据后， 做optimize table

### 性能优化20条经验 ###
 - 为查询缓存优化你的查询。
```
    mysql默认开启查询缓存，类似curdate(), rand(), now()函数查询缓存不支持，使用一个变量代替。
```
 -  explain select查询
```
     可以知道查询性能瓶颈，及索引主健被如何利用。
```
 -  当只需要一条数据的时候，使用 limit 1
```
     搜索引擎在找到一条记录，停止继续查询
```
 - 为搜素字段建立索引
 - 在join表的时时候，使用相等类型的列，并将其索引。
 - 在数据量大的时候，避免 select × 操作，
 - 永远为每张表设置一个ID 一般就unsigned，auto_increment.
 - 使用enum， 而不是varchar， 有限和固定的
 - 从procedure analyse() 取得建议
 - 尽量不要使用 NULL，NULL需要额外的空间，进行比较的时候很复杂。
 - preparad statements,
 - 把ip地址存储成 unsigned int，可以使用 inet_ntoa() 和 inet_aton() 相互转换。
 - 固定长度的表，会更快。
 - 分表，  一个表很多字段访问很少。
 - 拆分大的delete 和 insert
 - 越小的列，会越快
 - 选择正确的存储引擎。
   - myisam : 适合一些大量查询的应用, 对写处理不好，动不动锁表，
   - InnoDB : 支持行锁，写表比较快。查询小数据量比mysiam慢，大数据相差不多，支持高级的事物等。
 - 使用一个对象关系映射器
 - 小心使用永久链接。
### mysql索引 ###

大多数MySQL索引(PRIMARY KEY、UNIQUE、INDEX和FULLTEXT)在B树中存储。只是空间列类型的索引使用R-树，并且MEMORY表还支持hash索引。
 - 所有mysql列类型，均可以被索引

### Myisam 和 InnoDB区别 ###

![innodb features](../img/Innodb.png)

- 使用InnoDB的优势
     - InnoDB crash recover(灾难恢复)： 数据库崩溃后，重启之前不用做任何事情，自动完成崩溃之前提交的，放弃崩溃前没有提交的。
     - buffer pool : 有自己的缓冲池，缓存表和索引数据，提高访问速度。
     - set up foreign keys that enforce Referential Integrity(参照完整性)，更新和删除数据，关联表的数据自动更新。脏数据的插入，会自动失败。
     - 数据被破坏， checksum（校验和）机制，会伪造数据，在访问前
     - 每个表有一个主键，where, order by, group by自动优化，fast
     - change buffering: 行级锁，同时读写表，同时缓存修改的数据给线性给磁盘IO
     - adaptive(自适应) hash index: 对某个表的某些行被频繁访问有用。
     - 可以压缩表和索引， 删除和创建索引对性能影响小
     - Truncating file-per-table tablespace fast, 可以释放磁盘给操作系统复用，并不是只能给InnoDB使用
     - 对动态行格式数据类型高效，ex： blob， text
     - 监测存储引擎内部工作，查询 INFORMATION_SHCEMA
     - 监测存储引擎性能详情，查询 performance_Schema
     - Innodb 可以和其他存储引擎混合使用，ex： join
     - been designed cpu efficiency and maximum performance when large data volumes;
     - can handle large quantities of data

![myisam features](../img/myisam.png)

- 使用Myisam
    - 有个标记在myisam索引文件，标识表是否被正确关闭。启动的时候加 --myisam-recover-option参数，MYISAM表会自动检查/修复，当被打开的时候。
    - 支持 varchar 列类型， 一般开始1到2个字节
    - 包含 varchar 列的表，有动态行长度
    - BLOB 和 TEXT 可以被索引
    - 每个表最多64个索引， 每个列最多16个索引
    - 动态长度的行被删除或者更新的时候，跟少的碎片
    - You can put the data file and index file in different directories on different physical devices to get more speed with the DATA DIRECTORY and INDEX DIRECTORY table
    - NULL values are permitted in indexed columns

### mysql lock

