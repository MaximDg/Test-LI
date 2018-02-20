<?php 

function db () {
	static $link;
	if ($link == NULL)
	{
		$db_host = 'localhost';
		$db_user = 'root';
		$db_pass = '';
		$db_name = 'li';

		$link = new MySQLi($db_host, $db_user, $db_pass, $db_name);
	if($link->connect_error){
	die('<p style="color: #f00">'.$link->connect_error.'</p>');
	}
	}
	return $link;
}

 ?>