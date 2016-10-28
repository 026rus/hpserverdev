<html>
<head>
<meta charset="UTF-8">
<title>database connections</title>
</head>
<body>

<?php

$username="root";
$password="password";
$database="BWAChecks";

mysql_connect(localhost,$username,$password);

@mysql_select_db($database) or die( "Unable to select database");

$query="SELECT * FROM bChecks";

$result=mysql_query($query);

$num=mysql_numrows($result);

mysql_close();

?>

<table>
<tr>
	<td><button onclick="location.href='select.php'">Return to Main Page</button></td>
</tr>
<tr>
</tr>
<table>

<table border="1" cellspacing="2" cellpadding="2" width="50%">
<tr>
	<td align="center">
	<font face="Arial, Helvetica, sans-serif"><strong>BWA01</strong></font>
	</td>
	<td align="center">
	<font face="Arial, Helvetica, sans-serif"><strong>Date</strong></font>
        </td>

</tr>

<?php

$i=0;

while ($i < $num) {

$f1=mysql_result($result,$i,"bwa01");

$f2=mysql_result($result,$i,"datechecked");

//--
//$f3=mysql_result($result,$i,"ID");

?>

<tr>
	<td>
	<font face="Arial, Helvetica, sans-serif"><?php echo $f1; ?></font>
	</td>
	<td>
	<font face="Arial, Helvetica, sans-serif"><?php echo $f2; ?></font>
	</td>
</tr>

<?php
$i++;
}
?>




</body>
</html>
