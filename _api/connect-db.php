<?php
/*
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

// Database Variables (edit with your own server information)

function db_connect()
{
	static $connection;
	if(!isset($connection))
	{
		$config = parse_ini_file("../../win/apiconfig.ini");
		$server = "localhost";

	 	// Connect to Database
//		$connection = mysql_connect($server, $config['username'], $config['password'])
		$connection = mysqli_connect($server, $config['username'], $config['password'],$config['dbname'])
			or die ("Could not connect to server ... \n" .mysqli_connect_error());
//		$mydb = mysql_select_db($config['dbname'])
//			or die ("Could not connect to database ... \n" . mysql_error ());
	}
	return $connection;
}

?>
