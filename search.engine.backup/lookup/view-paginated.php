<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<title>View Records</title>
<style type="text/css" media="screen">
header {
width:100%;
text-align:center;
}

</style>

</head>
<header>
<a href="/searchenc.php"> <img src="/images/johnson-johnson-logo.png" alt="logo" /> </a>
</header>

<body>

<?php
/* 
	VIEW-PAGINATED.PHP
	Displays all data from 'EnclosureInfo' table
	This is a modified version of view.php that includes pagination
*/

	// connect to the database
	include('connect-db.php');
	
	// number of results to show per page
	$per_page = 10;
	
	// figure out the total pages in the database
	$result = mysql_query("SELECT * FROM EncInfo");
	$total_results = mysql_num_rows($result);
	$total_pages = ceil($total_results / $per_page);

	// check if the 'page' variable is set in the URL (ex: view-paginated.php?page=1)
	if (isset($_GET['page']) && is_numeric($_GET['page']))
	{
		$show_page = $_GET['page'];
		
		// make sure the $show_page value is valid
		if ($show_page > 0 && $show_page <= $total_pages)
		{
			$start = ($show_page -1) * $per_page;
			$end = $start + $per_page; 
		}
		else
		{
			// error - show first set of results
			$start = 0;
			$end = $per_page; 
		}		
	}
	else
	{
		// if page isn't set, show first set of results
		$start = 0;
		$end = $per_page; 
	}
	
	// display pagination
	
	echo "<p><a href='/searchenc.php'>Search</a> | <a href='view.php'>View All</a> | <b>View Page:</b></p> ";
	for ($i = 1; $i <= $total_pages; $i++)
	{
		echo "<a href='view-paginated.php?page=$i'>$i</a> ";
	}
	echo "</p>";
		
	// display data in table
	echo "<table border='1' cellpadding='10'>";
	echo "<tr> <th>ID</th> <th>Location</th> <th>Enclosure Name</th> <th>Enclosure Link</th> <th>VC Address</th><th>Enclosure SN</th><th>OA 1 SN</th><th>OA 2 SN</th><th></th><th>OA FW</th><th>VC FW</th><th>VC Type</th><th>Enclosure FW Current?</th><th>Comments</th><th>Server 1</th><th>Server 2</th><th>Server 3</th><th>Server 4</th><th>Server 5</th><th>Server 6</th><th>Server 7</th><th>Server 8</th><th>Server 9</th><th>Server 10</th><th>Server 11</th><th>Server 12</th><th>Server 13</th><th>Server 14</th><th>Server 15</th><th>Server 16</th><th>Modified</th><th>Modified By</th><th>Grid Location</th></tr>";
	// loop through results of database query, displaying them in the table	
	for ($i = $start; $i < $end; $i++)
	{
		// make sure that PHP doesn't try to show results that don't exist
		if ($i == $total_results) { break; }
	
		// echo out the contents of each row into a table
		echo "<tr>";
		echo '<td>' . mysql_result($result, $i, 'ID') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Site') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'EnclosureName') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'EnclosureLink') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'VCAddress') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'EnclosureSN') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'OA1SN') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'OA2SN') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'EnclosureModel	') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'EnclosureFirmware') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'VCFirmware') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'TypeofVC') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'EnclosureFirmwareCurrent') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Comments') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server1') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server2') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server3') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server4') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server5') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server6') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server7') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server8') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server9') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server10') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server11') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server12') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server13') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server14') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server15') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'Server16') . '</td>';
//		echo '<td>' . mysql_result($result, $i, 'lastname') . '</td>';		
		echo '<td>' . mysql_result($result, $i, 'Modified') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'ModifiedBy') . '</td>';
		echo '<td>' . mysql_result($result, $i, 'GridLocation') . '</td>';
	//	echo '<td>' . mysql_result($result, $i, 'ID') . '</td>';
	
		
		echo '<td><a href="edit.php?ID=' . mysql_result($result, $i, 'ID') . '">Edit</a></td>';
		echo '<td><a href="delete.php?ID=' . mysql_result($result, $i, 'ID') . '">Delete</a></td>';
		echo "</tr>"; 
	}
	// close table>
	echo "</table>"; 
	
	// pagination
	
?>
<p><a href="new.php">Add a new record</a></p>

</body>
</html>
