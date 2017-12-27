#include<iostream>
#include<stdio.h>
using namespace std;

typedef struct node
{
	struct node *leftChild;
	struct node *rightChild;
	char data;
}BiTreeNode, *BiTree;

void createBiTree(BiTree &T)
{
	char c;
	cin >> c;
	if('#' == c)
		T = NULL;
	else
	{
		T = new BiTreeNode;
		T->data = c;
		createBiTree(T->leftChild);
		createBiTree(T->rightChild);
	}
}

void preTree(BiTree T)
{
	if(T)
	{
		printf("%c", T->data);
		preTree(T->leftChild);
		preTree(T->rightChild);
	}
}

int main()
{
	BiTree T;
	createBiTree(T);

	printf("pre traverse!!\n");
	preTree(T);
	return 0;
}
