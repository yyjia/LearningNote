<?php
	
	$arr = ['one' => 'apple', 'app' => 'mao', 3 => 'hello', 'world' => 2, 1 => 'hello'];

	function my_asort(array $arr)
	{
		$vals = array_values($arr);

		sort($vals);  //sort($keys);
		
		$result = [];
		foreach($vals as $v){
			$k = array_search($v, $arr);
			
			$result[$k] = $v;

			unset($arr[$k]);
		}

		$keys = array_keys($result);
		for ($i = 0; $i < count($keys)-1; $i++)
		{
			for($j = 0; $j< count($keys)-1; $j++)
			{
				if($result[$keys[$j]] < $result[$keys[$j+1]])
					continue;

				if($keys[$j]>$keys[$j+1])
				{
					$temp = $keys[$j+1];
					$keys[$j+1] = $keys[$j];
					$keys[$j] = $temp;
				}
					
			}
		}

		return array_combine($keys, $vals);

	}

	var_dump(my_asort($arr));
?>
