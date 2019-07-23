<?php

function start(){
include 'signup.php';
}

function trypassword($username,$user_arr)
{	
	echo "\n wrong password ";
	echo "\n Please Enter the right password: \n";
	$password = trim(fgets(STDIN));
	if ($user_arr['password'][$username]==md5($password)) 
	{
		$SESSION['user']=$username;	
		include 'dashboard.php';
	}
	else{
			sleep(1);
			
		trypassword($username,$user_arr);
	}
}
function tryuser($user_arr)
{
	echo " username not exist plz provide correct username to login: \n";
	$username = trim(fgets(STDIN));
	if (in_array($username, $user_arr['username']))
	{
		sleep(1);
		echo "\n Please Enter password : ";
		$password = trim(fgets(STDIN));
		if (($user_arr['password'][$username])==md5($password)) {
			
			$SESSION['user']=$username;
			include 'dashboard.php';
		}
		else
		{
			trypassword($username,$user_arr);
		}
	}
	else
	{
		tryuser($user_arr);
	}
}
function trysign($counter,$username,$user_arr)
{
	sleep(1);
	echo "\n This username already existed please Enter unique uername for Signup: \n";
	$username = trim(fgets(STDIN));
	if (!(in_array($username, $user_arr['username']))) 
	{
	echo "\n Please Enter password for Signup: ";
	$password = trim(fgets(STDIN));
	$SESSION['user']=$username;
	$user_arr['username'][++$counter]=$username;
	$user_arr['password'][$username]=md5($password);
	$user_arr=json_encode($user_arr);		
	file_put_contents("user.bnmc", $user_arr);
	$SESSION['user']=$username;
	include('dashboard.php');
	}
	else{
		trysign($counter,$username,$user_arr);
	}
}

function logout(){
	echo "Now you are logged out";
	sleep(1);
	setssion_destroy();
	include 'signup.php';
}

?>