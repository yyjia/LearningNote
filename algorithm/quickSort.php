<?php
function quickSort(&$arr){
    if(count($arr)>1){
        $k=$arr[0];
        $x=array();
        $y=array();
        $_size=count($arr);
        for($i=1;$i<$_size;$i++){
            if($arr[$i]<=$k){
                $x[]=$arr[$i];
            }elseif($arr[$i]>$k){
                $y[]=$arr[$i];
            }
        }
        $x=quickSort($x);
        $y=quickSort($y);
        return array_merge($x,array($k),$y);
    }else{
        return $arr;
    }
}

$num = array(3,4,2,1,9,8,1,7,7);
print_r(quickSort($num));
?>
