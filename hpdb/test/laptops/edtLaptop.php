<?php
//For developing only !
error_reporting(E_ALL);
ini_set("display_errors", TRUE);
var_dump($_REQUEST);

function getdata()
{
	$id=null;
	$TAG=null;
	$EMPLOYEEID=null;
	$NOTES=null;
	
    include('connect-db.php');
	if(isset($_GET['id']))
	{
		$id = $_GET['id'];
    	$sql  = "select *";
    	$sql .= " from laptops";
    	$sql .= " WHERE id =" . $id;

    	$result = mysql_query($sql, $connection);
    	if (!$result)
    	{
    	    echo "db error, could not query the database:<br>\n";
    	    echo 'mysql error: ' . mysql_error();
    	    exit;
    	}
		
		$row = mysql_fetch_assoc($result);
		$TAG = $row['tag'];
		$EMPLOYEEID = $row['empoyee_id'];
		$NOTES = $row['notes'];

	}
	?>
 <form action="" method="POST">
 <input type="hidden" name="id" value="<?=$id?>">
 <div>
 <table align="center" border='1'>
 <tr>
 <td align="right"><strong>TAG </strong></td><td align="left"> <input type="text" style="width: 300px;" name="tag" value="<?=$TAG?>"><br/></td>
 </tr> <tr>
<?php
	// echo "@ " . $id . "|" ;
	// echo "@ " . $TAG . "|" ;
	// echo "@ " . $EMPLOYEEID . "|" ;
	// echo "@ " . $NOTES . "|" ;
    // drop down for select employee
    $sql  = "select id, first_name, middle_name, last_name";
    $sql .= " from employee";
    $sql .= " order by first_name, last_name";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "db error, could not query the database:<br>\n";
        echo 'mysql error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>Employee</strong></td><td align="left">';
    echo '<select name="employee">'; 
    echo '<option value="0">Please Select One</option>'; 
    while ( $row = mysql_fetch_assoc($result) )
    {

        $middle_name = "";
        $last_name = "";

        if ($row['middle_name'] != "") $middle_name = "  ". $row['middle_name'];
        if ($row['last_name'] != "") $last_name = "  ". $row['last_name'];
        echo "<option ";
		if ($row['id'] == $EMPLOYEEID) echo " selected ";
        echo "value=\"" . $row['id'] . "\">" . $row['first_name'] . $middle_name . $last_name . "</option>\n";
    }
    echo "</select>";
?>
</tr> <tr>
<td align="right"><strong>Notes </strong></td><td><textarea name="notes" style="width: 300px; height: 150px;"><?=$NOTES?></textarea></td>
</tr>
 </table>

 <table align="center">
 <tr>
 <td align ="center">
 <p></p></td>
 <td align="center"> <input type="submit" name="submit" value="submit"></td>
 <td align="center"> <input type="submit" name="cancel" value="cancel"></td>
 <td align="center"> <input type="submit" name="delete" value="delete"></td>
 </tr>
 </table>
 </div>
 </form>
	<?php
	mysql_free_result($result);
	mysql_close($connection);
}
function edditlaptop()
{
	include_once('connect-db.php');

	// get form data, making sure it is valid
	$id         = mysql_real_escape_string(htmlspecialchars($_POST['id']));
	$tag        = mysql_real_escape_string(htmlspecialchars($_POST['tag']));
	$employee   = mysql_real_escape_string(htmlspecialchars($_POST['employee']));
	$notes      = mysql_real_escape_string(htmlspecialchars($_POST['notes']));
	
	
	// check that firstname/lastname fields are both filled in
	if ($tag == '')
	{
	    // generate error message
	    $error = 'ERROR: Please fill the TAG required fields!';
	
	    //error, display form
	}
	else
	{
	    // save the data to the database
		// UPDATE `kiosk`.`laptops` SET `empoyee_id` = '83' WHERE `laptops`.`id` = 62;
		echo "<br>\n";
		$sql = "UPDATE laptops SET tag=\"$tag\", empoyee_id=$employee, notes=\"$notes\" WHERE id=$id";
		echo $sql . "<br>\n";
	    mysql_query($sql)
	    or die(mysql_error());
	
	    // once saved, redirect back to the view page
	    header("Location: index.php");
	}
	mysql_close($connection);
}
// delete laptop by id
function delLaptop()
{
	include_once('connect-db.php');

	// get form data, making sure it is valid
	$id         = mysql_real_escape_string(htmlspecialchars($_POST['id']));
	$tag        = mysql_real_escape_string(htmlspecialchars($_POST['tag']));
	$employee   = mysql_real_escape_string(htmlspecialchars($_POST['employee']));
	$notes      = mysql_real_escape_string(htmlspecialchars($_POST['notes']));
	
	mysql_close($connection);
	header("Location: delLaptop.php?id=$id");
}

// check if it wos added! 
if (isset($_POST['submit']))
{
	edditlaptop();
}
else if (isset($_POST['cancel']))
{
	// once saved, redirect back to the view page
	header("Location: index.php");
}
else if (isset($_POST['delete']))
{
	delLaptop();
}
else
{
?>

<html>
<head>
<title>Edint Laptop</title>

<link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<header>
<script src="javascript/jadding.js" type="text/javascript"></script>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.php"> <img src="img/header.gif" alt="logo" /> </a></td>
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
