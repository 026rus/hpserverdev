<html>
<head>
<title></title>
</head>
<body>
<?php


include('connect-db.php');

$conn = db_connect();

if(!($conn === false))
{
	$sql = "SELECT * FROM employee";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) <=0)
	{
		echo "ERROR geting result!!!";
	}
	else
	{
		$emparr[] = array();
		while($row = mysqli_fetch_assoc($result))
		{
			$emparr[]=$row;
		}
		echo json_encode($emparr);
	}

}
?>
</body>
</html>
