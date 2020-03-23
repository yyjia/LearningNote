package main

// 二叉堆实现, 大根堆
type TreeList struct {
	list []int
	len  int
	cap  int
}

// 父节点索引
func parent(k int) int {
	return k / 2
}

// 左孩子节点索引
func left(k int) int {
	return 2 * k
}

// 有孩子节点索引
func right(k int) int {
	return 2*k + 1
}

// 上浮
func (s *TreeList) swim(ind int) {
	for {
		pp := parent(ind)
		if ind > 1 && s.list[ind] > s.list[pp] {
			s.list[pp], s.list[ind] = s.list[ind], s.list[pp]
			ind = pp
		} else {
			break
		}
	}
}

// 下沉
func (s *TreeList) sink(ind int) {
	for {
		if ind < s.len {
			l := left(ind)
			r := right(ind)
			sel := l
			if s.list[l] < s.list[r] {
				sel = r
			}
			if s.list[ind] < s.list[sel] {
				s.list[ind], s.list[sel] = s.list[sel], s.list[ind]
				ind = sel
			} else {
				break
			}
		} else {
			break
		}
	}
}

// 插入 追加到列表结尾在上浮，从堆尾开始上浮
func (s *TreeList) insert(data int) {
	if s.len < s.cap {
		s.len++
		s.list[s.len] = data
		s.swim(s.len)
	}
}

// 删除堆顶 堆顶和堆尾互换，然后删除堆尾，从堆顶开始下沉
func (s *TreeList) delMax() (max int) {
	if s.len > 0 {
		s.list[1], s.list[s.len] = s.list[s.len], s.list[1]
		max = s.list[s.len]
		s.list[s.len] = -1
		s.len--
		s.sink(1)
	}
	return
}

// NewList 初始化大根堆
func NewList(cap int) *TreeList {
	return &TreeList{
		len:  0,
		cap:  cap,
		list: make([]int, cap+1),
	}
}

func main() {
	s := NewList(7)
	s.insert(3)
	s.insert(4)
	s.insert(5)
	s.insert(10)
	s.insert(7)
	max := s.delMax()
	_ = max
	s.insert(8)
	s.insert(6)
	s.insert(15)

}
