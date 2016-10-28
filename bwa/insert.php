<html>
<body>
 
 
<?php
$con = mysql_connect("localhost","root","password");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }
 
mysql_select_db("BWAChecks", $con);
 
$sql="INSERT INTO bChecks (bwa01, datechecked)
VALUES
('$_POST[bwa01]','$_POST[datechecked]')";
 
if (!mysql_query($sql,$con))
  {
  die('Error: ' . mysql_error());
  }
echo "1 record added";
 
mysql_close($con)
?>


</body>
</html>
