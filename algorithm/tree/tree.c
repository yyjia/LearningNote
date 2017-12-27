#include <stdio.h>
#include <stdlib.h>

typedef char TempType;

typedef struct Node{
	TempType data;
	struct Node *left, *right;
}TempNode;

TempNode* createTree(void){
	TempNode *node;
	TempType ch;
	scanf("%c",&ch);

	if(ch == '#'){
		node = NULL;
	}
	else
	{
		node = (TempNode* )malloc(sizeof(TempNode));
		node->data = ch;
		node->left = createTree();
		node->right = createTree();
	}

	return node;

}

void  leftTraverse(TempNode* root)
{
	if(root)
	{
		printf("%c",root->data);
		leftTraverse(root->left);
		leftTraverse(root->right);
	}	
}

void  rightTraverse(TempNode* root){
	if(root)
	{
		rightTraverse(root->left);
		rightTraverse(root->right);
		printf("%c",root->data);
	}
}

void  midTraverse(TempNode* root){
	if(root)
	{
		midTraverse(root->left);
		printf("%c", root->data);
		midTraverse(root->right);

	}
}

int main()
{
	TempNode* root=NULL;
	root = createTree();
	printf("\n 前序遍历！\n");
	leftTraverse(root);
	printf("\n 后序遍历！\n");
	rightTraverse(root);
	printf("\n 中序遍历！\n");
	midTraverse(root);
}
