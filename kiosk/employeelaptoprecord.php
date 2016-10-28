<?php
/*
*/
function renderForm($id, $first_name, $middle_name, $last_name, $email, $photo)
{
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Employee Laptop Record DEV</title>
<link rel="stylesheet" type="text/css" href="style.css" />
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
 // connect to the database
$colorIN 	= "#51c800";
$colorOUT 	= "#ff4d4d";
$colorTODAY = "#99c2ff";
$timeformatestr = 'g:i a  T';
 ?>
<table id="tablefix">
<tr>
	<td>Date time In<td>
	<td bgcolor='<?=$colorIN?>' width="40"><td>
</tr>
<tr>
	<td>Date time Out<td>
	<td bgcolor='<?=$colorOUT?>' width="40"><td>
</tr>
<tr>
	<td>Today<td>
	<td bgcolor='<?=$colorTODAY?>' width="40"><td>
</tr>
</table>
 <form action="" method="post">

 <input type="hidden" name="id" value="<?php echo $id; ?>"/>

 <div>

 <table align="center" border='1'>
 <tr>
	<td align="center" colspan="2"><h1>Title</h1></td>
 </tr> <tr>
	<td align="left"><h2> <?php  echo $first_name ." ". $middle_name ." ". $last_name; ?></h2></td>
	<td rowspan="2"><img src="<?php echo "people/" . $photo ?>" alt="Photo" style="max-width:244px;max-height:258px;"> </td>
 </tr> <tr>
	<td align="left"><h2> <?php  echo $email; ?></h2></td>
 </tr>
 </table>
<!--
 <table align="center">
 <tr>
 <td align ="center">
 <p></p></td>
 <td align="center"> <input type="submit" name="submit" value="Submit"></td>
 <td align="center"> <input type="submit" name="delete" value="Delete"></td>
 <td align="center"> <input type="submit" name="cancel" value="Cancel"></td>
 </tr>
 </table>
-->
<?php
    $tag;

	$sql = "SELECT * ";
	$sql .= "FROM laptoprecords";
	$sql .= " WHERE employee=" . $id;
	$sql .= " ORDER BY datein DESC, dateout DESC";

    $resin = mysql_query($sql)
		or die(mysql_error());
	
	$sql = "SELECT dateout ";
	$sql .= "FROM laptoprecords";
	$sql .= " WHERE employee=" . $id;
	$sql .= " ORDER BY dateout DESC";

    $resout = mysql_query($sql)
		or die(mysql_error());

	$datein[] = array();
	$dateout[] = array();
	$date = date_create();
	$nextSunday = date('m/d/Y', strtotime("next Sunday") );
	$startDate = date_create($nextSunday);
	$tag;
	$totx =0;
	$tin =0;
	$tout =0;
	
	while ($row = mysql_fetch_array($resin))
	{
    	if($row)
    	{
    	    // get data from db
			$temp 		  = $row['datein'];
			if ($temp != "" )
			{
				array_push($datein,  date_create($temp));
				$tin++;
				$totx++;
			}
    	}
	}
	while ($row = mysql_fetch_array($resout))
	{
    	if($row)
    	{
			$temp 		  = $row['dateout'];
			if ($temp != "" )
			{
				array_push($dateout, date_create($temp));
				$tout++;
				$totx++;
			}
    	}
	}

    // show form
	$xin  = 1;
	$xout = 1;
	while (($xin <= $tin)||($xout <= $tout))
	{
		echo "<table align='center' border='1'>";
		echo "<tr> <td colspan=\"7\" align=\"center\">" . date_format($startDate, 'F') . "</td></tr>";
		echo "<tr valign=\"top\">";
		$y=0;
		$tempdate = $startDate;
		$startDate = date_create(date_format($startDate, 'y-m-d'));
		while ($y < 7)
		{
			$y++; 
			if (date_format($tempdate, 'y-m-d') ==  date_format($date, 'y-m-d'))
				echo "<td align=\"center\" bgcolor='".$colorTODAY."'> ". date_format($tempdate, 'd') ." </td>";
			else
				echo "<td align=\"center\" > ". date_format($tempdate, 'd') ." </td>";
			date_sub($tempdate, date_interval_create_from_date_string('1 days'));
		}
		$y=0;
		echo "</tr>";
		echo "<tr valign=\"top\">";
		while ($y < 7)
		{
			// Weeke tabel heder
			echo "<td width=\"110\">";
			// echo date_format($startDate, 'd');
			$y++; 

				echo "<table align='center' border='0'>";
			while ( (date_format($datein[$xin], 'y-m-d') ==  date_format($startDate, 'y-m-d')) || 
			   	 (date_format($dateout[$xout], 'y-m-d') ==  date_format($startDate, 'y-m-d'))  	)
			{
					
			   if ( ($datein[$xin] != null) && (date_format($datein[$xin], 'y-m-d') ==  date_format($startDate, 'y-m-d')))
			   {
			   	echo "<tr><td bgcolor='".$colorIN."' >" . date_format($datein[$xin], $timeformatestr ) . " </td></tr>";
			   	$xin++;
			   }
			   if ( ( $dateout[$xout] != null )&& (date_format($dateout[$xout], 'y-m-d') ==  date_format($startDate, 'y-m-d')))
			   {
			   	echo "<tr><td bgcolor='".$colorOUT."' >" . date_format($dateout[$xout], $timeformatestr ) . " </td></tr>";
			   	$xout++;
			   }
			}
 				echo "</table>";

			echo "</td>";
			date_sub($startDate, date_interval_create_from_date_string('1 days'));
		}
		echo "</tr>";
			
 		echo "</table>";
	}
?>


 </div>
 </form>
 </body>
 </html>
 <?php
 }

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
        $photo         = mysql_real_escape_string(htmlspecialchars($_POST['photo']));
    
        // check that firstname/lastname fields are both filled in
        if ($first_name == '' || $email == '')
        {
            // generate error message
            $error = 'ERROR: Please fill in all required fields!';
    
            //error, display form
            renderForm( $id, $first_name, $middle_name, $last_name, $email, $photo);
        }
        else
        {
            // save the data to the database
            mysql_query("UPDATE employee SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name', email='$email', photo='$photo' WHERE id='$id'")
            or die(mysql_error());
    
            // once saved, redirect back to the view page
            header("Location: laptops.php");
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
            $photo          = $row['photo'];
            $id             = $row['id'];
            
            // show form
            renderForm($id, $first_name, $middle_name, $last_name, $email, $photo);
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
