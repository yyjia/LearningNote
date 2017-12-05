第一种 ： awk [-F field_separator] 'commands' input-file

第二种： #!/bin/awk

第三种： awk -f awk-script-file input-file(s)

1,   awk -F ':' '{print $1}'
2,   

ip地址匹配 ：grep '[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}' nginx.log | awk -F '' '{print $1}' | wc

[服务器日志分析](https://segmentfault.com/a/1190000009745139),很详细的介绍。
