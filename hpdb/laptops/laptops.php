<?php
//For developing only !
error_reporting(E_ALL);
ini_set("display_errors", TRUE);

// open connction with MySQL server Kiosk.
include_once('connect-db.php');

function printpaptops($connection)
{
    $sql  = "SELECT *";
	$sql .=" FROM laptops";
	$sql .=" LEFT JOIN employee";
	$sql .=" ON laptops.empoyee_id=employee.id";
	$sql .=" WHERE true";

	$q_tag = "";
	$q_first_name = "";
	$q_middle_name = "";
	$q_last_name = "";
	$q_notes = "";

	if(isset($_GET['qq']))
	{
		if( isset($_GET['q_tag'] ))			$q_tag 			= mysql_real_escape_string(htmlspecialchars(trim($_GET['q_tag'])));
		if( isset($_GET['q_first_name'] ))	$q_first_name 	= mysql_real_escape_string(htmlspecialchars(trim($_GET['q_first_name'])));
		if( isset($_GET['q_middle_name'] ))	$q_middle_name	= mysql_real_escape_string(htmlspecialchars(trim($_GET['q_middle_name'])));
		if( isset($_GET['q_last_name'] ))	$q_last_name	= mysql_real_escape_string(htmlspecialchars(trim($_GET['q_last_name'])));
		if( isset($_GET['q_notes'] ))		$q_notes		= mysql_real_escape_string(htmlspecialchars(trim($_GET['q_notes'])));

		if( $q_tag 			)	$sql .= " AND tag='$q_tag'";
		if( $q_first_name 	)	$sql .= " AND first_name='$q_first_name'";
		if( $q_middle_name	)	$sql .= " AND middle_name='$q_middle_name'";
		if( $q_last_name	)	$sql .= " AND last_name='$q_last_name'";
		if( $q_notes		)	$sql .= " AND notes='$q_notes'";
	}

    $result = mysql_query($sql, $connection);

    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
	}
	$rows = mysql_num_rows($result);
?>
	<form action='' method='GET'>
	<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>
	<tr background="img/1.gif">
	<td colspan="4">
		<b>  <?php if($rows>1) echo "Find $rows laptops"; else if ($rows==1) echo "Find one laptop"; else echo "No laptops found"; ?> </b>
	</td>	
		<td>
			<input type="submit" name="qq" value="GO">
			<input type="submit" name="clear" value="Clear">
		</td>
<tr>
    <tr background="img/1.gif">
	<td><input type="text" size="25" name="q_tag"         value="<?=$q_tag?>" /> 	</td>
	<td><input type="text" size="25" name="q_first_name"  value="<?=$q_first_name?>" />	</td>
	<td><input type="text" size="25" name="q_middle_name" value="<?=$q_middle_name?>" /> 	</td>
	<td><input type="text" size="25" name="q_last_name"   value="<?=$q_last_name?>" /> 	</td>
	<td><input type="text" size="25" name="q_notes"       value="<?=$q_notes?>" /> 	</td>
    </tr>
<tr>
    <tr background="img/1.gif">
	<td>Tag</td>
	<td>First Name</td>
	<td>Middle Name</td>
	<td>Last Name</td>
	<td>Notes</td>
    </tr>
<?php
	$i=1;
    while ($row = mysql_fetch_array($result))
	{
		if( ($i++ % 2) == 0) // chenge 1 in to 2 for alternaiting colors in the rows
	        echo "<tr>\n";
		else
			echo "<tr bgcolor ='#e0e0e0'>\n";

		echo "<td><a href='edtLaptop.php?id="   . $row[0] . "'>" . $row['tag']         ."</a></td>\n"; 
		echo "<td><a href='edtEmployee.php?id=" . $row[2] . "'>" . $row['first_name']  ."</a></td>\n";
		echo "<td><a href='edtEmployee.php?id=" . $row[2] . "'>" . $row['middle_name'] ."</a></td>\n";
		echo "<td><a href='edtEmployee.php?id=" . $row[2] . "'>" . $row['last_name']   ."</a></td>\n";
		echo "<td><a href='edtLaptop.php?id="   . $row[0] . "'>" . $row['notes']       ."</a></td>\n";
        echo "</tr>";
    }
    echo "</table> </form>";
	mysql_free_result($result);
}
?>
<html>
<head>
<title> Laptop Inventory </title>

<link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<header>
<script src="javascript/jadding.js" type="text/javascript"></script>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href=""> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign='middle' align="right">
<button onclick="add('addLaptop.php')">Add Laptop</button> <br> <br>
<button onclick="add('addEmployee.php')">Add Employee</button> <br> <br>
</td></tr>
</table>
</header>

<body>
<?php printpaptops($connection); ?>
</body>

<?php
// closing MySQL connection with the server.
mysql_close($connection);
?>
</html>
