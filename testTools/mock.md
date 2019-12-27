# gorm mock
金融那边测试数据模型用的是 https://gopkg.in/testfixtures.v2
原理是 从数据文件加载到数据库，然后测试，测试完，恢复数据（恢复到家在数据之前数据库的 checksum）

## model 写法
## 生成测试用例 github.com/cweill/gotests
## 测试 sql 使用 github.com/DATA-DOG/go-sqlmock
## 生成 mock 程序 github.com/vektra/mockery
