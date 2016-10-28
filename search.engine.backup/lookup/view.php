<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>View Records</title>
<style type="text/css" media="screen">
header {
width:100%;
text-align:center;
}

h1 { 
font-size: 200%;
text-align:center;
}


</style>

</head>
<header>
<a href="/searchenc.php"> <img src="/images/johnson-johnson-logo.png" alt="logo" /> </a>
</header>

<body>

<h1><strong>All Enclosures</strong></h1>


<?php
/* 
	VIEW.PHP
	Displays all data from 'EnclosureInfo' table
*/

	// connect to the database
	include('connect-db.php');

	// get results from database
	$result = mysql_query("SELECT * FROM EncInfo") 
		or die(mysql_error());  
	
	// display data in table
	echo "<p><a href='/searchenc.php'>Search</a> |  <b>View All</b> | <a href='view-paginated.php?page=1'>View Paginated</a></p>";
	
	echo "<table border='1' cellpadding='10'>";
	echo "<tr> <th>ID</th> <th>Location</th> <th>Enclosure Name</th> <th>Enclosure Link</th> <th>VC Address</th><th>Enclosure SN</th><th>OA 1 SN</th><th>OA 2 SN</th><th></th><th>OA FW</th><th>VC FW</th><th>VC Type</th><th>Enclosure FW Current?</th><th>Comments</th><th>Server 1</th><th>Server 2</th><th>Server 3</th><th>Server 4</th><th>Server 5</th><th>Server 6</th><th>Server 7</th><th>Server 8</th><th>Server 9</th><th>Server 10</th><th>Server 11</th><th>Server 12</th><th>Server 13</th><th>Server 14</th><th>Server 15</th><th>Server 16</th><th>Modified</th><th>Modified By</th><th>Grid Location</th></tr>";
	// loop through results of database query, displaying them in the table
	while($row = mysql_fetch_array( $result )) {
		
		// echo out the contents of each row into a table
		echo "<tr>";
	        echo '<td>' . $row['ID'] . '</td>';	
		echo '<td>' . $row['Site'] . '</td>';
		echo '<td>' . $row['EnclosureName'] . '</td>';
		echo '<td>' . $row['EnclosureLink'] . '</td>';
		echo '<td>' . $row['VCAddress'] . '</td>';
		echo '<td>' . $row['EnclosureSN'] . '</td>';
		echo '<td>' . $row['OA1SN'] . '</td>';
		echo '<td>' . $row['OA2SN'] . '</td>';
		echo '<td>' . $row['EnclosureModel	'] . '</td>';
		echo '<td>' . $row['EnclosureFirmware'] . '</td>';
		echo '<td>' . $row['VCFirmware'] . '</td>';
		echo '<td>' . $row['TypeofVC'] . '</td>';
		echo '<td>' . $row['EnclosureFirmwareCurrent'] . '</td>';
		echo '<td>' . $row['Comments'] . '</td>';
		echo '<td>' . $row['Server1'] . '</td>';
		echo '<td>' . $row['Server2'] . '</td>';
		echo '<td>' . $row['Server3'] . '</td>';
		echo '<td>' . $row['Server4'] . '</td>';
		echo '<td>' . $row['Server5'] . '</td>';
		echo '<td>' . $row['Server6'] . '</td>';
		echo '<td>' . $row['Server7'] . '</td>';
		echo '<td>' . $row['Server8'] . '</td>';
		echo '<td>' . $row['Server9'] . '</td>';
		echo '<td>' . $row['Server10'] . '</td>';
		echo '<td>' . $row['Server11'] . '</td>';
		echo '<td>' . $row['Server12'] . '</td>';
		echo '<td>' . $row['Server13'] . '</td>';
		echo '<td>' . $row['Server14'] . '</td>';
		echo '<td>' . $row['Server15'] . '</td>';
		echo '<td>' . $row['Server16'] . '</td>';
		echo '<td>' . $row['Modified'] . '</td>';
		echo '<td>' . $row['ModifiedBy'] . '</td>';
		echo '<td>' . $row['GridLocation'] . '</td>';		
		
		echo '<td><a href="edit.php?ID=' . $row['ID'] . '">Edit</a></td>';
		echo '<td><a href="delete.php?ID=' . $row['ID'] . '">Delete</a></td>';
		echo "</tr>"; 
	} 

	// close table>
	echo "</table>";
?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html>	
