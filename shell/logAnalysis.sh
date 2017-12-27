#!/bin/sh

testFunc(){
	echo $@."\n";
	echo $*."\n";
}


testFunc 1 'a' 'b';
