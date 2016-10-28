<html>
<head>
<title> MySQL </title>

<style>
/* unvisited link */
a:link
 {
    color: #000000;
    text-decoration: none;
    font-family: "HPSimplified";
 }

/* visited link */
a:visited
 {
    color: #000000;
    text-decoration: none;
    font-family: "HPSimplified";

 }

/* mouse over link */
a:hover
 {
    color: #0000FF;
    text-decoration: underline;
    font-family: "HPSimplified";
    font-size:105%;
 }

/* selected link */
a:active
 {
    color: #0000FF;
    font-family: "HPSimplified";
    text-decoration: underline;
 }

</style>

</head>

<header>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign='middle'><a href="addInventory.php"><font color='#ffffff'>add to inventory</font></a></td></tr>
</table>
</header>

<body>
<?php
    include('connect-db.php');

    $sql  = "SELECT inventory_id, inventory.tag, equipment.equipment_name, employee.first_name, employee.last_name, cubicles.name";
    $sql .=" FROM   inventory, equipment, employee, cubicles";
    $sql .=" WHERE inventory.equipment=equipment.equipment_id AND inventory.employee=employee.id AND inventory.cubicle=cubicles.id";
    if(isset($_GET['qq']))
    {
        if(isset($_GET['q_cubicle']))       $q_cubicle          = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_cubicle'])));
        if(isset($_GET['q_equipment_name']))$q_equipment_name   = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_equipment_name'])));
        if(isset($_GET['q_tag']))           $q_tag              = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_tag'])));
        if(isset($_GET['q_first_name']))    $q_first_name       = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_first_name'])));
        if(isset($_GET['q_lastname']))      $q_lastname         = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_lastname'])));

        if($q_cubicle != "")        $sql .=" AND cubicles.name=". "'"              .$_GET['q_cubicle']."'";
        if($q_equipment_name != "") $sql .=" AND equipment.equipment_name="."'"    .$_GET['q_equipment_name']."'";
        if($q_tag != "")            $sql .=" AND inventory.tag=". "'"              .$_GET['q_tag']."'";
        if($q_first_name != "")     $sql .=" AND employee.first_name=". "'"        .$_GET['q_first_name']."'";
        if($q_lastname != "")       $sql .=" AND employee.last_name=". "'"         .$_GET['q_lastname']."'";
    }

    if ( isset($_GET['sb']) ) $sql .= " ORDER BY " .  mysql_real_escape_string( htmlspecialchars($_GET['sb']) );
    
    $result = mysql_query($sql, $connection);

    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    
    echo "<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>";
?>
    <form action="" method="get">
    <tr>
        <td><input type="text" size="2" name="q_cubicle"         value="" /> </td>
        <td><input type="text" size="35" name="q_equipment_name"  value="" /> </td>
        <td><input type="text" size="35" name="q_tag"             value="" /> </td>
        <td><input type="text" size="35" name="q_first_name"      value="" /> </td>
        <td><input type="text" size="35" name="q_lastname"        value="" /> 
        <input type="submit" name="qq" value="GO">
        <input type="submit" name="clear" value="Clear"></td>
    </tr>
    </form>
<?php


    echo "<tr>\n";
    echo "<td><a href='inventory.php?sb=cubicles.name'>                 Cubicle         </a></td>\n";
    echo "<td><a href='inventory.php?sb=equipment.equipment_name'>      Equipment Name  </a></td>\n";
    echo "<td><a href='inventory.php?sb=inventory.tag'>                 Tags            </a></td>\n";
    echo "<td><a href='inventory.php?sb=employee.first_name'>           First Name      </a></td>\n";
    echo "<td><a href='inventory.php?sb=employee.last_name'>            Last Name       </a></td>\n";
    echo "</tr>";

    while ($row = mysql_fetch_assoc($result))
    {
        echo "<tr>\n";
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
