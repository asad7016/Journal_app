<?php 
// include 'functions.php';
// session_start();

$myfile=file_get_contents("user.bnmc");
$user_arr=json_decode($myfile,true);
echo "\n Please Enter username for Login: ";
$username = trim(fgets(STDIN));
	if (in_array($username, $user_arr['username'])) {
		sleep(1);
		echo "\n Please Enter password : ";
		$password = trim(fgets(STDIN));

		if ($user_arr['password'][$username]==md5($password)) 
		{
			sleep(2);
			$SESSION['user']=$username;
			include 'dashboard.php';
				// include 'dashboard.php';
		}
		else{
			trypassword($username,$user_arr);
		}
	}
	else{
		tryuser($user_arr);

		}
		
?>