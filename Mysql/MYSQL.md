1, show databases   只显示有权限的
2, use              
3, 授权  GRANT ALL ON menagerie.* TO 'your_mysql_name'@'your_client_host';
4, mysql 大小写敏感, 在unix下 
5, LOAD DATA LOCAL INFILE '/path/pet.txt' INTO TABLE pet; 可以直接在文件中载入数据，单个tab分割字段，\N 代替 NULL
6, NULL  不可以和数学运算符比较 例如：>, <, <>, = 默认结果都是NULL。应该用 is nul， is not null.
7, 0 和 NULL 是false， 其他都是 true，包括‘’
8, mysql pattern eg: '%', '___'。 REGEXP: [...], [a-z], '^' , '$'
9, select database();
10, bit_or()   bit_count(); auto_increment, 
11, explain select .... //主要关注type列，优》》》差
    system>const>eq_ref>ref>ref_or_null>index_merge>unique_subquery>index_subquery>range>index>all;
官网对于优化的建议：
    1, select 查询的速度优化，针对myisam表
      装在数据后，使用 analyze table，优化俩个表链接的时候，选择哪个索引
      根据一个索引排序一个索引和数据， myisamchk --sort-index --sort-records=1(在索引1上排序)
    2, 优化where 子句
      去除多余的括号，常量重叠， 去除常量条件
    3, 删除表的数据，可以用 truncate table $table_name 比 delete 快
    4, 删除或者更新大量数据后， 做optimize table
    5, 
    
性能优化20条经验
 一， 为查询缓存优化你的查询。 
     mysql默认开启查询缓存，类似curdate(), rand(), now()函数查询缓存不支持，使用一个变量代替。
 二， explain select查询
     可以知道查询性能瓶颈，及索引主健被如何利用。
 三， 当只需要一条数据的时候，使用 limit 1
     搜索引擎在找到一条记录，停止继续查询
 四， 为搜素字段建立索引
 五， 在join表的时时候，使用相等类型的列，并将其索引。
 六， 在数据量大的时候，避免 select × 操作，
 七， 永远为每张表设置一个ID 一般就unsigned，auto_increment.
 八， 使用enum， 而不是varchar， 有限和固定的
 九， 从procedure analyse() 取得建议
 十，尽量不要使用 NULL，NULL需要额外的空间，进行比较的时候很复杂。
 十一， preparad statements, 
 十二， 把ip地址存储成 unsigned int，可以使用 inet_ntoa() 和 inet_aton() 相互转换。
 十三， 固定长度的表，会更快。
 十四， 分表，  一个表很多字段访问很少。
 十五， 拆分大的delete 和 insert 
 十六， 越小的列，会越快
 十七， 选择正确的存储引擎。 myisam : 适合一些大量查询的应用, 对写处理不好，动不动锁表，
                             InnoDB : 支持行锁，写表比较快。查询小数据量比mysiam慢，大数据相差不多，支持高级的事物等。
 十八，使用一个对象关系映射器
 十九，小心使用永久链接。
