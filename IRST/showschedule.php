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
    font-size:103%;
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
<!--  <td valign='middle'><a href="addschedule.php"><font color='#ffffff'>add to scheduel</font></a></td></tr> -->
</table>
</header>

<body>
<?php
    include('connect-db.php');


    $sql = "SELECT *";
    $sql .=" FROM schedule";

    if(isset($_GET['qq']))
    {
    	$sql .=" WHERE true "; 
        if(isset($_GET['q_id']))            $q_id          = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_id'])));
        if(isset($_GET['q_rescheduled']))   $q_rescheduled = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_rescheduled'])));
        if(isset($_GET['q_date']))       	$q_date   	   = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_date'])));

        if($q_id != "")         	$sql .=" AND id=". 				"'"   .$_GET['q_id']."'";
        if($q_rescheduled != "")    $sql .=" AND rescheduled LIKE". "'%"  .$_GET['q_rescheduled']."%'";
        if($q_date != "")    		$sql .=" AND date LIKE".		"'%"  .$_GET['q_date']."%'";
    }
	

	if ( isset($_GET['sb']) )
		if ( $_GET['ord'] == 0 )
		{
			$sql .= " ORDER BY " .  mysql_real_escape_string( htmlspecialchars($_GET['sb']) ) . " ASC";
			$order = 1;
		}
		else
		{
			$sql .= " ORDER BY " .  mysql_real_escape_string( htmlspecialchars($_GET['sb']) . " DESC");
			$order = 0;
		}

    $result = mysql_query($sql, $connection);

    if (!$result)
    {
        echo "DB Error, could not query the database:<br>\n";
        echo 'MySQL Error: ' . mysql_error();
        exit;
    }
    
    echo "<table border='1' style='width:100%; border: 1px solid black; border-collapse: collapse;'>";
?>

    <tr>
    <form action="" method="get">
	<td><input type="text" size="3" name="q_id"             	value="<?= $q_id ?>"/> </td>
    <td><input type="text" size="35" name="q_rescheduled"       value="<?= $q_rescheduled ?>" /> </td>
    <td><input type="text" size="35" name="q_date"         		value="<?= $q_date ?>"/> 
    <input type="submit" name="qq" value="GO">
    <input type="submit" name="clear" value="Clear"></td>
    </form>
    </tr>

<?php
    echo "<tr>";
    echo "<td align='center'><a href='showschedule.php?ord=". $order . "&sb=id'>         		ID </a></td>";
    echo "<td align='center'><a href='showschedule.php?ord=". $order . "&sb=rescheduled'>    	Rescheduled </a></td>";
    echo "<td align='center'><a href='showschedule.php?ord=". $order . "&sb=date'>      		Date</a></td>";
    echo "</tr>";
    while ($row = mysql_fetch_assoc($result))
    {
        echo "<tr>\n";
        echo "<td>". $row['id']            . "</td>\n"; 
        echo "<td>". $row['rescheduled']   . "</td>\n";
        echo "<td>". $row['date']          . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";


    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>

