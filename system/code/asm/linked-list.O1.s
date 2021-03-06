	.file	"linked-list.c"
	.text
	.globl	new_list_ele
	.type	new_list_ele, @function
new_list_ele:
	pushq	%rbx
	movq	%rdi, %rbx
	movl	$16, %edi
	call	malloc
	movq	%rbx, (%rax)
	movq	$0, 8(%rax)
	popq	%rbx
	ret
	.size	new_list_ele, .-new_list_ele
	.globl	array_to_list_addtail
	.type	array_to_list_addtail, @function
array_to_list_addtail:
	pushq	%r13
	pushq	%r12
	pushq	%rbp
	pushq	%rbx
	subq	$24, %rsp
	movq	%rsi, %r12
	movq	$0, 8(%rsp)
	testq	%rsi, %rsi
	je	.L4
	movq	%rdi, %r13
	movl	$0, %ebx
	leaq	8(%rsp), %rbp
.L5:
	movslq	0(%r13,%rbx,4), %rdi
	call	new_list_ele
	movq	%rax, 0(%rbp)
	leaq	8(%rax), %rbp
	addq	$1, %rbx
	cmpq	%r12, %rbx
	jne	.L5
.L4:
	movq	8(%rsp), %rax
	addq	$24, %rsp
	popq	%rbx
	popq	%rbp
	popq	%r12
	popq	%r13
	ret
	.size	array_to_list_addtail, .-array_to_list_addtail
	.globl	array_to_list_reverse
	.type	array_to_list_reverse, @function
array_to_list_reverse:
	pushq	%r13
	pushq	%r12
	pushq	%rbp
	pushq	%rbx
	subq	$8, %rsp
	movq	%rsi, %r12
	leaq	-1(%rsi), %rbx
	cmpq	%rbx, %rsi
	jbe	.L10
	movq	%rdi, %r13
	movl	$0, %ebp
.L9:
	movslq	0(%r13,%rbx,4), %rdi
	call	new_list_ele
	movq	%rbp, 8(%rax)
	subq	$1, %rbx
	cmpq	%rbx, %r12
	jbe	.L8
	movq	%rax, %rbp
	jmp	.L9
.L10:
	movl	$0, %eax
.L8:
	addq	$8, %rsp
	popq	%rbx
	popq	%rbp
	popq	%r12
	popq	%r13
	ret
	.size	array_to_list_reverse, .-array_to_list_reverse
	.globl	array_to_list_recurse
	.type	array_to_list_recurse, @function
array_to_list_recurse:
	movl	$0, %eax
	testq	%rsi, %rsi
	je	.L17
	pushq	%rbp
	pushq	%rbx
	subq	$8, %rsp
	movq	%rdi, %rbx
	subq	$1, %rsi
	leaq	4(%rdi), %rdi
	call	array_to_list_recurse
	movq	%rax, %rbp
	movslq	(%rbx), %rdi
	call	new_list_ele
	movq	%rbp, 8(%rax)
	addq	$8, %rsp
	popq	%rbx
	popq	%rbp
.L17:
	rep; ret
	.size	array_to_list_recurse, .-array_to_list_recurse
	.globl	incr_ele
	.type	incr_ele, @function
incr_ele:
	addq	$1, (%rdi)
	ret
	.size	incr_ele, .-incr_ele
	.globl	incr_list
	.type	incr_list, @function
incr_list:
	testq	%rdi, %rdi
	je	.L19
.L21:
	addq	$1, (%rdi)
	movq	8(%rdi), %rdi
	testq	%rdi, %rdi
	jne	.L21
.L19:
	rep; ret
	.size	incr_list, .-incr_list
	.section	.eh_frame,"a",@progbits
.Lframe1:
.LSCIE1:
	.long	0
	.byte	0x3
	.string	"zR"
	.uleb128 0x1
	.sleb128 -8
	.uleb128 0x10
	.uleb128 0x1
	.byte	0x3
	.byte	0xc
	.uleb128 0x7
	.uleb128 0x8
	.byte	0x90
	.uleb128 0x1
	.align 8
.LSFDE1:
	.uleb128 0
	.byte	0x4
	.byte	0xe
	.uleb128 0x10
	.byte	0x83
	.uleb128 0x2
	.byte	0x4
	.byte	0xe
	.uleb128 0x8
	.align 8
.LSFDE3:
	.uleb128 0
	.byte	0x4
	.byte	0xe
	.uleb128 0x10
	.byte	0x8d
	.uleb128 0x2
	.byte	0x4
	.byte	0xe
	.uleb128 0x18
	.byte	0x8c
	.uleb128 0x3
	.byte	0x4
	.byte	0xe
	.uleb128 0x20
	.byte	0x86
	.uleb128 0x4
	.byte	0x4
	.byte	0xe
	.uleb128 0x28
	.byte	0x83
	.uleb128 0x5
	.byte	0x4
	.byte	0xe
	.uleb128 0x40
	.byte	0x4
	.byte	0xe
	.uleb128 0x28
	.byte	0x4
	.byte	0xe
	.uleb128 0x20
	.byte	0x4
	.byte	0xe
	.uleb128 0x18
	.byte	0x4
	.byte	0xe
	.uleb128 0x10
	.byte	0x4
	.byte	0xe
	.uleb128 0x8
	.align 8
.LSFDE5:
	.uleb128 0
	.byte	0x4
	.byte	0xe
	.uleb128 0x10
	.byte	0x8d
	.uleb128 0x2
	.byte	0x4
	.byte	0xe
	.uleb128 0x18
	.byte	0x8c
	.uleb128 0x3
	.byte	0x4
	.byte	0xe
	.uleb128 0x20
	.byte	0x86
	.uleb128 0x4
	.byte	0x4
	.byte	0xe
	.uleb128 0x28
	.byte	0x83
	.uleb128 0x5
	.byte	0x4
	.byte	0xe
	.uleb128 0x30
	.byte	0x4
	.byte	0xe
	.uleb128 0x28
	.byte	0x4
	.byte	0xe
	.uleb128 0x20
	.byte	0x4
	.byte	0xe
	.uleb128 0x18
	.byte	0x4
	.byte	0xe
	.uleb128 0x10
	.byte	0x4
	.byte	0xe
	.uleb128 0x8
	.align 8
.LSFDE7:
	.uleb128 0
	.byte	0x4
	.byte	0xe
	.uleb128 0x10
	.byte	0x86
	.uleb128 0x2
	.byte	0x4
	.byte	0xe
	.uleb128 0x18
	.byte	0x83
	.uleb128 0x3
	.byte	0x4
	.byte	0xe
	.uleb128 0x20
	.byte	0x4
	.byte	0xe
	.uleb128 0x18
	.byte	0x4
	.byte	0xc3
	.byte	0xe
	.uleb128 0x10
	.byte	0x4
	.byte	0xc6
	.byte	0xe
	.uleb128 0x8
	.align 8
.LSFDE9:
	.uleb128 0
	.align 8
.LSFDE11:
	.uleb128 0
	.align 8
	.ident	"GCC: (Ubuntu 4.8.1-2ubuntu1~12.04) 4.8.1"
	.section	.note.GNU-stack,"",@progbits
