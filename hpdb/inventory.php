<html>
<head>
<title> Inventory </title>

<link rel="stylesheet" type="text/css" href="style.css"/>

</head>

<?php
    include('connect-db.php');

	$q_cubicle          = "";
	$q_equipment_name   = "";
	$q_tag              = "";
	$q_first_name       = "";
	$q_lastname         = "";
	$ordeer				= 0;
	$sum 				= 0;
	$sb					= "";
	
    $sql  = "SELECT inventory_id, inventory.tag, equipment.equipment_name, employee.first_name, employee.last_name, cubicles.name";
    $sql .=" FROM   inventory";
	$sql .=" LEFT JOIN equipment ON inventory.equipment=equipment.equipment_id";
	$sql .=" LEFT JOIN employee ON inventory.employee=employee.id";  
	$sql .=" LEFT JOIN cubicles ON inventory.cubicle=cubicles.id";
    if(isset($_GET['qq']))
	{
		$sql .= " WHERE true";
        if(isset($_GET['q_cubicle']))       $q_cubicle          = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_cubicle'])));
        if(isset($_GET['q_equipment_name']))$q_equipment_name   = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_equipment_name'])));
        if(isset($_GET['q_tag']))           $q_tag              = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_tag'])));
        if(isset($_GET['q_first_name']))    $q_first_name       = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_first_name'])));
        if(isset($_GET['q_lastname']))      $q_lastname         = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_lastname'])));

        if($q_cubicle != "")        $sql .=" AND cubicles.name="			. "'"   .$q_cubicle       ."'";
        if($q_equipment_name != "") $sql .=" AND equipment.equipment_name="	. "'"   .$q_equipment_name."'";
        if($q_tag != "")            $sql .=" AND inventory.tag="			. "'"   .$q_tag           ."'";
        if($q_first_name != "")     $sql .=" AND employee.first_name="		. "'"   .$q_first_name    ."'";
        if($q_lastname != "")       $sql .=" AND employee.last_name="		. "'" 	.$q_lastname      ."'";
    }

    if(isset($_GET['sb']))          $sb         = mysql_real_escape_string(htmlspecialchars(trim($_GET['sb'])));

	if ( isset($_GET['sb']) )
		if ( $_GET['ord'] == 0 )
		{
			$sql .= " ORDER BY " .  $sb . " ASC";
			$order = 1;
		}
		else
		{
			$sql .= " ORDER BY " .  $sb . " DESC";
			$order = 0;
		}

    
    $result = mysql_query($sql, $connection);

    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
	}
	$rows = mysql_num_rows($result);
    
?>
<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign='middle' align="right"><a href="addInventory.php"><font color='#ffffff'>add to inventory</font></a></td></tr>
</table>
</header>
<body>

	<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>
	<form action="" method="get">
	<tr background="img/1.gif">
	<td colspan="4"><b> Total is: <?=$rows?> </b></td>	
        <td><input type="submit" name="qq" value="GO">
        <input type="submit" name="clear" value="Clear"></td>
	<tr>
    <tr background="img/1.gif">
	<td><input type="text" size="2" name="q_cubicle"          value="<?=$q_cubicle ?>" /> 		</td>
	<td><input type="text" size="35" name="q_equipment_name"  value="<?=$q_equipment_name ?>" /></td>
	<td><input type="text" size="35" name="q_tag"             value="<?=$q_tag ?>" /> 			</td>
	<td><input type="text" size="35" name="q_first_name"      value="<?=$q_first_name ?>" /> 	</td>
	<td><input type="text" size="35" name="q_lastname"        value="<?=$q_lastname ?>" /> 		</td>
    </tr>
    </form>
<?php


    echo "<tr>\n";
	echo "<td><b><a href='inventory.php?sb=cubicles.name&ord=".$order."&qq=GO&q_cubicle=".$q_cubicle."&q_equipment_name=".$q_equipment_name."&q_tag=".$q_tag."&q_first_name=".$q_first_name."&q_lastname=".$q_lastname."'>                 Cubicle         </a></b></td>\n";
    echo "<td><b><a href='inventory.php?sb=equipment.equipment_name&ord=".$order."&qq=GO&q_cubicle=".$q_cubicle."&q_equipment_name=".$q_equipment_name."&q_tag=".$q_tag."&q_first_name=".$q_first_name."&q_lastname=".$q_lastname."'>      Equipment Name  </a></b></td>\n";
    echo "<td><b><a href='inventory.php?sb=inventory.tag&ord=".$order."&qq=GO&q_cubicle=".$q_cubicle."&q_equipment_name=".$q_equipment_name."&q_tag=".$q_tag."&q_first_name=".$q_first_name."&q_lastname=".$q_lastname."'>                 Tags            </a></b></td>\n";
    echo "<td><b><a href='inventory.php?sb=employee.first_name&ord=".$order."&qq=GO&q_cubicle=".$q_cubicle."&q_equipment_name=".$q_equipment_name."&q_tag=".$q_tag."&q_first_name=".$q_first_name."&q_lastname=".$q_lastname."'>           First Name      </a></b></td>\n";
    echo "<td><b><a href='inventory.php?sb=employee.last_name&ord=".$order."&qq=GO&q_cubicle=".$q_cubicle."&q_equipment_name=".$q_equipment_name."&q_tag=".$q_tag."&q_first_name=".$q_first_name."&q_lastname=".$q_lastname."'>            Last Name       </a></b></td>\n";
    echo "</tr>";

	$i=1;
    while ($row = mysql_fetch_assoc($result))
	{
		if( ($i++ % 1) == 0) // chenge 1 in to 2 for alternaiting colors in the rows
	        echo "<tr>\n";
		else
			echo "<tr bgcolor ='#e0e0e0'>\n";
        echo "<td>" . "<a href='edtInventory.php?id=" . $row['inventory_id'] . "'>" . $row['name']            ."</a>" . "</td>"; // Cubicles 
        echo "<td>" . "<a href='edtInventory.php?id=" . $row['inventory_id'] . "'>" . $row['equipment_name']  ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtInventory.php?id=" . $row['inventory_id'] . "'>" . $row['tag']             ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtInventory.php?id=" . $row['inventory_id'] . "'>" . $row['first_name']      ."</a>" . "</td>\n";
		echo "<td>" . "<a href='edtInventory.php?id=" . $row['inventory_id'] . "'>" . $row['last_name']       ."</a>" . "</td>\n";
        echo "</tr>";
    }
    echo "</table>";


    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>
