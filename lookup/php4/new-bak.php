<?php
/* 
 NEW.PHP
 Allows user to create a new entry in the database
*/
 
 // creates the new record form
 // since this form is used multiple times in this file, I have made it a function that is easily reusable
 function renderForm($Site, $EnclosureName, $EnclosureLink, $VCAddress, $EnclosureSN, $OA1SN, $OA2SN, $EnclosureModel, $EnclosureFirmware, $VCFirmware, $TypeofVC, $EnclosureFirmwareCurrent, $Comments, $Server1, $Server2, $Server3, $Server4, $Server5, $Server6, $Server7, $Server8, $Server9, $Server10, $Server11, $Server12, $Server13, $Server14, $Server15, $Server16, $Modified, $ModifiedBy, $ID, $error)
 {
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
 <html>
 <head>
 <title>New Record</title>
 </head>
 <body>
 <?php 
 // if there are any errors, display them
 if ($error != '')
 {
 echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';
 }
 ?> 
 
 <form action="" method="post">
 
 <div>
 <strong>Site: *</strong> <input type="text" name="Site" value="<?php echo $Site; ?>" /><br/>
 <strong>EnclosureName: *</strong> <input type="text" name="EnclosureName" value="<?php echo $EnclosureName; ?>" /><br/>
 <strong>EnclosureLink: *</strong> <input type="text" name="EnclosureLink" value="<?php echo $EnclosureLink; ?>" /><br/>
 <strong>VCAddress: *</strong> <input type="text" name="VCAddress" value="<?php echo $VCAddress; ?>" /><br/>
 <strong>EnclosureSN: *</strong> <input type="text" name="EnclosureSN" value="<?php echo $EnclosureSN; ?>" /><br/>
 <strong>OA1SN: *</strong> <input type="text" name="OA1SN" value="<?php echo $OA1SN; ?>" /><br/>
 <strong>OA2SN: *</strong> <input type="text" name="OA2SN" value="<?php echo $OA2SN; ?>" /><br/>
 <strong>EnclosureModel: *</strong> <input type="text" name="EnclosureModel" value="<?php echo $EnclosureModel; ?>" /><br/>
 <strong>EnclosureFirmware: *</strong> <input type="text" name="EnclosureFirmware" value="<?php echo $EnclosureFirmware; ?>" /><br/>
 <strong>VCFirmware: *</strong> <input type="text" name="VCFirmware" value="<?php echo $VCFirmware; ?>" /><br/>
 <strong>TypeofVC: *</strong> <input type="text" name="TypeofVC" value="<?php echo $TypeofVC; ?>" /><br/>
 <strong>EnclosureFirmwareCurrent: *</strong> <input type="text" name="EnclosureFirmwareCurrent" value="<?php echo $EnclosureFirmwareCurrent; ?>" /><br/>
 <strong>Comments: *</strong> <input type="text" name="Comments" value="<?php echo $Comments; ?>" /><br/>
 <strong>Server1: *</strong> <input type="text" name="Server1" value="<?php echo $Server1; ?>" /><br/>
 <strong>Server2: *</strong> <input type="text" name="Server2" value="<?php echo $Server2; ?>" /><br/>
 <strong>Server3: *</strong> <input type="text" name="Server3" value="<?php echo $Server3; ?>" /><br/>
 <strong>Server4: *</strong> <input type="text" name="Server4" value="<?php echo $Server4; ?>" /><br/>
 <strong>Server5: *</strong> <input type="text" name="Server5" value="<?php echo $Server5; ?>" /><br/>
 <strong>Server6: *</strong> <input type="text" name="Server6" value="<?php echo $Server6; ?>" /><br/>
 <strong>Server7: *</strong> <input type="text" name="Server7" value="<?php echo $Server7; ?>" /><br/>
 <strong>Server8: *</strong> <input type="text" name="Server8" value="<?php echo $Server8 ?>" /><br/>
 <strong>Server9: *</strong> <input type="text" name="Server9" value="<?php echo $Server9; ?>" /><br/>
 <strong>Server10: *</strong> <input type="text" name="Server10" value="<?php echo $Server10 ?>" /><br/>
 <strong>Server11: *</strong> <input type="text" name="Server11" value="<?php echo $Server11; ?>" /><br/>
 <strong>Server12: *</strong> <input type="text" name="Server12" value="<?php echo $Server12; ?>" /><br/>
 <strong>Server13: *</strong> <input type="text" name="Server13" value="<?php echo $Server13; ?>" /><br/>
 <strong>Server14: *</strong> <input type="text" name="Server14" value="<?php echo $Server14; ?>" /><br/>
 <strong>Server15: *</strong> <input type="text" name="Server15" value="<?php echo $Server15; ?>" /><br/>
 <strong>Server16: *</strong> <input type="text" name="Server16" value="<?php echo $Server16; ?>" /><br/>
 <strong>Modified: *</strong> <input type="text" name="Modified" value="<?php echo $Modified; ?>" /><br/>
 <strong>ModifiedBy: *</strong> <input type="text" name="ModifiedBy" value="<?php echo $ModifiedBy; ?>" /><br/>
 <strong>GridLocation: *</strong> <input type="text" name="GridLocation" value="<?php echo $GridLocation; ?>" /><br/>
<!-- <strong>ID: *</strong> <input type="text" name="ID" value="<?php echo $ID; ?>" /><br/>-->
 
 
 <p>* required</p>
 <input type="submit" name="submit" value="Submit">
 </div>
 </form> 
 </body>
 </html>
 <?php 
 }
 
 
 

 // connect to the database
 include('connect-db.php');
 
 // check if the form has been submitted. If it has, start to process the form and save it to the database
 if (isset($_POST['submit']))
 { 
 // get form data, making sure it is valid
 //$firstname = mysql_real_escape_string(htmlspecialchars($_POST['firstname']));
 //$lastname = mysql_real_escape_string(htmlspecialchars($_POST['lastname']));
 
$Site = mysql_real_escape_string(htmlspecialchars($_POST['Site']));

$EnclosureName = mysql_real_escape_string(htmlspecialchars($_POST['EnclosureName']));

$EnclosureLink = mysql_real_escape_string(htmlspecialchars($_POST['EnclosureLink']));

$VCAddress = mysql_real_escape_string(htmlspecialchars($_POST['VCAddress']));

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

//$ID = mysql_real_escape_string(htmlspecialchars($_POST['ID']));
 
 
 
 
 // check to make sure both fields are entered
 if ($Site == '' || $EnclosureName == '')
 {
 // generate error message
 $error = 'ERROR: Please fill in all required fields!';
 
 // if either field is blank, display the form again
 renderForm($Site, $EnclosureName, $EnclosureLink, $VCAddress, $EnclosureSN, $OA1SN, $OA2SN, $EnclosureModel, $EnclosureFirmware, $VCFirmware, $TypeofVC, $EnclosureFirmwareCurrent, $Comments, $Server1, $Server2, $Server3, $Server4, $Server5, $Server6, $Server7, $Server8, $Server9, $Server10, $Server11, $Server12, $Server13, $Server14, $Server15, $Server16, $Modified, $ModifiedBy, $error); 
}
 else
 {
 // save the data to the database
 mysql_query("INSERT EnclosureInfo SET Site='$Site', EnclosureName='$EnclosureName', EnclosureLink='$EnclosureLink', VCAddress='$VCAddress', EnclosureSN='$EnclosurSN', OA1SN='$OA1SN', OA2SN='$OA2SN',  EnclosureModel='$EnclosureModel', EnclosureFirmware='$EnclosureFirmware', VCFirmware='$VCFirmware', TypeofVC='$TypeofVC', EnclosureFirmwareCurrent='$EnclosureFirmwareCurrent', Comments='$Comments', Server1='$Server1', Server2='$Server2', Server3='$Server3', Server4='$Server4', Server5='$Server5', Server6='$Server6', Server7='$Server7', Server8='$Server8', Server9='$Server9', Server10='$Server10', Server11='$Server11', Server13='$Server13', Server14='$Server14', Server15='$Server15', Server16='$Server16', Modified='$Modified', ModifiedBy='$ModifiedBy', GridLocation='$GridLocation'")
or die(mysql_error()); 
 
 
 // once saved, redirect back to the view page
 header("Location: view.php"); 
 }
 }
 else
 // if the form hasn't been submitted, display the form
 {
renderForm('','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','','');
 }

?>
