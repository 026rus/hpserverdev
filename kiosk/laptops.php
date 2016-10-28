<html>
<head>
<title> Kiosk Laptops DEV</title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php

    $id         = "";
    $firstname  = "";
	$middlename = "";
    $lastname   = "";
    $sb         = "";
    $order = 0;

    include('connect-db.php');

    $sql  = "SELECT *";
    $sql .=" FROM employee";
    if(isset($_GET['qq']))
	{
		$sql .= " WHERE true ";
        if(isset($_GET['id']))    		$id   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['id'])));
        if(isset($_GET['first_name']))   $firstname  = mysql_real_escape_string(htmlspecialchars(trim($_GET['first_name'])));
        if(isset($_GET['middle_name']))  $middlename = mysql_real_escape_string(htmlspecialchars(trim($_GET['middle_name'])));
        if(isset($_GET['last_name']))	$lastname   = mysql_real_escape_string(htmlspecialchars(trim($_GET['last_name'])));

        if($id != "") 			$sql .=" AND id=". 					"'"    .$id.		"'";
        if($firstname != "") 	$sql .=" AND first_name LIKE ".		"'%"   .$firstname.	"%'";
        if($middlename != "") 	$sql .=" AND middle_name LIKE ".	"'%"   .$middlename."%'";
        if($lastname != "") 	$sql .=" AND last_name LIKE ".		"'%"   .$lastname.	"%'";
	}
    if(isset($_GET['sb']))          $sb         = mysql_real_escape_string(htmlspecialchars(trim($_GET['sb'])));

	if ( isset($_GET['sb']) )
		if ( $_GET['ord'] == 0 )
		{
			$sql .= " ORDER BY " .  $sb . " ASC";
			$order = 1;
		}
		else
		{
			$sql .= " ORDER BY " .  $sb . " DESC";
			$order = 0;
		}

    $result = mysql_query($sql, $connection);
?>

<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign="middle" align="right">
<form method="post" action="addEmployee.php">
<input type="hidden" name="id"			value="<?= $id ?>" /> 
<input type="hidden" name="first_name"	value="<?= $firstname ?>" />
<input type="hidden" name="middle_name"	value="<?= $middlename ?>" />
<input type="hidden" name="last_name"	value="<?= $lastname ?>" />
<input type="hidden" name="order"   	value="<?= $order ?>" /> 
<input type="hidden" name="sb"	        value="<?= $sb ?>" /> 
<button type="submit">Add Employee</button>
</form>
</td> </tr>
</table>
</header>

<body>
<?php
    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    
    echo "<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>";
?>
	<form action="" method="get">
	<tr background="img/1.gif">
	<td colspan="3" align="right">
		<input type="submit" name="qq" value="Query">
		<input type="submit" name="clear" value="Clear">
	</td>
    </tr>
    <tr background="img/1.gif">
		<td><input type="text" size="20" name="first_name"	value="<?= $firstname ?>" /> </td>
		<td><input type="text" size="20" name="middle_name"	value="<?= $middlename ?>" /> </td>
        <td><input type="text" size="20" name="last_name"	value="<?= $lastname ?>" /> </td>
    </tr>
    </form>
<?php


    echo "<tr>\n";
    echo "<td><a href='laptops.php?ord=". $order . "&sb=first_name'>     First Name 	</a> </td>\n";
    echo "<td><a href='laptops.php?ord=". $order . "&sb=middle_name'>    Middle Name	</a> </td>\n";
    echo "<td><a href='laptops.php?ord=". $order . "&sb=last_name'>      Last Name  	</a> </td>\n";
    echo "</tr>";
	
	$i=1;
    while ($row = mysql_fetch_assoc($result))
	{
		$i++;
		if( ($i % 2) == 0 ) 
	        echo "<tr bgcolor='#e0e0e0'>\n";
		else 
	        echo "<tr>\n";
		echo "<td><a href='employeelaptoprecord.php?id=". $row['id'] . "'>" .  $row['first_name']  . "</a></td>\n";
        echo "<td><a href='employeelaptoprecord.php?id=". $row['id'] . "'>" .  $row['middle_name'] . "</a></td>\n";
        echo "<td><a href='employeelaptoprecord.php?id=". $row['id'] . "'>" .  $row['last_name']   . "</a></td>\n";
        echo "</tr>";
    }
    echo "</table>";


    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>
