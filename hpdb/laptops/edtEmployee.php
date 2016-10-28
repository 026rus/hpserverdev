<?php
//For developing only !
error_reporting(E_ALL);
ini_set("display_errors", TRUE);
var_dump($_REQUEST);

function getdata()
{
	$id		=null;
	$FN		=null;
	$MN		=null;
	$LN		=null;
	$EMAIL	=null;
	$PHOTO	=null;
	
    include('connect-db.php');
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
    	$sql  = "select *";
    	$sql .= " from employee";
    	$sql .= " WHERE id =" . $id;

    	$result = mysql_query($sql, $connection);
    	if (!$result)
    	{
    	    echo "db error, could not query the database:<br>\n";
    	    echo 'mysql error: ' . mysql_error();
    	    exit;
    	}
		
		$row = mysql_fetch_assoc($result);
		$FN		= $row['first_name'];
		$MN		= $row['middle_name'];
		$LN		= $row['last_name'];
		$EMAIL	= $row['email'];
		$PHOTO	= $row['photo'];
	}
	?>
 <form action="" method="POST">
 <input type="hidden" name="id" value="<?=$id?>">
 <div>
 <table align="center" border='1'>
 <tr>
 	<td align="center"><input type="text" name="first_name"  value="<?=$FN?>"></input></td>
 	<td align="center"><input type="text" name="middle_name" value="<?=$MN?>"></input></td>
 	<td align="center"><input type="text" name="last_name"   value="<?=$LN?>"></input></td>
 </tr>
 <tr height="0">
 	<td align="right" valign="top"><strong>Email: </strong></td>
 	<td align="left" valign="top"><input type="text" name="email" value="<?=$EMAIL?>"></input></td>
	<th rowspan="2"><img src="../../kiosk/people/<?=$PHOTO?>" alt="Photo" height="150" width="150"></img></th>
 </tr>
 <tr>
	<td colspan="2" valign="top">
<?php
    $sql  = "select id, tag";
    $sql .= " from laptops where empoyee_id=".$id;
    $sql .= " order by id";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "db error, could not query the database:<br>\n";
        echo 'mysql error: ' . mysql_error();
        exit;
    }
	$i=0;
	echo "<table border='1' style=\"width:100%\">";
    while ( $row = mysql_fetch_assoc($result) )
    {
		$i++;
        $tag = "";
        $laptop_id = "";

        if ($row['tag'] != "") $tag = $row['tag'];
        if ($row['id'] != "") $laptop_id = $row['id'];
		echo "<tr> ";
		echo "<td>$i</td> <td><a href=\"edtLaptop.php?id=$laptop_id\">$tag</a></td>";
		echo "<td align=\"right\"><img src=\"img/delim.png\" alt=\"Delete\" height=\"20\" width=\"20\"></td>";
		echo "</tr> ";
		
    }
	echo "</table>";

?>
	</td>
 </tr>
 </table>

 <table align="center">
 <tr>
 <td align ="center">
 <p></p></td>
 <td align="center"> <input type="submit" name="submit" value="submit"></td>
 <td align="center"> <input type="submit" name="cancel" value="cancel"></td>
 </tr>
 </table>
 </div>
 </form>
	<?php
	mysql_free_result($result);
	mysql_close($connection);
}
function editEmployee()
{
	include_once('connect-db.php');

	// get form data, making sure it is valid
	$id         = mysql_real_escape_string(htmlspecialchars($_POST['id']));
	$first_name = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
	$middle_name = mysql_real_escape_string(htmlspecialchars($_POST['middle_name']));
	$last_name = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
	$email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	
	
	// check that firstname/lastname fields are both filled in
	if ($first_name == '')
	{
	    // generate error message
	    $error = 'ERROR: Please fill the First name required fields!';
	
	    //error, display form
	}
	else
	{
	    // save the data to the database
		// UPDATE `kiosk`.`laptops` SET `empoyee_id` = '83' WHERE `laptops`.`id` = 62;
		echo "<br>\n";
		$sql = "UPDATE employee SET first_name=\"$first_name\", middle_name=\"$middle_name\", last_name=\"$last_name\", email=\"$email\"WHERE id=$id";

		echo $sql . "<br>\n";
	    mysql_query($sql)
	    or die(mysql_error());
	
	    // once saved, redirect back to the view page
	    header("Location: laptops.php");
	}
	mysql_close($connection);
}

// check if it wos added! 
if (isset($_POST['submit']))
{
	editEmployee();
}
else if (isset($_POST['cancel']))
{
	// once saved, redirect back to the view page
	header("Location: laptops.php");
}
else
{
?>

<html>
<head>
<title>Add Laptop</title>

<link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<header>
<script src="javascript/jadding.js" type="text/javascript"></script>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="laptops.php"> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign='middle' align="right">
</td></tr>
</table>
</header>

<body>
<?php getdata(); ?>
</body>
</html>
<?php
}
?>
