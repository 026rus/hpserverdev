<html>
<head>
<title>Shiping Records</title>
<link rel="stylesheet" type="text/css" href="style/popup.css" />
<?php
    include('connect-db.php');
	if (isset($_POST['project_name']))
	{
   		// get form data, making sure it is valid
   		$project_name   = mysql_real_escape_string(htmlspecialchars($_POST['project_name']));
   		$serial_number  = mysql_real_escape_string(htmlspecialchars($_POST['serial_number']));
   		$tracking_number= mysql_real_escape_string(htmlspecialchars($_POST['tracking_number']));

        // save the data to the database
        mysql_query("INSERT INTO ae_shipoff VALUE(null, '$project_name', '$serial_number', '$tracking_number', NOW() )")
        or die(mysql_error());

	}
?>
<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign="middle" align="right">
</td> </tr>
</table>
</header>

</head>
<body onload='setFocus()'>
<form method="post" action="insirtshiping.php" onkeypress="return event.keyCode != 13;" >
<!-- <form method="post" action="insirtshiping.php" >-->
	<script>
	function setFocus()
	{
		document.getElementById("1").focus();
	}
   	function testing(event,number)
    {
        if( event.keyCode == 13 )
		{
			var focused = document.activeElement;
			if (!focused || focused == document.body)
				    focused = null;
			else if (document.querySelector)
				    focused = document.querySelector(":focus");

			if (focused.id === "3" )
			{
				document.activeElement.click();
			}
			else
			{
			event.stopPropagation();
			event.preventDefault();
			}
            var wow = document.getElementById(number);
            wow.focus();
        }        
    }
	</script>
<table align ='center' border='0' >
<tr>
<?php
    $sql  = "SELECT *";
    $sql .= " FROM projects";
	$result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>Project Name</strong></td>       <td align="left">';
    echo '<select name="project_name">';
    while ( $row = mysql_fetch_assoc($result) )
    {
         echo "<option "; 
         if ( $row['id'] == '1' ) echo " selected ";
         echo " value=\"" . $row['id'] . "\">" . $row['tag'] . "</option>\n";
    }
    echo "</select>";

?>
</tr> <tr>
<td align="right"><strong>Serial Number</strong></td>   
 <td align="left"> <input type="text" size="35" name="serial_number" value="" id="1" onkeyup="testing(event, 2)"/><br/></td>
</tr> <tr>
<td align="right"><strong>Tracking Number</strong></td>    
 <td align="left"> <input type="text" size="35" name="tracking_number" value="" id="2" onkeyup="testing(event, 3)"/><br/></td>
</tr> <tr>
</tr>
<tr>
 <td colspan="2" align= "center">
	<input type="submit" value="Ship" id="3" onkeyup="testing(event, 3)">
&nbsp;
	<input type="reset" value="Clear" >
</td>
</tr>
</table>
</form>
	</p>
  </div>
</div>

<?php
    $sql  = "SELECT ae_shipoff.id, ae_shipoff.project, ae_shipoff.serial, ae_shipoff.tracking, ae_shipoff.date, projects.id, projects.name, projects.tag";
    $sql .= " FROM ae_shipoff, projects WHERE ae_shipoff.project=projects.id";
    $sql .= " ORDER BY ae_shipoff.id DESC";
	$result = mysql_query($sql, $connection);

	if (!$result)
	{
		echo "DB Error, could not query the database:<br>\n";
		echo 'MySQL Error: ' . mysql_error();
		exit;
	}
	
	echo "<table border='1' align='center' style='width:50%; border: 1px solid black; border-collapse: collapse;'>";
        echo "<td> Project Name </td>\n";
        echo "<td> Serial Number  </td>\n";
        echo "<td> Tracking Number </td>\n";
        echo "<td> Date </td>\n";

	$i=1;
    while ($row = mysql_fetch_assoc($result))
	{
		$i++;
		if( ($i % 2) == 0 ) 
	        echo "<tr bgcolor='#e0e0e0'>\n";
		else 
	        echo "<tr>\n";
        echo "<td>" . $row['name']  . "</td>\n";
        echo "<td>" . $row['serial']   . "</td>\n";
        echo "<td>" . $row['tracking']    . "</td>\n";
        echo "<td>" . $row['date']    . "</td>\n";
        echo "</tr>";
    }
    echo "</table>";


    mysql_free_result($result);
    mysql_close($connection);
?>



</body>
</html>
