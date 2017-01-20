<?php
//For developing only !
// error_reporting(E_ALL);
// ini_set("display_errors", TRUE);

function getdata()
{
    include('connect-db.php');
	?>
 <form action="" method="post">
 <div>
 <table align="center" border='1'>
 <tr>
 <td align="right"><strong>TAG </strong></td><td align="left"> <input type="text" style="width: 300px;" name="tag" value=""><br/></td>
 </tr> <tr>
<?php
    // drop down for select employee
    include('connect-db.php');
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
        echo "<option value=\"" . $row['id'] . "\">" . $row['first_name'] . $middle_name . $last_name . "</option>\n";
    }
    echo "</select>";
?>
</tr> <tr>
<td align="right"><strong>Notes </strong></td><td><textarea name="notes" style="width: 300px; height: 150px;"></textarea></td>
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
function addlaptop()
{
	include_once('connect-db.php');

	// get form data, making sure it is valid
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
	    mysql_query("INSERT INTO laptops VALUE(null, '$tag', '$employee', '$notes')")
	    or die(mysql_error());
	
	    // once saved, redirect back to the view page
	    header("Location: index.php");
	}
	mysql_free_result($result);
	mysql_close($connection);
}

// check if it wos added! 
if (isset($_POST['submit']))
{
	addlaptop();
}
else if (isset($_POST['cancel']))
{
	// once saved, redirect back to the view page
	header("Location: index.php");
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
