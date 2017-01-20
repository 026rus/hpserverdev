<?php
//For developing only !
error_reporting(E_ALL);
ini_set("display_errors", TRUE);
var_dump($_REQUEST);

function confremDelete()
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
	<td colspan='2' align="center"><b><h1><p style="color:#FF0000";>Are you sure you want to delete this item</p></h1></b></td>
 </tr>
 <tr>
 <td align="right"><strong>TAG </strong></td><td align="left"> <?=$TAG?> <br/></td>
 </tr> <tr>
<?php
    // drop down for select employee
    $sql  = "select id, first_name, middle_name, last_name";
    $sql .= " from employee";
    $sql .= " where id=$EMPLOYEEID";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "db error, could not query the database:<br>\n";
        echo 'mysql error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>Assigned to employee</strong></td><td align="left">';
    while ( $row = mysql_fetch_assoc($result) )
    {

        $middle_name = "";
        $last_name = "";

        if ($row['middle_name'] != "") $middle_name = "  ". $row['middle_name'];
        if ($row['last_name'] != "") $last_name = "  ". $row['last_name'];
        echo $row['first_name'] . $middle_name . $last_name . "\n";
    }
    echo "";
?>
</tr> <tr>
<td align="left" colspan="2" height="100"><?=$NOTES?></textarea></td>
</tr>
 </table>

 <table align="center">
 <tr>
 <td align ="center">
 <p></p></td>
 <td align="center"> <input type="submit" name="YES" value="YES"></td>
 <td align="center"> <input type="submit" name="NO" value="NO"></td>
 </tr>
 </table>
 </div>
 </form>
	<?php
	mysql_free_result($result);
	mysql_close($connection);
}
function deleteLaptop()
{
	include_once('connect-db.php');

	// get form data, making sure it is valid
	$id         = mysql_real_escape_string(htmlspecialchars($_POST['id']));
	$tag        = mysql_real_escape_string(htmlspecialchars($_POST['tag']));
	$employee   = mysql_real_escape_string(htmlspecialchars($_POST['employee']));
	$notes      = mysql_real_escape_string(htmlspecialchars($_POST['notes']));
	
	
	// check that firstname/lastname fields are both filled in
	// save the data to the database
	// UPDATE `kiosk`.`laptops` SET `empoyee_id` = '83' WHERE `laptops`.`id` = 62;
	$sql = "DELETE FROM laptops WHERE id=$id";

	mysql_query($sql)
	or die(mysql_error());
	// once delete, redirect back to the view page
	// 
	header("Location: index.php");
	
}
// delete laptop by id
if (isset($_POST['YES']))
{
	deleteLaptop();
}
else if (isset($_POST['NO']))
{
	header("Location: index.php");
	// if (isset($_GET['edte']))
	// {
	// 	header("Location: edtEmployee.php");
	// }
	// else
	// {
	// 	header("Location: index.php");
	// }
}
else
{
?>

<html>
<head>
<title>Delete Laptop</title>

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
<?php confremDelete(); ?>
</body>
</html>
<?php
}
?>
