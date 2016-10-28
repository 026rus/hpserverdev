<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Search Enclosures</title>
<style type="text/css" media="screen">

header {
width:100%;
text-align:center;
}

h1 { 
font-size: 250%;
text-decoration:underline;
text-align:center;
}

h2 {
font-size: 175%;
text-align: center;
}

p { 
font-size: 175%;
font-weight: bold;
text-align:center;
}

form {
    margin:30px 0px; padding:0px;
    text-align:center;
    }

ul li{
		  list-style-type:none;
}
</style>
</head>

<!---Start-->

	<header>
	<a href="searchenc.php"> <img src="images/johnson-johnson-logo.png" alt="logo" />
	</a>
</header>
	<body>
		<h1>Enclosure Information Search</h1>

		<h2>Search Options</h2>
		<table width="auto" cellpadding="5" align="center" border="2" font-size="6" >
			<tr>
			<td width="200" align="center"><a href='/lookup/view.php'><font size=4><strong>View All</strong></font></a></td>
    			<td width="200" align="center"><a href='/lookup/view-paginated.php'><font size=4><strong>View Paginated</strong></font></a></td>
    			<td width="200" align="center"><a href='/lookup/new.php'><font size=4><strong>Add Enclosure</strong></font></a></td>
			</tr>
		</table>

	<!---Form Start-->
	<form method="post" action="searchenc.php?go" id="searchform">
		<input type="text" name="name">
		<input type="submit" name="submit" value="Search">
	</form>

<?php
if(isset($_POST['submit'])){
if(isset($_GET['go'])){
if(preg_match("/^[a-zA-Z0-9,\-\.\/:]+$/", $_POST['name'])){
$name=$_POST['name'];

//connect to the database

	$db=mysql_connect ("localhost", "root", "password") or die ('I cannot connect to the database because: ' . mysql_error());

//-select the database to use
	
	$mydb=mysql_select_db("Enclosures");

//-query the database table

	$sql="SELECT * FROM EncInfo WHERE Site Like '%$name%' OR EnclosureName LIKE '%$name%' OR EnclosureLink LIKE '%$name%' OR VCAddress LIKE '%$name%' OR EnclosureSN LIKE '%$name%' OR OA1SN LIKE '%$name%' OR OA2SN LIKE '%$name%' OR EnclosureModel LIKE '%$name%' OR EnclosureFirmware LIKE '%$name%' OR VCFirmware LIKE '%$name%' OR TypeofVC LIKE '%$name%' OR EnclosureFirmwareCurrent LIKE '%$name%' OR Comments LIKE '%$name%' OR Server1 LIKE '%$name%' OR Server2 LIKE '%$name%' OR Server3 LIKE '%$name%' OR Server4 LIKE '%$name%' OR Server5 LIKE '%$name%' OR Server6 LIKE '%$name%' OR Server7 LIKE '%$name%' OR Server8 LIKE '%$name%' OR Server9 LIKE '%$name%' OR Server10 LIKE '%$name%' OR Server11 LIKE '%$name%' OR Server12 LIKE '%$name%' OR Server13 LIKE '%$name%' OR Server14 LIKE '%$name%' OR Server15 LIKE '%$name%' OR Server16 LIKE '%$name%' OR ModifiedBy LIKE '%$name%' OR GridLocation LIKE '%$name%' OR ID LIKE '%$name%'";

//-run the query against the mysql query function
	$result=mysql_query($sql);

//-create while loop and loop through result set

	while($row=mysql_fetch_array($result)){

//Edit Fields Here
$Site =$row['Site'];
$EnclosureName=$row['EnclosureName'];
$EnclosureLink=$row['EnclosureLink'];	
$VCAddress=$row['VCAddress'];
$EnclosureSN =$row['EnclosureSN'];
$OA1SN =$row['OA1SN'];
$OA2SN=$row['OA2SN'];
$EnclosureModel=$row['EnclosureModel'];	
$EnclosureFirmware=$row['EnclosureFirmware'];
$VCFirmware =$row['VCFirmware'];
$TypeofVC=$row['TypeofVC'];
$EnclosureFirmwareCurrent=$row['EnclosureFirmwareCurrent'];	
$Comments=$row['Comments'];
$Server1 =$row['Server1'];
$Server2=$row['Server2'];
$Server3=$row['Server3'];	
$Server4=$row['Server4'];
$Server5 =$row['Server5'];
$Server6=$row['Server6'];
$Server7=$row['Server7'];	
$Server8=$row['Server8'];
$Server9 =$row['Server9'];
$Server10=$row['Server10'];
$Server11=$row['Server11'];	
$Server12=$row['Server12'];
$Server13=$row['Server13'];
$Server14=$row['Server14'];	
$Server15=$row['Server15'];
$Server16 =$row['Server16'];
$Modified=$row['Modified'];
$ModifiedBy=$row['ModifiedBy'];	
$GridLocation=$row['GridLocation'];
$ID=$row['ID'];

//-display the result of the array
	echo "<table style='width:' align='center'>";
	echo "<tr>";
	echo "<td>" . "<a href=\"searchenc.php?id=$ID\">"  . $EnclosureName . "</a></td>";
	echo "</tr>";
	echo "</table>";
}
}

else{
echo "<p>Please enter a search query</p>";
}
}
}
	
	if(isset($_GET['id'])){
	$contactid=$_GET['id'];

//connect  to the database

	$db=mysql_connect  ("localhost", "root",  "password") or die ('I cannot connect to the database  because: ' . mysql_error());

//-select  the database to use
	$mydb=mysql_select_db("Enclosures");

//-query  the database table

	$sql="SELECT  * FROM EncInfo WHERE ID=" . $contactid;

//-run  the query against the mysql query function

	$result=mysql_query($sql);

//-create  while loop and loop through result set

	while($row=mysql_fetch_array($result)){

$Site =$row['Site'];
$EnclosureName=$row['EnclosureName'];
$EnclosureLink=$row['EnclosureLink'];	
$VCAddress=$row['VCAddress'];
$EnclosureSN =$row['EnclosureSN'];
$OA1SN =$row['OA1SN'];
$OA2SN=$row['OA2SN'];								   
$EnclosureModel=$row['EnclosureModel'];	
$EnclosureFirmware=$row['EnclosureFirmware'];
$VCFirmware =$row['VCFirmware'];
$TypeofVC=$row['TypeofVC'];
$EnclosureFirmwareCurrent=$row['EnclosureFirmwareCurrent'];	
$Comments=$row['Comments'];
$Server1 =$row['Server1'];
$Server2=$row['Server2'];
$Server3=$row['Server3'];	
$Server4=$row['Server4'];
$Server5 =$row['Server5'];
$Server6=$row['Server6'];
$Server7=$row['Server7'];	
$Server8=$row['Server8'];
$Server9 =$row['Server9'];
$Server10=$row['Server10'];
$Server11=$row['Server11'];	
$Server12=$row['Server12'];
$Server13=$row['Server13'];
$Server14=$row['Server14'];	
$Server15=$row['Server15'];
$Server16 =$row['Server16'];
$Modified=$row['Modified'];
$ModifiedBy=$row['ModifiedBy'];	
$GridLocation=$row['GridLocation'];
$ID=$row['ID'];

				
//-display  the result of the array

echo "<table style='width:35%' align='center'>";
echo "<tr>";
echo "<td>" .  "Location: </td><td>" . $Site . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . "Enclosure: </td><td>" . $EnclosureName . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . "Enclosure IP: </td><td>" . $EnclosureLink . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . "VC IP: </td><td>" . $VCAddress . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . "Enclosure SN: </td><td> " . $EnclosureSN .   "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . "OA 1 SN: </td><td>" . $OA1SN . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . "OA 2 SN:  </td><td>" . $OA2SN . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td>" . "VC IP: </td><td>" . $VCAddress . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "Model: </td><td>" . $EnclosureModel . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "OA FW: </td><td>" . $EnclosureFirmware . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "VC FW: </td><td>" . $VCFirmware . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "VC Type: </td><td>" . $TypeofVC . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "Enclosure FW Current: </td><td>" . $EnclosureFirmwareCurrent . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "Comments: </td><td>" . $Comments . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "Servers: </td><td>" . $Server1 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" .  " </td><td>" . $Server2 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server3 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" .  " </td><td>" . $Server4 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server5 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" .  " </td><td>" . $Server6 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server7 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" .  " </td><td>" . $Server8 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server9 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" .  " </td><td>" . $Server10 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server11 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server12 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server13 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server14 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server15 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . " </td><td>" . $Server16 . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "Modified: </td><td>" . $Modified . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "Modified By: </td><td>" . $ModifiedBy . "</td>";
echo "</tr>";
echo "<tr>";
echo  "<td>" . "Grid: </td><td>" . $GridLocation . "</td>";
echo "</tr>";
echo"<tr>";
echo"<td></td>";
echo "</tr>";
echo "<tr>"; 
echo '<td align="center"><a href="/lookup/edit.php?ID=' . mysql_result($result, $i, 'ID') . '"><strong>Edit</strong></a></td>';
echo "<tr>";

"</table>";
}
}
?>

</body>
</html>
