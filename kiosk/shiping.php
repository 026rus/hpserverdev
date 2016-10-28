<html>
<head>
<title>Shiping Records</title>
<link rel="stylesheet" type="text/css" href="style/popup.css" />
<?php
	if (!isset($_POST['project_name']))
	{
		?>
		<script>
			$(function()
			{
				modal.style.display = "block";
			});
		</script>
		<?php
	}
	else
	{
		?>
		<script>
			$(function()
			{
				modal.style.display = "none";
			});
		</script>
		<?php
	}
?>
</head>
<body>
<!-- Trigger/Open The Modal -->
<button id="myBtn">Open</button>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <span class="close"><img src="img/close.png" alt="x" style="width:25px;height:25px;"></span>
	<p>
<form method="post" action="shiping.php" >

<table align ='center' border='0' >
<tr>
<?php
    include('connect-db.php');
    $sql  = "SELECT *";
    $sql .= " FROM projects";
	$result = mysql_query($sql, $connection);
    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }

    echo '<td align="right"><strong>Project Name</strong></td>       <td align="left">';
    echo '<select name="project_name">';
    while ( $row = mysql_fetch_assoc($result) )
    {
         echo "<option "; 
         if ( $row['id'] == '1' ) echo " selected ";
         echo " value=\"" . $row['id'] . "\">" . $row['tag'] . "</option>\n";
    }
    echo "</select>";

?>
</tr> <tr>
<td align="right"><strong>Serial Number</strong></td>    <td align="left"> <input type="text" size="35" name="serial_number" value="" /><br/></td>
</tr> <tr>
<td align="right"><strong>Tracking Number</strong></td>      <td align="left"> <input type="text" size="35" name="tracking_namber" value="" /><br/></td>
</tr> <tr>
</tr>
</table>

<input type="submit" id="submit">
</form>
	</p>
  </div>

</div>
<script src="javascript/shipingpopup.js"></script>

</body>
</html>
