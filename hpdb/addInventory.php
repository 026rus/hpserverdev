<?php
/*
*/
function renderForm($id, $tag, $model_brand, $equipment, $employee, $cubicle, $error)
 {
 ?>
 <html>
 <head>
 <title>Add Inventory Record</title>
 <style>
 header
 {
     width:100%;
     text-align:center;
 }
td
{
    padding: 5px;
}
 </style>

 </head>

<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" align="left" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td></tr>
</table>
</header>

 <body>
<?php
     
 if ($error != '')
        {
                 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
        }
      
     
 ?>
 <form action="" method="post">
 <input type="hidden" name="id" value="<?php echo $id; ?>"/>
 <input type="hidden" name="tag" value="<?php   echo $tag; ?>"/>
 <div>
 <table align="center" border='1'>
 <tr>
 <td align="right"><strong>tag </strong></td><td align="left"> <input type="text" size="30" name="tag" value=""><br/></td>
 </tr><tr>
 <td align="right"><strong>model brand</strong></td><td align="left"> <input type="text" size="30" name="model_brand" value=""><br/></td>
 </tr> <tr>
<?php
    // drop down for select locatopns of employee 
    include('connect-db.php');
    $sql  = "select *";
    $sql .= " from equipment";
    $sql .= " order by equipment_name";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "db error, could not query the database:<br>\n";
        echo 'mysql error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>equipment </strong></td><td align="left">';
    echo '<select name="equipment">';
    echo "<option selected value=''> </option>\n";
    while ( $row = mysql_fetch_assoc($result) )
    {

        $description = "";

        if ($row['discriptions'] != "") $description = ",  ". $row['discriptions'];
         echo "<option  value=\"" . $row['equipment_id'] . "\">" . $row['equipment_name'] . $description . "</option>\n";
    }
    echo "</select>";
    mysql_close($connection);
?>
</tr> <tr>
<?php
    // drop down for select employee of employee 
    include('connect-db.php');
    $sql  = "select id, first_name, middle_name, last_name";
    $sql .= " from employee";
    $sql .= " order by first_name";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "db error, could not query the database:<br>\n";
        echo 'mysql error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>employee</strong></td><td align="left">';
    echo '<select name="employee">';
    while ( $row = mysql_fetch_assoc($result) )
    {

        $middle_name = "";
        $last_name = "";

        if ($row['middle_name'] != "") $middle_name = "  ". $row['middle_name'];
        if ($row['last_name'] != "") $last_name = "  ". $row['last_name'];
        echo "<option "; 
         if ( $row['id'] == '40' ) echo " selected ";
         echo " value=\"" . $row['id'] . "\">" . $row['first_name'] . $middle_name . $last_name . "</option>\n";
    }
    echo "</select>";
    mysql_close($connection);
?>

</tr> <tr>
<?php
    // drop down for select locatopns of employee 
    include('connect-db.php');
    $sql  = "select id, tag, description";
    $sql .= " from cubicles";
    $sql .= " order by tag";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "db error, could not query the database:<br>\n";
        echo 'mysql error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>location</strong></td>       <td align="left">';
    echo '<select name="cubicle">';
    while ( $row = mysql_fetch_assoc($result) )
    {
        $description = "";
        if ($row['description'] != "") $description = ",  ". $row['description'];
         echo "<option "; 
         if ( $row['id'] == '175' ) echo " selected ";
         echo " value=\"" . $row['id'] . "\">" . $row['tag'] . $description . "</option>\n";
    }
    echo "</select>";
    mysql_close($connection);
?>
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
 </body>
 </html>
 <?php
 }

 // connect to the database
 include('connect-db.php');

 if (isset($_POST['cancel']))
 {
     header("Location: inventory.php");
 }

 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 {
	
	// get form data, making sure it is valid
	$tag        = mysql_real_escape_string(htmlspecialchars($_POST['tag']));
	$model_brand= mysql_real_escape_string(htmlspecialchars($_POST['model_brand']));
	$equipment  = mysql_real_escape_string(htmlspecialchars($_POST['equipment']));
	$employee   = mysql_real_escape_string(htmlspecialchars($_POST['employee']));
	$cubicle    = mysql_real_escape_string(htmlspecialchars($_POST['cubicle']));
	
	
	// check that firstname/lastname fields are both filled in
	if ($tag == '' || $equipment == '' || $employee == '' || $cubicle == '')
	{
	    // generate error message
	    $error = 'ERROR: Please fill in all required fields!';
	
	    //error, display form
	     renderForm($id, $tag, $model_brand, $equipment, $employee, $cubicle, $error);
	}
	else
	{
	    // save the data to the database
	    mysql_query("INSERT INTO inventory VALUE(null, '$tag', '$model_brand', '$equipment', '$employee', '$cubicle')")
	    or die(mysql_error());
	
	    // once saved, redirect back to the view page
	    header("Location: inventory.php");
	}
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
	
	 $tag        = ""; 
	 $model_brand= ""; 
	 $equipment  = ""; 
	 $employee   = ""; 
	 $cubicle    = ""; 
	 $id         = ""; 
	 $error      = "";
	 
	 // show form
	 renderForm($id, $tag, $model_brand, $equipment, $employee, $cubicle, $error);
 }
?>
