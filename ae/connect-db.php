<?php
/*
 CONNECT-DB.PHP
 Allows PHP to connect to your database
*/

 // Database Variables (edit with your own server information)
 $server = 'localhost';
 $user = 'root';
 $pass = 'password';
 $db = 'AdvanceExchange';

 // Connect to Database
 $connection = mysql_connect($server, $user, $pass)
 or die ("Could not connect to server ... \n" . mysql_error ());
 $mydb = mysql_select_db($db)
 or die ("Could not connect to database ... \n" . mysql_error ());
?>