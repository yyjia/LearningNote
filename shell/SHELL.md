**软链接**: 符号链接  保存了其代表文件的路径， 是另外一中文件，在硬盘上有独立的区块， 访问时自动替换为源文件。

**硬链接**：和源文件没有区别， 都是指向物理硬盘的一块区域。

## 服务器 CPU 使用率 达到 100% 如何查找问题
- top 查找到使用率高的进程
- 查看对应的线程
- 

## 查看系统负载
uptime
```
10:05  up 2 days, 21:45, 4 users, load averages: 2.35 1.82 1.47
```

top
```
Processes: 455 total, 2 running, 453 sleeping, 2087 threads                                                              10:07:27
Load Avg: 1.65, 1.78, 1.50  CPU usage: 2.6% user, 2.82% sys, 95.10% idle   SharedLibs: 207M resident, 44M data, 22M linkedit.
MemRegions: 105209 total, 2044M resident, 82M private, 1238M shared. PhysMem: 8012M used (1915M wired), 178M unused.
VM: 2220G vsize, 1880M framework vsize, 1719333(0) swapins, 2027462(0) swapouts.
Networks: packets: 3059497/829M in, 3542885/385M out. Disks: 1746947/31G read, 1123997/21G written.

PID    COMMAND      %CPU TIME     #TH   #WQ  #PORT MEM    PURG   CMPRS  PGRP  PPID  STATE    BOOSTS          %CPU_ME %CPU_OTHRS
8262   top          12.9 00:02.58 1/1   0    25    4316K+ 0B     0B     8262  1138  running  *0[1]           0.00000 0.00000
1083   iTerm2       11.2 03:18.96 10    7    498   230M-  4540K  46M-   1083  1     sleeping *0[6392]        0.25449 1.18402
```
cat /proc/loadavg
```
0.00 0.01 0.05 2/384 4482
```

## 批量处理方式
```bash
find
// 批量处理
find . -type f -exec '{}' \;
// 查找最近30分钟修改的当前目录下的.php文件
find . -name '*.php' -mmin -30
//查找最近24小时修改的当前目录下的.php文件
find . -name '*.php' -mtime 0

ls
// 按照最近修改时间排序
ls -lt -c 
// 按照最近访问时间排序
ls -lt -u 

// 查看文件系统大小
df -h 

// 查看文件目录大小
du 
```
