<html>
<head>
<title> Laptop Records </title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php

    $id         = "";
    $tag        = "";
    $datein     = "";
    $dateout    = "";
    $first_name  = "";
    $middle_name = "";
    $last_name   = "";
    $email      = "";
    $photo      = "";
    $sb         = "";
    $order = 1;

    include('connect-db.php');

    $sql  = "SELECT laptoprecords.id, laptoprecords.tag, laptoprecords.employee, laptoprecords.dateout, laptoprecords.datein, ";
    $sql .= "employee.first_name, employee.middle_name, employee.last_name, employee.email, employee.photo";
    $sql .=" FROM laptoprecords, employee";
	$sql .= " WHERE laptoprecords.employee=employee.id ";
    if(isset($_GET['qq']))
	{
        if(isset($_GET['id']))    		$id   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['id'])));
        if(isset($_GET['tag']))			$tag   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['tag'])));
        if(isset($_GET['datein']))		$datein   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['datein'])));
        if(isset($_GET['dateout']))    	$dateout   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['dateout'])));
        if(isset($_GET['first_name']))  $first_name = mysql_real_escape_string(htmlspecialchars(trim($_GET['first_name'])));
        if(isset($_GET['middle_name'])) $middle_name= mysql_real_escape_string(htmlspecialchars(trim($_GET['middle_name'])));
        if(isset($_GET['last_name']))	$last_name  = mysql_real_escape_string(htmlspecialchars(trim($_GET['last_name'])));
        if(isset($_GET['email']))    	$email   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['email'])));
        if(isset($_GET['photo']))		$photo   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['photo'])));

        if($id != "") 			$sql .=" AND laptoprecords.id=". 				"'"    .$id.		"'";
        if($tag != "") 			$sql .=" AND tag LIKE ". 		"'%"   .$tag.	"%'";
        if($datein != "") 		$sql .=" AND datein LIKE ". 	"'%"   .$datein.	"%'";
        if($dateout != "") 		$sql .=" AND dateout LIKE ". 	"'%"   .$dateout.	"%'";
        if($first_name != "") 	$sql .=" AND first_name LIKE ". "'%"   .$first_name.	"%'";
        if($middle_name != "") 	$sql .=" AND middle_name LIKE ". "'%"  .$middle_name.	"%'";
        if($last_name != "") 	$sql .=" AND last_name LIKE ".	"'%"   .$last_name.	"%'";
        if($email != "") 		$sql .=" AND email LIKE ". 		"'%"   .$email.	"%'";
        if($photo != "") 		$sql .=" AND photo LIKE ". 		"'%"   .$photo.	"%'";
	}
    if(isset($_GET['sb']))          $sb         = mysql_real_escape_string(htmlspecialchars(trim($_GET['sb'])));

	if ( isset($_GET['sb']) )
	{
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
	}
	else
	{
			$sql .= " ORDER BY  laptoprecords.id DESC";
	}

    $result = mysql_query($sql, $connection);
?>

<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign="middle" align="right">
<input type="hidden" name="id"			value="<?= $id ?>" /> 
<input type="hidden" name="tag"			value="<?= $tag ?>" /> 
<input type="hidden" name="datein"		value="<?= $datein ?>" /> 
<input type="hidden" name="dateout"		value="<?= $dateout ?>" /> 
<input type="hidden" name="first_name"	value="<?= $first_name ?>" />
<input type="hidden" name="middle_name"	value="<?= $middle_name ?>" />
<input type="hidden" name="last_name"	value="<?= $last_name ?>" />
<input type="hidden" name="email"		value="<?= $email ?>" />
<input type="hidden" name="photo"		value="<?= $photo ?>" /> 
<input type="hidden" name="order"   	value="<?= $order ?>" /> 
<input type="hidden" name="sb"	        value="<?= $sb ?>" /> 
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
    
	echo "\n<ul class=\"enlarge\">\n";
    echo "<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>";
?>
	<form action="" method="get">
	<tr background="img/1.gif">
	<td colspan="8" align="center"></td>
	<td>
        <input type="submit" name="qq" value="Query">
        <input type="submit" name="clear" value="Clear"></td>
    </tr>
    <tr background="img/1.gif">
		<td><input type="text" size="2" name="id"			value="<?= $id ?>" /> </td>
		<td><input type="text" size="20" name="tag"			value="<?= $tag ?>" /> </td>
        <td><input type="text" size="20" name="datein"		value="<?= $datein ?>" /> 
        <td><input type="text" size="20" name="dateout"		value="<?= $dateout ?>" /> 
		<td><input type="text" size="20" name="first_name"	value="<?= $first_name ?>" /> </td>
		<td><input type="text" size="20" name="middle_name"	value="<?= $middle_name ?>" /> </td>
        <td><input type="text" size="20" name="last_name"	value="<?= $last_name ?>" /> </td>
        <td><input type="text" size="20" name="email"		value="<?= $email ?>" /> </td>
        <td><input type="text" size="20" name="photo"		value="<?= $photo ?>" /> 
    </tr>
    </form>
<?php


    echo "<tr>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=id'>			ID         	</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=tag'>     		Tag 		</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=datein'>      	Date In  	</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=dateout'>      Date Out  	</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=first_name'>   First Name 	</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=middle_name'>  Middle  Name 	</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=last_name'>    Last Name  	</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=email'>      	Email    	</a> </td>\n";
    echo "<td><a href='rowlaptoprecords.php?ord=". $order . "&sb=photo'>      	Photo    	</a> </td>\n";
    echo "</tr>";
	$i=1;
    while ($row = mysql_fetch_assoc($result))
	{
		$i++;
		if( ($i % 2) == 0 ) 
	        echo "<tr bgcolor='#e0e0e0'>\n";
		else 
	        echo "<tr>\n";
        echo "<td>" . $row['id']         . "</td>";  
        echo "<td>" . $row['tag']		 . "</td>\n";
        echo "<td>" . $row['datein']     . "</td>\n";
        echo "<td>" . $row['dateout']    . "</td>\n";
        echo "<td>" . $row['first_name'] . "</td>\n";
        echo "<td>" . $row['middle_name']. "</td>\n";
        echo "<td>" . $row['last_name']  . "</td>\n";
        echo "<td>" . $row['email']    	 . "</td>\n";
        echo "<td> \n <li>\n <img src=\"people/" . $row['photo'] . "\" width=\"63px\" height=\"51px\">\n";
		echo "<span>\n";
        echo "<img src=\"people/" . $row['photo']    	 . "\" width=\"334px\" height=\"302px\">\n";
		echo "</span>\n</li>\n</td>\n";
        echo "</tr>";
    }
    echo "</table>";
	echo "</ul>";

    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>
