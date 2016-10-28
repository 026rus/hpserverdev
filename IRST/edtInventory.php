<?php
/*
*/
function renderForm($id, $tag, $equipment, $employee, $cubicle, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
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
 <td align="right"><strong>TAG </strong></td>     <td align="left"> <?php   echo $tag; ?> <br/></td>
 </tr> <tr>
<?php
    // Drop down for select locatopns of employee 
    include('connect-db.php');
    $sql  = "SELECT *";
    $sql .= " FROM equipment";
    $sql .= " ORDER BY equipment_name";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>Equipment </strong></td><td align="left">';
    echo '<select name="equipment">';
    while ( $row = mysql_fetch_assoc($result) )
    {

        $description = "";

        if ($row['discriptions'] != "") $description = ",  ". $row['discriptions'];
         echo "<option "; 
         if ( $row['equipment_id'] == $equipment ) echo " selected ";
         echo " value=\"" . $row['equipment_id'] . "\">" . $row['equipment_name'] . $description . "</option>\n";
    }
    echo "</select>";
    mysql_close($connection);
?>
</tr> <tr>
<?php
    // Drop down for select locatopns of employee 
    include('connect-db.php');
    $sql  = "SELECT id, first_name, middle_name, last_name";
    $sql .= " FROM employee";
    $sql .= " ORDER BY first_name";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>Employee</strong></td><td align="left">';
    echo '<select name="employee">';
    while ( $row = mysql_fetch_assoc($result) )
    {

        $middle_name = "";
        $last_name = "";

        if ($row['middle_name'] != "") $middle_name = "  ". $row['middle_name'];
        if ($row['last_name'] != "") $last_name = "  ". $row['last_name'];
        echo "<option "; 
         if ( $row['id'] == $employee ) echo " selected ";
         echo " value=\"" . $row['id'] . "\">" . $row['first_name'] . $middle_name . $last_name . "</option>\n";
    }
    echo "</select>";
    mysql_close($connection);
?>

</tr> <tr>
<?php
    // Drop down for select locatopns of employee 
    include('connect-db.php');
    $sql  = "SELECT id, tag, description";
    $sql .= " FROM cubicles";
    $sql .= " ORDER BY tag";

    $result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>Location</strong></td>       <td align="left">';
    echo '<select name="cubicle">';
    while ( $row = mysql_fetch_assoc($result) )
    {
        $description = "";
        if ($row['description'] != "") $description = ",  ". $row['description'];
         echo "<option "; 
         if ( $row['id'] == $cubicle ) echo " selected ";
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
 <td align="center"> <input type="submit" name="submit" value="Submit"></td>
 <td align="center"> <input type="submit" name="delete" value="Delete"></td>
 <td align="center"> <input type="submit" name="cancel" value="Cancel"></td>
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
     header("Location: Inventory.php");
 }

 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['delete']))
 {
    if (is_numeric($_POST['id']))
    {
        $id = $_POST['id'];
       
        header("Location: deleteInventory.php?id=" . $id );
    }
 }
 if (isset($_POST['submit']))
 {

    // confirm that the 'id' value is a valid integer before getting the form data
     if (is_numeric($_POST['id']))
     {
        // get form data, making sure it is valid
        $id         = $_POST['id'];
        $tag        = mysql_real_escape_string(htmlspecialchars($_POST['tag']));
        $equipment  = mysql_real_escape_string(htmlspecialchars($_POST['equipment']));
        $employee   = mysql_real_escape_string(htmlspecialchars($_POST['employee']));
        $cubicle    = mysql_real_escape_string(htmlspecialchars($_POST['cubicle']));


        // check that firstname/lastname fields are both filled in
        if ($tag == '' || $equipment == '' || $employee == '' || $cubicle == '')
        {
            // generate error message
            $error = 'ERROR: Please fill in all required fields!';
    
            //error, display form
             renderForm($id, $tag, $equipment, $employee, $cubicle, $error);
        }
        else
        {
            // save the data to the database
            mysql_query("UPDATE inventory SET equipment='$equipment', employee='$employee', cubicle='$cubicle' WHERE inventory_id='$id'")
            or die(mysql_error());
    
            // once saved, redirect back to the view page
            header("Location: inventory.php");
        }
     }
     else
     {
        // if the 'id' isn't valid, display an error
        echo 'Error! ID is not valid!';
     }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
    // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
    if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)
    {
        // query db
        $id = $_GET['id'];
        $result = mysql_query("SELECT * FROM inventory WHERE inventory_id=$id")
        or die(mysql_error());
        
        $row = mysql_fetch_array($result);
        // check that the 'id' matches up with a row in the databse
        if($row)
        {

            // get data from db
            $tag        = $row['tag'];
            $equipment  = $row['equipment'];
            $employee   = $row['employee'];
            $cubicle    = $row['cubicle'];
            $id         = $row['inventory_id'];
            $error      = "";
            
            // show form
            renderForm($id, $tag, $equipment, $employee, $cubicle, $error);
        }
        else
        // if no match, display result
        {
            echo "No results!";
        }
    }
    else
    // if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error
    {
    echo "Error! The 'id' in the URL isn't valid, or if there is no 'id'";
    }
 }
?>
