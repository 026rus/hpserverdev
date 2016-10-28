<html>
<head>
<title> Kiosk Records </title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php

    $id         = "";
    $firstname  = "";
    $lastname   = "";
    $company    = "";
    $country    = "";
    $reason     = "";
    $sponsor    = "";
    $datein     = "";
    $dateout    = "";
    $tempbadge  = "";
    $sb         = "";
    $order = 0;

    include('connect-db.php');

    $sql  = "SELECT *";
    $sql .=" FROM records";
    if(isset($_GET['qq']))
	{
		$sql .= " WHERE true ";
        if(isset($_GET['id']))    		$id   		= mysql_real_escape_string(htmlspecialchars(trim($_GET['id'])));
        if(isset($_GET['firstname']))   $firstname  = mysql_real_escape_string(htmlspecialchars(trim($_GET['firstname'])));
        if(isset($_GET['lastname']))	$lastname   = mysql_real_escape_string(htmlspecialchars(trim($_GET['lastname'])));
        if(isset($_GET['company']))    	$company   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['company'])));
        if(isset($_GET['country']))		$country   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['country'])));
        if(isset($_GET['reason']))		$reason   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['reason'])));
        if(isset($_GET['sponsor']))		$sponsor   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['sponsor'])));
        if(isset($_GET['datein']))		$datein   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['datein'])));
        if(isset($_GET['dateout']))    	$dateout   	= mysql_real_escape_string(htmlspecialchars(trim($_GET['dateout'])));
        if(isset($_GET['tempbadge']))   $tempbadge  = mysql_real_escape_string(htmlspecialchars(trim($_GET['tempbadge'])));

        if($id != "") 			$sql .=" AND id=". 				"'"    .$id.		"'";
        if($firstname != "") 	$sql .=" AND firstname LIKE ". 	"'%"   .$firstname.	"%'";
        if($lastname != "") 	$sql .=" AND lastname LIKE ".	"'%"   .$lastname.	"%'";
        if($company != "") 		$sql .=" AND company LIKE ". 	"'%"   .$company.	"%'";
        if($country != "") 		$sql .=" AND country LIKE ". 	"'%"   .$country.	"%'";
        if($reason != "") 		$sql .=" AND reason LIKE ". 	"'%"   .$reason.	"%'";
        if($sponsor != "") 		$sql .=" AND sponsor LIKE ".	"'%"   .$sponsor.	"%'";
        if($datein != "") 		$sql .=" AND datein LIKE ". 	"'%"   .$datein.	"%'";
        if($dateout != "") 		$sql .=" AND dateout LIKE ". 	"'%"   .$dateout.	"%'";
		if($tempbadge != "") 	$sql .=" AND tempbadge LIKE ".	"'%"   .$tempbadge.	"%'";
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
<form method="post" action="getcsvrecords.php">
<input type="hidden" name="id"			value="<?= $id ?>" /> 
<input type="hidden" name="firstname"	value="<?= $firstname ?>" />
<input type="hidden" name="lastname"	value="<?= $lastname ?>" />
<input type="hidden" name="company"		value="<?= $company ?>" />
<input type="hidden" name="country"		value="<?= $country ?>" /> 
<input type="hidden" name="reason"		value="<?= $reason ?>" /> 
<input type="hidden" name="sponsor"		value="<?= $sponsor ?>" /> 
<input type="hidden" name="datein"		value="<?= $datein ?>" /> 
<input type="hidden" name="dateout"		value="<?= $dateout ?>" /> 
<input type="hidden" name="tempbadge"	value="<?= $tempbadge ?>" /> 
<input type="hidden" name="order"   	value="<?= $order ?>" /> 
<input type="hidden" name="sb"	        value="<?= $sb ?>" /> 
<button type="submit">Download</button>
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
	<td colspan="9" align="center">As of 2/12/2016 Date in/out reflects actual scanning of temp badges</td>
	<td>
        <input type="submit" name="qq" value="Query">
        <input type="submit" name="clear" value="Clear"></td>
    </tr>
    <tr background="img/1.gif">
		<td><input type="text" size="2" name="id"			value="<?= $id ?>" /> </td>
		<td><input type="text" size="20" name="firstname"	value="<?= $firstname ?>" /> </td>
        <td><input type="text" size="20" name="lastname"	value="<?= $lastname ?>" /> </td>
        <td><input type="text" size="20" name="company"		value="<?= $company ?>" /> </td>
        <td><input type="text" size="20" name="country"		value="<?= $country ?>" /> 
        <td><input type="text" size="20" name="reason"		value="<?= $reason ?>" /> 
        <td><input type="text" size="20" name="sponsor"		value="<?= $sponsor ?>" /> 
        <td><input type="text" size="20" name="datein"		value="<?= $datein ?>" /> 
        <td><input type="text" size="20" name="dateout"		value="<?= $dateout ?>" /> 
        <td><input type="text" size="5" name="tempbadge"	value="<?= $tempbadge ?>" /> 
    </tr>
    </form>
<?php


    echo "<tr>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=id'>			ID         	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=firstname'>     First Name 	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=lastname'>      Last Name  	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=company'>      	Company    	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=country'>      	Country    	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=reason'>      	Reason  	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=sponsor'>      	Sponsor  	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=datein'>      	Date In  	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=dateout'>      	Date Out  	</a> </td>\n";
    echo "<td><a href='records.php?ord=". $order . "&sb=tempbadge'>     Temp Badge  </a> </td>\n";
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
        echo "<td>" . $row['firstname']  . "</td>\n";
        echo "<td>" . $row['lastname']   . "</td>\n";
        echo "<td>" . $row['company']    . "</td>\n";
        echo "<td>" . $row['country']    . "</td>\n";
        echo "<td>" . $row['reason']     . "</td>\n";
        echo "<td>" . $row['sponsor']    . "</td>\n";
        echo "<td>" . $row['datein']     . "</td>\n";
        echo "<td>" . $row['dateout']    . "</td>\n";
        echo "<td>" . $row['tempbadge']  . "</td>\n";
        echo "</tr>";
    }
    echo "</table>";


    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>
