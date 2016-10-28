<?php
ini_set('display_errors',1);  error_reporting(E_ALL);
?>
<html>
<head>
<title> Kiosk Qeuipment Records </title>

<link rel="stylesheet" type="text/css" href="style.css" />

</head>

<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td>
</table>
</header>
<body>
<?php

		$id = ""; 
		$tag = "";
        $equipmentname = "";
		$firstname = "";
        $lastname = "";
        $notes = "";
        $dataout = "";
        $datain = "";
	$order = 0;
    include('connect-db.php');

    $sql  = "SELECT *";
    $sql .=" FROM checkoutrecords";
    if(isset($_GET['qq']))
	{
		$sql .= " WHERE true ";
        if(isset($_GET['id']))    			$id   			= mysql_real_escape_string(htmlspecialchars(trim($_GET['id'])));
        if(isset($_GET['tag'])) 	   		$tag	   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['tag'])));
        if(isset($_GET['equipmentname']))	$equipmentname	= mysql_real_escape_string(htmlspecialchars(trim($_GET['equipmentname'])));
        if(isset($_GET['firstname']))    	$firstname   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['firstname'])));
        if(isset($_GET['lastname']))		$lastname   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['lastname'])));
        if(isset($_GET['notes']))    		$notes   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['notes'])));
        if(isset($_GET['dataout']))    		$dataout   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['dataout'])));
        if(isset($_GET['datain']))			$datain   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['datain'])));

        if($id != "") 			$sql .=" AND id=". 					"'"  	.$_GET['id'].		"'";
        if($tag != "") 	   		$sql .=" AND tag LIKE " .			"'%" 	.$_GET['tag'].			 "%'";
        if($equipmentname != "")$sql .=" AND equipmentname LIKE ". 	"'%" 	.$_GET['equipmentname']. "%'";
        if($firstname != "") 	$sql .=" AND firstname LIKE ". 		"'%"   	.$_GET['firstname'].	 "%'";
        if($lastname != "") 	$sql .=" AND lastname LIKE ".		"'%"   	.$_GET['lastname'].		 "%'";
        if($notes != "")   		$sql .=" AND notes LIKE ".  		"'%" 	.$_GET['notes'].		 "%'";
        if($dataout != "") 		$sql .=" AND dataout LIKE ". 		"'%"   	.$_GET['dataout'].		 "%'";
        if($datain != "") 		$sql .=" AND datain LIKE ". 		"'%"   	.$_GET['datain'].		 "%'";
	}

	if ( isset($_GET['sb']) )
		if ( $_GET['ord'] == 0 )
		{
			$sql .= " ORDER BY " .  mysql_real_escape_string( htmlspecialchars($_GET['sb']) ) . " ASC";
			$order = 1;
		}
		else
		{
			$sql .= " ORDER BY " .  mysql_real_escape_string( htmlspecialchars($_GET['sb']) . " DESC");
			$order = 0;
		}

    
    $result = mysql_query($sql, $connection);

    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    
	echo "<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>";
?>
    <form action="" method="get">
    <tr>
		<td><input type="text" size="2" name="id"				value="<?= $id ?>" /> </td>
		<td><input type="text" size="20" name="tag"				value="<?= $tag ?>" /> </td>
        <td><input type="text" size="20" name="equipmentname"	value="<?= $equipmentname ?>" /> </td>
		<td><input type="text" size="20" name="firstname"		value="<?= $firstname ?>" /> </td>
        <td><input type="text" size="20" name="lastname"		value="<?= $lastname ?>" /> </td>
        <td><input type="text" size="20" name="notes"			value="<?= $notes ?>" /> </td>
        <td><input type="text" size="20" name="dataout"			value="<?= $dataout ?>" /> </td>
        <td><input type="text" size="20" name="datain"			value="<?= $datain ?>" /> 
        <input type="submit" name="qq" value="GO">
        <input type="submit" name="clear" value="Clear"></td>
    </tr>
    </form>
<?php

    echo "<tr>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=id'>      		ID         		</a></td>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=tag'>     		Tag         	</a></td>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=equipmentname'> Equipment Name  </a></td>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=firstname'>     First Name 		</a></td>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=lastname'>      Last Name  		</a></td>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=notes'>      	notes    		</a></td>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=dataout'>      	Date Out  		</a></td>\n";
    echo "<td><a href='equipmentrecords.php?ord=". $order . "&sb=datain'>      	Date In  		</a></td>\n";
    echo "</tr>";

	$i=1;
    while ($row = mysql_fetch_assoc($result))
    {
		$i++;
		if( ($i % 2) == 0 ) 
	        echo "<tr bgcolor='#e0e0e0'>\n";
		else 
	        echo "<tr>\n";
        echo "<td>" . $row['id']         	. "</td>\n";  
        echo "<td>" . $row['tag']        	. "</td>\n";  
        echo "<td>" . $row['equipmentname']	. "</td>\n";  
        echo "<td>" . $row['firstname']  	. "</td>\n";
        echo "<td>" . $row['lastname']   	. "</td>\n";
        echo "<td>" . $row['notes'] 	 	. "</td>\n";
        echo "<td>" . $row['dataout']    	. "</td>\n";
        echo "<td>" . $row['datain']     	. "</td>\n";
        echo "</tr>";
    }
    echo "</table>";


    mysql_free_result($result);
	mysql_close($connection);
?>
</body>
</html>
