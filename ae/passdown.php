<html>
<head>
<title> Kiosk Records </title>
<link rel="stylesheet" type="text/css" href="style.css" />
</head>

<?php

    $id				= "";
    $incident		= "";
    $createTime		= "";
    $createDate		= "";
    $problemDetails	= "";
    $currentStatus	= "";
    $nextAction		= "";
    $modifiedDate	= "";
    $modifiedBy		= "";
    $latesUpdate	= "";
	
	$tableName		= "passdown";
    include('connect-db.php');

    $sql  = "SELECT *";
    $sql .=" FROM ". $tableName;
    $result = mysql_query($sql, $connection);
?>

<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign="middle" align="right">

<form method="post" action="getcsvrecords.php">
<input type="hidden" name="id"				value="<?= $id ?>" /> 
<input type="hidden" name="incident"		value="<?= $incident ?>" />
<input type="hidden" name="createTime"		value="<?= $createTime ?>" />
<input type="hidden" name="createDate"		value="<?= $createDate ?>" />
<input type="hidden" name="problemDetails"	value="<?= $problemDetails ?>" />
<input type="hidden" name="currentStatus"	value="<?= $currentStatus ?>" />
<input type="hidden" name="nextAction"		value="<?= $nextAction ?>" />
<input type="hidden" name="modifiedDate"	value="<?= $modifiedDate ?>" />
<input type="hidden" name="mosifiedBy"		value="<?= $mosifiedBy ?>" />
<input type="hidden" name="latesUpdate"		value="<?= $latesUpdate ?>" />
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
		echo "<br>\nSQL: " . $sql;
        exit;
    }
    
    echo "<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>";


    echo "<tr style=\"color: #fff; background: black; font-size: 15pt\" >\n";
    echo "<td>	Incident ID/Issue ID	</td>\n";
    echo "<td>	Create Time				</td>\n";
    echo "<td>	Create Date				</td>\n";
    echo "<td>	Problem details			</td>\n";
    echo "<td>	Current Status			</td>\n";
    echo "<td>	Next Action Neded		</td>\n";
    echo "<td>	Modified-date			</td>\n";
    echo "<td>	Last-modified-by 		</td>\n";
    echo "<td>	Latest Update			</td>\n";
    echo "</tr>";
	
	$i=1;
    while ($row = mysql_fetch_assoc($result))
	{
		$i++;
		if( ($i % 2) == 0 ) 
	        echo "<tr  id=\"editRow\" bgcolor='#e0e0e0'>\n";
		else 
	        echo "<tr id=\"editRow\" >\n";
		echo "<input type=\"hidden\" name=\"id\"	value=\" ". $row['id'] .  "\" > \n";
		echo "<td>" . $row['incident']		. "</td>\n";
		echo "<td>" . $row['createTime']	. "</td>\n";
		echo "<td>" . $row['createDate']	. "</td>\n";
		echo "<td>" . $row['problemDetails']. "</td>\n";
		echo "<td>" . $row['currentStatus']	. "</td>\n";
		echo "<td>" . $row['nextAction']	. "</td>\n";
		echo "<td>" . $row['modifiedDate']	. "</td>\n";
		echo "<td>" . $row['modifiedBy']	. "</td>\n";
		echo "<td>" . $row['latesUpdate']	. "</td>\n";

        echo "</tr>";
    }
    echo "</table>";
	
?>
	<!-- Trigger/Open The Modal -->
	<button id="addBtn">Add</button>

	<!-- The Modal -->
	<div id="myModal" class="modal">

	<!-- Modal content -->
    <div class="modal-content">
	<span class="close">x</span>
	<p>
    	<table border='1' style='border: 1px solid black; border-collapse: collapse;'>
    	<form method="post" action="insertpassdownitem.php">
		<input type="hidden" name="id" value="<?= $id ?>" />
		<tr><td> Incident ID/Issue ID	 </td> <td>	<input type="text" name="incident"			value="<?= $incident ?>" />			</td></tr>
		<tr><td> Create Time			 </td> <td>	<input type="text" name="createTime"		value="<?= $createTime ?>" />		</td></tr>
		<tr><td> Create Date			 </td> <td>	<input type="text" name="createDate"		value="<?= $createDate ?>" />		</td></tr>
		<tr><td> Problem details		 </td> <td>	<input type="text" name="problemDetails"	value="<?= $problemDetails ?>" />	</td></tr>
		<tr><td> Current Status			 </td> <td>	<input type="text" name="currentStatus"		value="<?= $currentStatus ?>" />	</td></tr>
		<tr><td> Next Action Neded		 </td> <td>	<input type="text" name="nextAction"		value="<?= $nextAction ?>" />		</td></tr>
		<tr><td> Modified-date			 </td> <td>	<input type="text" name="modifiedDate"		value="<?= $modifiedDate ?>" />		</td></tr>
		<tr><td> Last-modified-by 		 </td> <td>	<input type="text" name="mosifiedBy"		value="<?= $mosifiedBy ?>" />		</td></tr>
		<tr><td> Latest Update			 </td> <td>	<input type="text" name="latesUpdate"		value="<?= $latesUpdate ?>" />		</td></tr>
		</table>
		<button type="submit">Save</button>
		</form>
	</p>
	</div>

	</div>

	<script>
		// Get the modal
		var modal = document.getElementById('myModal');
		// Get the button that opens the modal
		var btn = document.getElementById("addBtn");
		
		// Get the <span> element that closes the modal
		var span = document.getElementsByClassName("close")[0];
		
		// When the user clicks the button, open the modal
		btn.onclick = function() 
		{
		    modal.style.display = "block";
    	}
		
		// When the user clicks on <span> (x), close the modal
		span.onclick = function() 
		{
			modal.style.display = "none";
		}
		
		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) 
		{
			if (event.target == modal) 
			{
				modal.style.display = "none";
			}
		}
	</script>
<?php
    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>
