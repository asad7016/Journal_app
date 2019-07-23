<?php 

$key = 'SuperSecretKey';

echo " Welcome to Personal Journal App";
echo "\n Press 1 for Signup";
echo "\n Press 2 for Login: \n";
// echo "\n Press 3 for Quit: ";
// $number = readline();
$number=trim(fgets(STDIN));
$myfile=file_get_contents("user.bnmc");
$user_arr=json_decode($myfile,true);
$counter=count($user_arr['username']);

if ($number==1) 
{
	if($counter<10)
	{
	echo "\n Please Enter unique username for Signup: ";
	$username=trim(fgets(STDIN));
		if (!(in_array($username, $user_arr['username'])))
		{
			echo "\n Please Enter password: ";
			$password = trim(fgets(STDIN));
			$SESSION['user']=$username;
			$user_arr['username'][++$counter]=$username;
			$user_arr['password'][$username]=md5($password);
			$user_arr=json_encode($user_arr);		
			file_put_contents("user.bnmc", $user_arr);
			$file='data/'.$username.".bnmc";
			$data=fopen($file, 'w');
			fclose($data);
			include('dashboard.php');
		}
		else
		{
			trysign($counter,$username,$user_arr);
		}
	 }
	 else{
	 	echo "\n More than 10 signups are not allowed \n";
	 	sleep(1);
	 	include 'signup.php';
	}
}
elseif ($number==2)
{
	include 'login.php';
}
// elseif ($number==3)
// {
// 	sleep(1);
// 	exit;
// }

else
{
	echo "\n you have enter the wrong input!! \n";
	start();
}


?>