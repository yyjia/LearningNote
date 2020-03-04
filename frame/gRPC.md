## 什么是gRPC

通过gRPC，客户端可以像调用本地方法一样调用在不同机器上的服务端方法，极大的方便用户构建一个分布式程序和服务。 gRPC 它基于定义服务，确定的方法和相应的参数进行远程调用，然后返回相应的类型。

### service 定义
```
  service HelloService {
    // 支持四种类型的 service 方法

    // Unary RPCs 1. 一个请求 一个返回
    rpc SayHello (HelloRequest) returns (HelloResponse);
    // server streaming RPCs 2. 单个请求，返回消息流, 一系列的消息
    rpc SayHello (HelloRequest) returns (stream HelloResponse);
    // Client streaming RPCs 3. 一系列的请求， 单个返回
    rpc SayHello (stream HelloRequest) returns (HelloResponse);
    // Bidirectional streaming RPCs 4. 请求，返回都是 一系列。
  }

  message HelloRequest {
    string greeting = 1;
  }

  message HelloResponse {
    string reply = 1;
  }
```

### 职责

首先，在 .proto 定义一个service， gRPC 通过「protocol buffer」编译插件生成客户端和服务端代码。用户一般在客户端调用这些api，实现服务端的这些 API 的接口。

server :  server 实现了 service 定义的接口，运行一个 gRPC 服务，接受客户端的调用。gRPC 应用解码进入的请求，执行服务器方法，编码返回的数据。
client : 客户端有一个本地的 stub 对象，它实现了相同的 service 端的方法。 然后，客户端可以在本地对象上调用这些方法，将调用的参数包装在适当的协议缓冲区消息类型中 - gRPC 在将请求发送到服务器并返回服务器的协议缓冲区响应之后查看。

## 微服务设计六大原则
- 高内聚低耦合
- 高度自治
- 以业务为中心
- 日志与监控
- 弹性设计
- 自动化

## 分布式基础理论 CAP 和 Paxox
### CAP
- C： consistency， 一致性
- A:  availability，可用性
- P: partition， 分布容忍性
### Paxos 
集群：多个人在一起作同样的事 。
分布式 ：多个人在一起作不同的事 。