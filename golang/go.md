panic :
1 停止正常的流程
2 defered 函数正常执行
3 返回上一级的调用函数
4 process crashes

## GC 原理与优化
- Todo

## go 内存模型
- Todo

## Golang协程
- 轻量级的线程(​ 协程跟线程是有区别的，线程由CPU调度是抢占式的，协程由用户态调度是协作式的，一个协程让出CPU后，才执行下一个协程)
- 非抢占多任务处理，由协程主动交出控制权
- 编译器/解释器/虚拟机层面的多任务，不在操作系统层面
- 多个协程可能在一个线程，多个线程上运行

## channel 信道
```
type hchan struct {
	qcount   uint           // total data in the queue
	dataqsiz uint           // size of the circular queue
	buf      unsafe.Pointer // points to an array of dataqsiz elements
	elemsize uint16
	closed   uint32
	elemtype *_type // element type
	sendx    uint   // send index
	recvx    uint   // receive index
	recvq    waitq  // list of recv waiters
	sendq    waitq  // list of send waiters

	// lock protects all fields in hchan, as well as several
	// fields in sudogs blocked on this channel.
	//
	// Do not change another G's status while holding this lock
	// (in particular, do not ready a G), as this can deadlock
	// with stack shrinking.
	lock mutex
}
```
参考[channel 底层实现及原理](https://gocn.vip/topics/9305)

## json/protobuf 数据交换格式
- 优点：
    - protobuf 相对于 Json 编解码速度更快，数据体积更小
    - 使用统一规范，不用担心大小写不同导致解析失败
- 缺点：
    - 改动字段，需要重新生成文件
    - 数据可读性差

## make 和 new 的区别
- make和new都是golang用来分配内存的內建函数，且在堆上分配内存，make 即分配内存，也初始化内存。new只是将内存清零，并没有初始化内存。
- make返回的还是引用类型本身；而new返回的是指向类型的指针。
- make只能用来分配及初始化类型为slice，map，channel的数据；new可以分配任意类型的数据。

## go 的 GMP 模型
- G: Goruntine 用户态线程
- M: 内核态线程 thread
- P: Procesor 处理器

参考[GMP内存模型](https://www.jianshu.com/p/fa696563c38a)
在 go 中 线程（M）是运行 goruntine 的实体，调度器的功能是把可运行的 goruntine 分配给工作线程