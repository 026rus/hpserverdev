<?php
/*
*/
function renderForm($id, $first_name, $middle_name, $last_name, $email, $gender, $locations, $project)
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
     /*
 if ($error != '')
        {
                 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
        }
      */
     
 ?>
 <form action="" method="post">

 <input type="hidden" name="id" value="<?php echo $id; ?>"/>

 <div>

 <table align="center" border='1'>
 <tr>
 <td align="right"><strong>First Name</strong></td>     <td align="left"> <input type="text" size="35" name="first_name" value="<?php   echo $first_name; ?>" /><br/></td>
 </tr> <tr>
 <td align="right"><strong>Middle Name</strong></td>    <td align="left"> <input type="text" size="35" name="middle_name" value="<?php  echo $middle_name; ?>" /><br/></td>
 </tr> <tr>
 <td align="right"><strong>Last Name</strong></td>      <td align="left"> <input type="text" size="35" name="last_name" value="<?php    echo $last_name; ?>" /><br/></td>
 </tr> <tr>
 <td align="right"><strong>Email</strong></td>          <td align="left"> <input type="text" size="35" name="email" value="<?php        echo $email; ?>" /><br/></td>
 </tr> <tr>
 <td align="right"><strong>Gender</strong></td>         <td align="left">
 <select name="gender">
 <option  <?php if($gender == "M" ) echo "selected"; ?> value="M">M</option>;
 <option  <?php if($gender == "F" ) echo "selected"; ?> value="F">F</option>;
 </select>
 <br/></td>
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

    echo '<td align="right"><strong>location</strong></td>       <td align="left">';
    echo '<select name="locations">';
    while ( $row = mysql_fetch_assoc($result) )
    {
        $description = "";
        if ($row['description'] != "") $description = ",  ". $row['description'];
         echo "<option "; 
         if ( $row['id'] == $locations ) echo " selected ";
         echo " value=\"" . $row['id'] . "\">" . $row['tag'] . $description . "</option>\n";
    }
    echo "</select>";
    mysql_close($connection);
?>


 </tr> <tr>
 <td align="right"><strong>Project</strong></td>        <td align="left"> 
 <select name="project">
<?php
    // Drop down for select project employee working on.
     include('connect-db.php');
     $sql  = "SELECT projects.id, projects.pname";
     $sql .= " FROM projects";

     $result = mysql_query($sql, $connection);

     if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
     while ( $row = mysql_fetch_assoc($result) )
     {
         echo "<option ";
         if ($row['id'] == $project ) echo " selected ";
         echo " value=\"" . $row['id'] . "\">";
         echo $row['pname'];
         echo "</option>\n";

     }
     mysql_close($connection);
?>
    </select>

 <br/></td>
 </tr>
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
     header("Location: showEmployees.php");
 }

 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['delete']))
 {
    if (is_numeric($_POST['id']))
    {
        $id = $_POST['id'];
       
        header("Location: deleteEmployee.php?id=" . $id );
    }
 }
 if (isset($_POST['submit']))
 {

    // confirm that the 'id' value is a valid integer before getting the form data
     if (is_numeric($_POST['id']))
     {
        // get form data, making sure it is valid
        $id            = $_POST['id'];
        $first_name    = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
        $middle_name   = mysql_real_escape_string(htmlspecialchars($_POST['middle_name']));
        $last_name     = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
        $email         = mysql_real_escape_string(htmlspecialchars($_POST['email']));
        $gender        = mysql_real_escape_string(htmlspecialchars($_POST['gender']));
        $locations     = mysql_real_escape_string(htmlspecialchars($_POST['locations']));
        $project       = mysql_real_escape_string(htmlspecialchars($_POST['project']));
    
        // check that firstname/lastname fields are both filled in
        if ($first_name == '' || $email == '')
        {
            // generate error message
            $error = 'ERROR: Please fill in all required fields!';
    
            //error, display form
            renderForm( $id, $first_name, $middle_name, $last_name, $email, $gender, $locations, $project);
        }
        else
        {
            // save the data to the database
            mysql_query("UPDATE employee SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', email='$email', gender='$gender', locations='$locations', project='$project' WHERE id='$id'")
            or die(mysql_error());
    
            // once saved, redirect back to the view page
            header("Location: showEmployees.php");
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
        $result = mysql_query("SELECT * FROM employee WHERE id=$id")
        or die(mysql_error());
        
        $row = mysql_fetch_array($result);
        // check that the 'id' matches up with a row in the databse
        if($row)
        {

            // get data from db
            $first_name     = $row['first_name'];
            $middle_name    = $row['middle_name'];
            $last_name      = $row['last_name'];
            $email          = $row['email'];
            $gender         = $row['gender'];
            $locations      = $row['locations'];
            $project        = $row['project'];
            $id             = $row['id'];
            
            // show form
            renderForm($id, $first_name, $middle_name, $last_name, $email, $gender, $locations, $project);
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
