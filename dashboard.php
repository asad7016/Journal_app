<?php
if (isset($SESSION['user'])) {
	$user=$SESSION['user'];
	$file='data/'.$user.".bnmc";
	include 'functions2.php';
	echo "\n Hi ".$user. ' welcome to the Personal journal app';

	$cur_date=date("d F Y h:ia");
	
	dashboard($user,$file);
}
?>