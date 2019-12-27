
## siege sample test tools (github.com/JoeDog/siege)

### install 

> install from source code <br>
> need tools: autoconf, automake, autotools <br>
> $ cd siege <br>
> $ utils/bootstrap <br>
> $ ./configure --prefix=$HOME <br>
> $ make <br>
> $ make install <br>
>

### siega command example

```
## 并发25次， 请求 10次 总共请求 250次
siege --header="x-user-id:234594" --content-type="application/json" -f test/urls.txt -d1 -r10 -c25
```

### file context

```
## test/urls.txt
DOMIN=http://bi-rpc-predict.xxxx-cloud.com
$(DOMIN)/api/bi.price_feedback.PriceModelVerify/ConfigList
$(DOMIN)/api/bi.price_feedback.PriceModelVerify/UpdateConfig POST {"model:[{"id" : 23,"config_value": "123.34"},{"id" : 24,"config_value": "123.34"}]}
```
### response

```
Transactions:		         250 hits  # 总请求次数
Availability:		      100.00 %
Elapsed time:		        9.49 secs。 # 总用时
Data transferred:	        0.41 MB     # 总数据传输
Response time:		        0.04 secs。 # 每个请求平均用时 
Transaction rate:	       26.34 trans/sec # 每秒请求数
Throughput:		        0.04 MB/sec     # 服务器平均每秒吞吐
Concurrency:		        1.05        # 每秒的平均连接数
Successful transactions:         250
Failed transactions:	           0
Longest transaction:	        0.13
Shortest transaction:	        0.01
```