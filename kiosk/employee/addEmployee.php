<?php
/*
*/
function renderForm($id, $first_name, $middle_name, $last_name, $email)
 {
 ?>
 <html>
 <head>
 <title>Add Employee</title>
<link rel="stylesheet" type="text/css" href="../style.css" />

</head>

<header>
<table border='0' style='width:100%' background="../img/1.gif" style="" >
<tr><td valign="middle" align="left" ><a href="index.html"> <img src="../img/header.gif" alt="logo" /> </a></td></tr>
</table>
</header>

<body>

<form action="" method="post">

<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<div>

<table align="center" border='1'>
<tr>
<td align="right"><strong>First Name</strong></td>     <td align="left"> <input type="text" size="35" name="first_name" value="" /><br/></td>
</tr> <tr>
<td align="right"><strong>Middle Name</strong></td>    <td align="left"> <input type="text" size="35" name="middle_name" value="" /><br/></td>
</tr> <tr>
<td align="right"><strong>Last Name</strong></td>      <td align="left"> <input type="text" size="35" name="last_name" value="" /><br/></td>
</tr> <tr>
<td align="right"><strong>Email</strong></td>          <td align="left"> <input type="text" size="35" name="email" value="" /><br/></td>
</tr> <tr>
<br/></td>
</tr> <tr>



<br/></td>
</tr>
</table>

<table align="center">
<tr>
<td align ="center">
<p></p></td>
<td align="center"> <input type="submit" name="submit" value="Submit"></td>
<td align="center"> <input type="submit" name="cancel" value="Cancel"></td>
</tr>
</table>
</div>
</form>
</body>
</html>
<?php
}

if (isset($_POST['cancel']))
{
    header("Location: showEmployees.php");
}

// connect to the database
include('../connect-db.php');

// check if the form has been submitted. If it has, process the form and save it to the database
if (isset($_POST['submit']))
{

   // confirm that the 'id' value is a valid integer before getting the form data
   // get form data, making sure it is valid
   $id            = $_POST['id'];
   $first_name    = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
   $middle_name   = mysql_real_escape_string(htmlspecialchars($_POST['middle_name']));
   $last_name     = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
   $email         = mysql_real_escape_string(htmlspecialchars($_POST['email']));
   
       // check that firstname/lastname fields are both filled in
       if ($first_name == '' || $last_name == '')
       {
           // generate error message
           $error = 'ERROR: Please fill in first and last name!';
   
           //error, display form
           renderForm( $id, $first_name, $middle_name, $last_name, $email);
       }
       else
       {
           // save the data to the database
           mysql_query("INSERT INTO employee VALUE(null, '$first_name', '$middle_name', '$last_name', '$email' )")
           or die(mysql_error());
   
           // once saved, redirect back to the view page
           header("Location: showEmployees.php");
       }
}
else
// if the form hasn't been submitted, get the data from the db and display the form
{
   // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
       // query db
           // get data from db
           $first_name     = "";
           $middle_name    = "";
           $last_name      = "";
           $email          = "";
           $id             = "";
           
           // show form
           renderForm($id, $first_name, $middle_name, $last_name, $email );
}
?>
