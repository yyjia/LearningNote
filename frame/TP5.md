一， 基础
 1, app ->application
    think->thinkphp/library/think
 2, 程序默认会进入 index模块-》Index控制器-》index方法
 3, 视图目录/控制器/操作方法.html    视图的默认顺序

二， URL访问
 1, 标准url访问格式 ： http://domainName/index.php/模块/控制器/操作
 2, 路由定义  在route.php return 添加  1, 'hello/:name' => 'index/index/hello', //url必须带参数
                                       2, 'hello/[:name]' => 'index/index/hello',//url可以不带参数
                                       3, 'hello/[:name]$' => 'index/hello', //完整匹配
                                       4, 文件开头添加  Route::rule('hello/:name', 'index/hello');
              5， 闭包定义  'hello/[:name]' => function ($name) { return 'Hello cloure ,' . $name . '!';}
              6, 'hello/[:name]' => ['index/hello', ['method' => 'get', 'ext' => 'html']], //约束请求类型和URL后缀
 3, request 采用的方式 1, 使用 $request 依赖注入的方式获取 //默认方式
                       2, 使用帮助函数来完成，例如：request(), input()
                       3, 继承 controller 类，	
                       4, 传统，使用 request::instance ,
                       5, 建立一个公共控制器，绑定请求对象和用户模型
 4, reponse  输出格式   1, 改配置项 'default_return_type'				=>	'json'/‘xml’
                       2, 方法中使用 json（）， xml（）等函数
            页面跳转   1,
            页面重定向 ：redirect(), $this->redirect(); 

三， 调试 1, trace 方式 ，设置 'app_trace'	=>		true
          2, 异常页面
          3, 断点分析法 dump(), trace(), halt()
          4, 日志分析   trace(str, level),  Log::$level(str)
          5, 远程调试
四, 数据库操作
          1, 原生sql查询  Db::execute(),  Db::query(), Db::connect() 支持切换数据库查询。 支持参数绑定，命名占位符绑定
          2, 查询构造器   Db::table() //带前缀. Db::name() //不带前缀。助手函数 db(); 
          3, 链式操作
          4, 事物支持   Db::transaction（）//参数是一个闭包
                        Db::startTrans() ......  Db::commit() / Db::rollback()
五，查询语言 1, 查询表达式 Db::name() Db::where() 
                   Db::select() /*返回满足条件的所有记录*/ Db::find() //只能查询满足条件第一条记录
             2, 批量查询 Db::where([ 'id'     = ['between', '1,3'],
                                     'name'   = ['like',    '%think%'],])->select();
             3, 视图查询   /* 类似于查询建立了一个视图，只能用于查询操作*/ 
             4, query 查询 
             5, 获取数值  Db::value()
             6, 获取列数据 Db::column()
             7, 聚合查询 count max min sum avg
             8, 字符串查询 
             9, 日期查询 
             10, 分块查询 chunk（）//大量数据                                      
六，模型和关联 ORM = 对象————关系映射
        1, 
        2, 基础操作 save, create, addList /*批量新增*/ ,get, getBy+列名（列名第一个字母大写), all,delete, destroy
        3, 读取器 命名规范：get+属性名的驼峰命名+Attr
           修改器 命名规范：set+属性名的驼峰命名+Attr
        4, 类型转换 auto_timestamp = true 主动关闭 protected	$autoWriteTimestamp	=	false;  格式
           自动完成 auto  insert  update 固定值           
        5, 查询范围   scope	+	查询范围名称
        6, 全局查询  base
七， 输入验证
        1, 添加一个 validate/$controller.php 定义一个 $rule = [], 数组。
八， 关联 
        1, ThinkPHP5.0 的关联采用了对象化的操作模式,你无需继承不同的模型类,只是把关联定义成一个方法,并且直接通过当前模型对象的属性名获取定义的关联数据
        2, 一对一：hasOne(), 一对多: hasMany(), 
九， 视图和模板
   1, {volist} 。。。。{/volist} 
   2, assign(), 分配参数
   3, fetch($var), $var 是模板名字
   4, 模板使用
   5, 动态模板引擎 $this->view->engine->layout('layout','[__REPLACE__]'); 
十， Api开发
   1, 异常处理 json， abort， 自定义处理（1,继承HttpException 2,在配置文件修改异常处理类 ）
十一， 函数扩展
    全局函数定义重写，可以在app下的common.php 重写。
    模块内使用，可以在模块内的 common.php 定义。      
   类库扩展
session 操作 助手函数 session()
             Session类 Session::set();
             Resquest对象  $request->session();        
             模板使用session， {$Request.session.user_name} {$Request.session.user.name} //二维数组
        Session 驱动
