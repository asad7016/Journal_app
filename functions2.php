<?php
function dashboard($user,$file){
	echo "\n press 1 to create new journal";
	echo "\n press 2 read previous Journals\n";
	$number=trim(fgets(STDIN));

	if($number==2){

		dataread($user,$file);

	}
	else if($number==1){
		datacreate($user,$file);

	}
}

function dataread($user,$file){
	$data=file_get_contents($file);
	$file2=json_decode($data,true);
	// print_r($data);
	if (!empty($file2['data'])) 
	{
		$sn=0;
		echo "\n";
		echo "S.No    Date & time         Journal\n";

		foreach ($file2['data'] as $value) 
		{	
			$value=hex2bin($value);
			echo ++$sn."     ".$value."\n";
		}		
	}
	else{
		echo " No Journal created Please create a Journal\n";
	}
	sleep(1);
	dashboard($user,$file);

}

function datacreate($user,$file){
	$data=file_get_contents($file);
	$cur_date=date("d F Y h:ia");
	if ($data) 
	{

		$file2=json_decode($data,true);
		$counter=count($file2['data']);
		if ($counter<50) 
		{	
			echo "Please Enter a new Journal: ";
			$new_data=trim(fgets(STDIN));
			$new_ddd = $cur_date." - ".$new_data;
			$new_ddd=bin2hex($new_ddd);
			array_unshift($file2['data'], $new_ddd);
			file_put_contents($file, json_encode($file2));	
		}
		else
		{
			echo "Please Enter a new Journal: ";
			$new_data=trim(fgets(STDIN));
			// $new_data=trim(readline("Please Enter a new Journal: "));
			$new_ddd = $cur_date." - ".$new_data;
			$new_ddd=bin2hex($new_ddd);
			array_pop($file2['data']);	
			array_unshift($file2['data'], $new_ddd);
			file_put_contents($file, json_encode($file2));
		}
	}
	else{
	$file2=array();
	// $new_data=trim(readline("Please Enter a new Journal: "));
	echo "Please Enter a new Journal: ";
	$new_data=trim(fgets(STDIN));	
	$new_ddd = $cur_date." - ".$new_data;
	$new_ddd=bin2hex($new_ddd);
	$arr['data'][1]=$new_ddd;
	file_put_contents($file, json_encode($arr));
	}	
	sleep(2);
	dashboard($user,$file);

}
?>