<?php
/* 
 EDIT.PHP
 Allows user to edit specific entry in database
*/
//$ID='526';
 // creates the edit record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
function renderForm($ID, $Site, $EnclosureName, $EnclosureLink, $VCAddress, $EnclosureSN, $OA1SN, $OA2SN, $EnclosureModel, $EnclosureFirmware, $VCFirmware, $TypeofVC, $EnclosureFirmwareCurrent, $Comments, $Server1, $Server2, $Server3, $Server4, $Server5, $Server6, $Server7, $Server8, $Server9, $Server10, $Server11, $Server12, $Server13, $Server14, $Server15, $Server16, $Modified, $ModifiedBy, $GridLocation, $error)
 {

 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>Edit Record</title>
<style type="text/css" media="screen">
header {
width:100%;
text-align:center;
}
</style>

 </head>
<header>
<img src="/images/johnson-johnson-logo.png" alt="logo"/>
</header>

 <body>
 <?php 
 // if there are any errors, display them

 if ($error != '')
	{
		 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 	}
 ?> 
 
 <form action="" method="post">
 <input type="hidden" name="ID" value="<?php echo $ID; ?>"/>

 <div>
<table align="center">
<tr>
<td align ="left">
<p>Edit Enclosure Info:&nbsp;&nbsp;<strong>ID:</strong> <?php echo $ID; ?></p></td><td></td></tr>
</table>
<table align="center">
<tr>
<td align="center"><strong>Site: *</strong></td><td align="left"> <input type="text" name="Site" value="<?php echo $Site; ?>" /><br/>
<td align="center"><strong>Enclosure Name: *</strong></td><td align="left"> <input type="text" name="EnclosureName" value="<?php echo $EnclosureName; ?>" /><br/>
<td align="center"><strong>Enclosure Link: *</strong></td><td align="left"> <input type="text" name="EnclosureLink" value="<?php echo $EnclosureLink; ?>" /><br/>
<td align="center"><strong>VC Address: *</strong></td><td align="left"> <input type="text" name="VCAddress" value="<?php echo $VCAddress; ?>" /><br/>
</tr>
<td align="center"><strong>Enclosure SN: *</strong></td><td align="left"> <input type="text" name="EnclosureSN" value="<?php echo $EnclosureSN; ?>" /><br/>
<td align="center"><strong>OA1SN: *</strong></td><td align="left"> <input type="text" name="OA1SN" value="<?php echo $OA1SN; ?>" /><br/>
<td align="center"><strong>OA2SN: *</strong></td><td align="left"> <input type="text" name="OA2SN" value="<?php echo $OA2SN; ?>" /><br/>
<td align="center"><strong>Enclosure Model: *</strong></td><td align="left"> <input type="text" name="EnclosureModel" value="<?php echo $EnclosureModel; ?>" /><br/>
</tr>
<td align="center"><strong>Enclosure Firmware: *</strong></td><td align="left"> <input type="text" name="EnclosureFirmware" value="<?php echo $EnclosureFirmware; ?>" /><br/>
<td align="center"><strong>VC Firmware: *</strong></td><td align="left"> <input type="text" name="VCFirmware" value="<?php echo $VCFirmware; ?>" /><br/>
<td align="center"><strong>Type of VC: *</strong></td><td align="left"> <input type="text" name="TypeofVC" value="<?php echo $TypeofVC; ?>" /><br/>
<td align="center"><strong>Enclosure FW Current: *</strong></td><td align="left"> <input type="text" name="EnclosureFirmwareCurrent" value="<?php echo $EnclosureFirmwareCurrent; ?>" /><br/>
</tr>
<td align="center"><strong>Comments: *</strong></td><td align="left"> <input type="text" name="Comments" value="<?php echo $Comments; ?>" /><br/>
<td align="center"><strong>Server 1: *</strong></td><td align="left"> <input type="text" name="Server1" value="<?php echo $Server1; ?>" /><br/>
<td align="center"><strong>Server 2: *</strong></td><td align="left"> <input type="text" name="Server2" value="<?php echo $Server2; ?>" /><br/>
<td align="center"><strong>Server 3: *</strong></td><td align="left"> <input type="text" name="Server3" value="<?php echo $Server3; ?>" /><br/>
</tr>
<td align="center"><strong>Server 4: *</strong></td><td align="left"> <input type="text" name="Server4" value="<?php echo $Server4; ?>" /><br/>
<td align="center"><strong>Server 5: *</strong></td><td align="left"> <input type="text" name="Server5" value="<?php echo $Server5; ?>" /><br/>
<td align="center"><strong>Server 6: *</strong></td><td align="left"> <input type="text" name="Server6" value="<?php echo $Server6; ?>" /><br/>
<td align="center"><strong>Server 7: *</strong></td><td align="left"> <input type="text" name="Server7" value="<?php echo $Server7; ?>" /><br/>
</tr>
<td align="center"><strong>Server 8: *</strong></td><td align="left"> <input type="text" name="Server8" value="<?php echo $Server8 ?>" /><br/>
<td align="center"><strong>Server 9: *</strong></td><td align="left"> <input type="text" name="Server9" value="<?php echo $Server9; ?>" /><br/>
<td align="center"><strong>Server 10: *</strong></td><td align="left"> <input type="text" name="Server10" value="<?php echo $Server10 ?>" /><br/>
<td align="center"><strong>Server 11: *</strong></td><td align="left"> <input type="text" name="Server11" value="<?php echo $Server11; ?>" /><br/>
</tr>
<td align="center"><strong>Server 12: *</strong></td><td align="left"> <input type="text" name="Server12" value="<?php echo $Server12; ?>" /><br/>
<td align="center"><strong>Server 13: *</strong></td><td align="left"> <input type="text" name="Server13" value="<?php echo $Server13; ?>" /><br/>
<td align="center"><strong>Server 14: *</strong></td><td align="left"> <input type="text" name="Server14" value="<?php echo $Server14; ?>" /><br/>
<td align="center"><strong>Server 15: *</strong></td><td align="left"> <input type="text" name="Server15" value="<?php echo $Server15; ?>" /><br/>
</tr>
<td align="center"><strong>Server 16: *</strong></td><td align="left"> <input type="text" name="Server16" value="<?php echo $Server16; ?>" /><br/>
<td align="center"><strong>Modified: *</strong></td><td align="left"> <input type="text" name="Modified" value="<?php echo $Modified; ?>" /><br/>
<td align="center"><strong>Modified By: *</strong></td><td align="left"> <input type="text" name="ModifiedBy" value="<?php echo $ModifiedBy; ?>" /><br/>
<td align="center"><strong>Grid Location: *</strong></td><td align="left"> <input type="text" name="GridLocation" value="<?php echo $GridLocation; ?>" /><br/>
</tr>
</table> 
<table align="center">
<tr>
<td align ="center">
 <p>* Required</p></td>
<td align="center"> <input type="submit" name="submit" value="Submit"></td>
</tr>
 </div>
 </form> 
 </body>
 </html> 
 <?php
 }

 


 // connect to the database
 include('connect-db.php');
 
 //	echo "<br>ID is: $ID<br>";
 // check if the form has been submitted. If it has, process the form and save it to the database
 if (isset($_POST['submit']))
 {
 
echo '<h1>Inside ferst IF</h1>'; 
 // confirm that the 'id' value is a valid integer before getting the form data
 if (is_numeric($_POST['ID']))
 {
 // get form data, making sure it is valid
 $ID = $_POST['ID'];
 $Site = mysql_real_escape_string(htmlspecialchars($_POST['Site']));
 $EnclosureName = mysql_real_escape_string(htmlspecialchars($_POST['EnclosureName']));
 $EnclosureLink = mysql_real_escape_string(htmlspecialchars($_POST['EnclosureLink']));
 $VCAddress = mysql_real_escape_string(htmlspecialchars($_POST['VCAddress']));
 $EnclosurSN = mysql_real_escape_string(htmlspecialchars($_POST['EnclosurSN']));
 $OA1SN = mysql_real_escape_string(htmlspecialchars($_POST['OA1SN']));
 $OA2SN = mysql_real_escape_string(htmlspecialchars($_POST['OA2SN']));
 $EnclosureModel = mysql_real_escape_string(htmlspecialchars($_POST['EnclosureModel']));
 $EnclosureFirmware = mysql_real_escape_string(htmlspecialchars($_POST['EnclosureFirmware']));
 $VCFirmware = mysql_real_escape_string(htmlspecialchars($_POST['VCFirmware']));
 $TypeofVC = mysql_real_escape_string(htmlspecialchars($_POST['TypeofVC']));
 $EnclosureFirmwareCurrent = mysql_real_escape_string(htmlspecialchars($_POST['EnclosureFirmwareCurrent']));
 $Comments = mysql_real_escape_string(htmlspecialchars($_POST['Comments']));
 $Server1 = mysql_real_escape_string(htmlspecialchars($_POST['Server1']));
 $Server2 = mysql_real_escape_string(htmlspecialchars($_POST['Server2']));
 $Server3 = mysql_real_escape_string(htmlspecialchars($_POST['Server3']));
  $Server4 = mysql_real_escape_string(htmlspecialchars($_POST['Server4']));
 $Server5 = mysql_real_escape_string(htmlspecialchars($_POST['Server5']));
 $Server6 = mysql_real_escape_string(htmlspecialchars($_POST['Server6']));
 $Server7 = mysql_real_escape_string(htmlspecialchars($_POST['Server7']));
 $Server8 = mysql_real_escape_string(htmlspecialchars($_POST['Server8']));
 $Server9 = mysql_real_escape_string(htmlspecialchars($_POST['Server9']));
 $Server10 = mysql_real_escape_string(htmlspecialchars($_POST['Server10']));
 $Server11 = mysql_real_escape_string(htmlspecialchars($_POST['Server11']));
 $Server12 = mysql_real_escape_string(htmlspecialchars($_POST['Server12']));
 $Server13 = mysql_real_escape_string(htmlspecialchars($_POST['Server13']));
 $Server14 = mysql_real_escape_string(htmlspecialchars($_POST['Server14']));
 $Server15 = mysql_real_escape_string(htmlspecialchars($_POST['Server15']));
 $Server16 = mysql_real_escape_string(htmlspecialchars($_POST['Server16']));
 $Modified = mysql_real_escape_string(htmlspecialchars($_POST['Modified']));
 $ModifiedBy = mysql_real_escape_string(htmlspecialchars($_POST['ModifiedBy']));
 $GridLocation = mysql_real_escape_string(htmlspecialchars($_POST['GridLocation']));
 

 
echo '<h1>Not YOU Problem</h1>'; 
 // check that firstname/lastname fields are both filled in
 if ($EnclosureName == '' || $EnclosureLink == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
//error, display form
 renderForm( $ID, $Site, $EnclosureName, $EnclosureLink, $VCAddress, $EnclosureSN, $OA1SN, $OA2SN, $EnclosureModel, $EnclosureFirmware, $VCFirmware, $TypeofVC, $EnclosureFirmwareCurrent, $Comments, $Server1, $Server2, $Server3, $Server4, $Server5, $Server6, $Server7, $Server8, $Server9, $Server10, $Server11, $Server12, $Server13, $Server14, $Server15, $Server16, $Modified, $ModifiedBy, $GridLocation, $error);
 }
 else
 {
 // save the data to the database
mysql_query("UPDATE EnclosureInfo SET Site='$Site', EnclosureName='$EnclosureName', EnclosureLink='$EnclosureLink', VCAddress='$VCAddress', EnclosureSN='$EnclosurSN', OA1SN='$OA1SN', OA2SN='$OA2SN',  EnclosureModel='$EnclosureModel', EnclosureFirmware='$EnclosureFirmware', VCFirmware='$VCFirmware', TypeofVC='$TypeofVC', EnclosureFirmwareCurrent='$EnclosureFirmwareCurrent', Comments='$Comments', Server1='$Server1', Server2='$Server2', Server3='$Server3', Server4='$Server4', Server5='$Server5', Server6='$Server6', Server7='$Server7', Server8='$Server8', Server9='$Server9', Server10='$Server10', Server11='$Server11', Server13='$Server13', Server14='$Server14', Server15='$Server15', Server16='$Server16', Modified='$Modified', ModifiedBy='$ModifiedBy', GridLocation='$GridLocation' WHERE ID='$ID'") 
or die(mysql_error()); 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 {
 // if the 'id' isn't valid, display an error
	echo 'Error!';
 }
 }
 else
 // if the form hasn't been submitted, get the data from the db and display the form
 {
 //	echo "ID is: $ID";
//	echo "<br>";
 // get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)
 if (isset($_GET['ID']) && is_numeric($_GET['ID']) && $_GET['ID'] > 0)
 {
 // query db
 $ID = $_GET['ID'];
 $result = mysql_query("SELECT * FROM EnclosureInfo WHERE ID=$ID")
 or die(mysql_error()); 
 $row = mysql_fetch_array($result);
 
 // check that the 'id' matches up with a row in the databse
 if($row)
 {
 
 // get data from db
//$ID = $row['ID']; 
$Site = $row['Site'];
$EnclosureName = $row['EnclosureName'];
$EnclosureLink = $row['EnclosureLink'];
$VCAddress = $row['VCAddress'];
$EnclosureSN = $row['EnclosureSN'];
$OA1SN = $row['OA1SN'];
$OA2SN = $row['OA2SN'];
$EnclosureModel	= $row['EnclosureModel'];
$EnclosureFirmware	= $row['EnclosureFirmware'];
$VCFirmware = $row['VCFirmware'];
$TypeofVC = $row['TypeofVC'];	
$EnclosureFirmwareCurrent = $row['EnclosureFirmwareCurrent'];
$Comments = $row['Comments'];
$Server1 = $row['Server1'];
$Server2 = $row['Server2'];
$Server3 = $row['Server3'];
$Server4 = $row['Server4'];
$Server5 = $row['Server5'];
$Server6 = $row['Server6'];
$Server7 = $row['Server7'];
$Server8 = $row['Server8'];
$Server9 = $row['Server9'];
$Server10 = $row['Server10'];
$Server11 = $row['Server11'];
$Server12 = $row['Server12'];
$Server13 = $row['Server13'];
$Server14 = $row['Server14'];
$Server15 = $row['Server15'];
$Server16 = $row['Server16'];
$Modified = $row['Modified'];
$ModifiedBy = $row['ModifiedBy'];
$GridLocation = $row['GridLocation'];
$ID = $row['ID'];
 
 
 
 
 
 // show form
 renderForm($ID, $Site, $EnclosureName, $EnclosureLink, $VCAddress, $EnclosureSN, $OA1SN, $OA2SN, $EnclosureModel, $EnclosureFirmware, $VCFirmware, $TypeofVC, $EnclosureFirmwareCurrent, $Comments, $Server1, $Server2, $Server3, $Server4, $Server5, $Server6, $Server7, $Server8, $Server9, $Server10, $Server11, $Server12, $Server13, $Server14, $Server15, $Server16, $Modified, $ModifiedBy, $GridLocation, '');
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
 echo 'Error!';
 }
 }
?>
