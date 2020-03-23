package main

import "fmt"

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

// 需要辅助参数
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
