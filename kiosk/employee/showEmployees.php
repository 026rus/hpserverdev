<html>
<head>
<title> Employee </title>
<link rel="stylesheet" type="text/css" href="../style.css" />
</head>
<?php
    include('../connect-db.php');

    $q_id 			= "";
    $q_first_name 	= "";
    $q_middle_name 	= "";
    $q_last_name 	= "";
    $q_email 		= "";

    $sql = "SELECT employee.id, employee.first_name, middle_name, employee.last_name, employee.email";
    $sql .=" FROM employee";

    if(isset($_GET['qq']))
    {
        if(isset($_GET['q_id']))            $q_id          = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_id'])));
        if(isset($_GET['q_first_name']))    $q_first_name  = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_first_name'])));
        if(isset($_GET['q_middl_name']))    $q_middle_name = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_middle_name'])));
        if(isset($_GET['q_last_name']))     $q_last_name   = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_last_name'])));
        if(isset($_GET['q_email']))         $q_email       = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_email'])));

        if($q_id != "")         $sql .=" AND employee.id=". "'"           .$_GET['q_id']."'";
        if($q_first_name != "") $sql .=" AND employee.first_name="."'"    .$_GET['q_first_name']."'";
        if($q_middle_name != "")$sql .=" AND employee.middle_name="."'"   .$_GET['q_middle_name']."'";
        if($q_last_name != "")  $sql .=" AND employee.last_name=". "'"    .$_GET['q_last_name']."'";
        if($q_email != "")      $sql .=" AND employee.email=". "'"        .$_GET['q_email']."'";
    }


    if (isset($_GET['sb'])) $sql .=" ORDER BY " . mysql_real_escape_string( htmlspecialchars($_GET['sb']) );
    else $sql .=" ORDER BY first_name";

    $result = mysql_query($sql, $connection);
?>
<header>
<table border='0' style='width:100%' background="../img/1.gif" style="" >
<tr><td valign="middle" ><a href="index.html"> <img src="../img/header.gif" alt="logo" /> </a></td>
<td valign="middle" align="right">
<form method="post" action="addEmployee.php">
<button type="submit">Add New Employee</button>
</form>
</td> </tr>
</table>
</header>
<body>
<?php
    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    
    echo "<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>";
?>

	<tr >
		<td  background="../img/1.gif" colspan="5">
    	<form action="" method="get">
    	<input type="submit" name="qq" value="GO">
		<input type="submit" name="clear" value="Clear"></td>
	</tr>
    <tr>
    	<td><input type="text" size="3" name="q_id"             value="" /> </td>
    	<td><input type="text" size="35" name="q_first_name"    value="" /> </td>
    	<td><input type="text" size="35" name="q_middle_name"   value="" /> </td>
    	<td><input type="text" size="35" name="q_last_name"     value="" /> </td>
		<td><input type="text" size="35" name="q_email"         value="" /> </td>
    </form>
    </tr>

<?php
    echo "<tr>";
    echo "<td align='center'><a href='showEmployees.php?sb=id'>         ID </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=first_name'> First Name </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=middle_name'>Middel Name </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=last_name'>  Last Name </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=email'>      Email </a></td>";
    echo "</tr>";
    while ($row = mysql_fetch_assoc($result))
    {
        echo "<tr>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['id']            ."</a>" . "</td>\n"; // Cubicles 
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['first_name']    ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['middle_name']   ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['last_name']     ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['email']         ."</a>" . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";


    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>

