>               A
>             /   \
>            B     C
>           / \   / 
>          D   E  F
>
* 打印先序遍历：中——左——右
* 打印中序遍历：左——中——右
* 打印后序遍历：左——右——中

```
 ./a.out
ab#d##c#e##
```

- 前序遍历！   
- 后序遍历！  
- 中序遍历！  

**完全二叉树**
```
若设二叉树的高度为h，除第 h 层外，其它各层的结点数都达到最大个数，第h层有叶子结点，并且叶子结点都是从左到右依次排布，这就是完全二叉树。
```
**满二叉树**
```
除了叶结点外每一个结点都有左右子叶且叶子结点都处在最底层的二叉树。
```
**平衡二叉树**
```
平衡二叉树又被称为AVL树（区别于AVL算法），它是一棵二叉排序树，且具有以下性质：
它是一棵空树或它的左右两个子树的高度差的绝对值不超过1，并且左右两个子树都是一棵平衡二叉树。
```
**二叉搜索树/二叉排序树/二叉查找树**
```
（又：二叉搜索树，二叉排序树）它或者是一棵空树，或者是具有下列性质的二叉树： 
- 若它的左子树不空，则左子树上所有结点的值均小于它的根结点的值； 
- 若它的右子树不空，则右子树上所有结点的值均大于它的根结点的值； 
- 它的左、右子树也分别为二叉排序树。
```
***二叉查找树操作集锦***
```golang
// 二叉搜索树操作集锦  left < parent < right
type Node struct {
	data  int
	left  *Node
	right *Node
}

func newNode(data int) *Node {
	return &Node{
		data: data,
	}
}

// 插入
func (s *Node) insert(val int) *Node {
	if nil == s {
		return &Node{
			data: val,
		}
	}
	if val > s.data {
		s.right = s.right.insert(val)
	}

	if val < s.data {
		s.left = s.left.insert(val)
	}
	return s
}

// 删除
func (s *Node) delete(val int) *Node {
	if nil == s {
		return nil
	}
	if val == s.data {
		//  叶子节点删除
		if nil == s.left && nil == s.right {
			return nil
		}
		// 左节点为空
		if nil == s.left {
			return s.right
		}
		// 右节点为空
		if nil == s.right {
			return s.left
		}
		// 左右都不为空
		min := s.right.getMin()
		s.data = min.data
		s.right = s.right.delete(min.data)
	}
	if val > s.data {
		s.right = s.right.delete(val)
	}
	if val < s.data {
		s.left = s.left.delete(val)
	}
	return s
}

// 获取最小值
func (s *Node) getMin() *Node {
	if nil == s {
		return nil
	}

	if nil == s.left {
		return s
	}
	return s.left.getMin()
}

// 查询
func (s *Node) query(val int) bool {
	if nil == s {
		return false
	}
	if val == s.data {
		return true
	}
	if val < s.data {
		return s.left.query(val)
	}
	if val > s.data {
		return s.right.query(val)
	}
	return false
}

// 打印
func (s *Node) print() {
	if nil != s {
		fmt.Println(s.data, " ")
		s.left.print()
		s.right.print()
	}
}

// 判断是否是一颗有效二叉平衡树
func (s *Node) isValid(min, max *Node) bool {
	if nil == s {
		return true
	}
	if min != nil && s.data < min.data {
		return false
	}
	if max != nil && s.data > max.data {
		return false
	}
	return s.left.isValid(min, s) && s.right.isValid(s, max)
}

func main() {
	head := newNode(10)
	head.insert(3)
	head.print()
	head.insert(4)
	head.print()
	head.insert(20)
	head.print()
	head.insert(1)
	head.print()
	head.insert(15)
	head.print()
	fmt.Println(head.isValid(nil, nil)) //true
	in := head.query(1)
	in = head.query(6)
	_ = in
	head.delete(11)
	head.print()
	head.delete(3)
	head.print()
	head.delete(20)
	fmt.Println(head.isValid(nil, nil)) // true
}
```

## B树（B-树）
> 一种平衡的多叉树，一棵m阶的B树是一颗平衡的m路查找树
1. 根结点至少有两个子女；
2. 每个非根节点至少有 j 个关键字，关键字从小到大有序排序，m/2-1<=j<=m-1。跟节点至少一个关键字，
3. 除根节点外，所有节点的度数k比关键字数多1，m/2<=k<=m
4. 所有叶子节点都位于同一层

## B+树
> B+树的特点是能够保持数据稳定有序，其插入与修改拥有较稳定的对数时间复杂度。B+树元素自底向上插入，这与二叉树恰好相反。<br>
> B+树是B树的一种变形形式，B+树的叶子节点存储关键字以及相应记录的地址，叶子节点以上节点作为索引使用
1. 每个节点最多有 m 个关键字
2. 除根节点外，每个节点至少有 m/2 个子女，根节点最少 2 个子女
3. 所有叶子节点都在同一层，叶子节点有序，并且保存了相邻节点的指针

## B树和B+树的区别
- 所有的查询都要查找到叶子节点，查询性能是稳定的，而B树，每个节点都可以查找到数据，所以不稳定
- 所有的叶子节点形成了一个有序链表，更加便于查找

## 红黑树
红黑树是具有如下性质的二叉查找树，自平衡特性
- 每个节点或者是红色，或者是黑色
- 根是黑色
- 如果一个节点是红色，那么它的子节点必须是黑色
- 从一个节点到一个 NULL 指针的每一条路径必须包含相同数目的黑色节点

## 散列冲突解决策略
- 分离链接发-链表
- 开放定址法 （hash(x) + F(i)）mod tablesize
    - 线性探测法
    - 平方探测法
    - 双散列
- 在散列
