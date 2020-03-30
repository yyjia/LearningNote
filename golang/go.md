panic :
1 停止正常的流程
2 defered 函数正常执行
3 返回上一级的调用函数
4 process crashes

## GC 原理与优化
- Todo

## go 内存模型
- Todo

## Golang协程 GMP （m >= p）
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

## golang 内存泄漏场景
1. 子字符导致的暂时内存泄漏
```go
var s0 string // 一个包级变量

// 一个演示目的函数。
func f(s1 string) {
	s0 = s1[:50]
	// 目前，s0和s1共享着承载它们的字节序列的同一个内存块。
	// 虽然s1到这里已经不再被使用了，但是s0仍然在使用中，
	// 所以它们共享的内存块将不会被回收。虽然此内存块中
	// 只有50字节被真正使用，而其它字节却无法再被使用。
	// 可以使用 strings.Builder 避免
}

func demo() {
	s := createStringWithLengthOnHeap(1 << 20) // 1M bytes
	f(s)
}
```
2. 子切片造成的暂时内存泄漏
```go
var s0 []int
func g(s1 []int) {
	s0 = s1[len(s1)-10:]
	// 可以使用 append 避免
	// s0 = append(s1[:0:0], s1[len(s1)-30:]...)
}
```
3. 因为未重置丢失的切片元素中的指针
```go
func h() []*int {
	s := []*int{new(int), new(int), new(int), new(int)}
	// 使用此s切片 ...
	return s[1:3:3]
	// s[0], s[3] 泄漏
}
```
4. for 循环中不正确使用 defer
```go
func writeManyFiles(files []File) error {
	for _, file := range files {
		f, err := os.Open(file.path)
		if err != nil {
			return err
		}
		defer f.Close()
		// .........
	}
	// fils 很大的时候，在 return 之前大量的 文件句柄无法释放
	return 
}
// 可以改成
func writeManyFiles(files []File) error {
	for _, file := range files {
		if err := func() error {
			f, err := os.Open(file.path)
			if err != nil {
				return err
			}
			defer f.Close() // 将在此循环步步尾执行
			// ......
		}(); err != nil {
			return err
		}
	}
	return nil
}
```
5. 协程被永久阻塞而造成
6. time.Ticker 没有stop
7. 不正确地使用终结器（runtime.SetFinalizer）