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
<td valign='middle' align="right"><a href="addEmployee.php"><font color='#ffffff'>add new employee</font></a></td></tr>
</table>
</header>

<body>
<?php
    include('connect-db.php');


    $sql = "SELECT employee.id, employee.first_name, employee.last_name, employee.email, employee.gender, projects.pname, cubicles.name";
    $sql .=" FROM employee";
    $sql .=" LEFT JOIN cubicles on employee.locations=cubicles.id";
    $sql .=" LEFT JOIN projects on employee.project=projects.id";
    // $sql .=" WHERE employee.project=projects.id AND employee.locations=cubicles.id"; 

    if(isset($_GET['qq']))
    {
        if(isset($_GET['q_id']))            $q_id          = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_id'])));
        if(isset($_GET['q_first_name']))    $q_first_name  = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_first_name'])));
        if(isset($_GET['q_last_name']))     $q_last_name   = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_last_name'])));
        if(isset($_GET['q_email']))         $q_email       = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_email'])));
        if(isset($_GET['q_gender']))        $q_gender      = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_gender'])));
        if(isset($_GET['q_pname']))         $q_pname       = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_pname'])));
        if(isset($_GET['q_cubname']))       $q_cubname     = mysql_real_escape_string(htmlspecialchars(trim($_GET['q_cubname'])));

        if($q_id != "")         $sql .=" AND employee.id=". "'"           .$_GET['q_id']."'";
        if($q_first_name != "") $sql .=" AND employee.first_name="."'"    .$_GET['q_first_name']."'";
        if($q_last_name != "")  $sql .=" AND employee.last_name=". "'"    .$_GET['q_last_name']."'";
        if($q_email != "")      $sql .=" AND employee.email=". "'"        .$_GET['q_email']."'";
        if($q_gender != "")     $sql .=" AND employee.gender=". "'"       .$_GET['q_gender']."'";
        if($q_pname != "")      $sql .=" AND projects.pname=". "'"        .$_GET['q_pname']."'";
        if($q_cubname != "")    $sql .=" AND cubicles.name=". "'"         .$_GET['q_cubname']."'";
    }


    if (isset($_GET['sb'])) $sql .=" ORDER BY " . mysql_real_escape_string( htmlspecialchars($_GET['sb']) );
    else $sql .=" ORDER BY first_name";
	
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
    <td><input type="text" size="3"  name="q_id"             value="" /> </td>
    <td><input type="text" size="25" name="q_first_name"    value="" /> </td>
    <td><input type="text" size="25" name="q_last_name"     value="" /> </td>
    <td><input type="text" size="35" name="q_email"         value="" /> </td>
    <td><input type="text" size="3"  name="q_gender"        value="" /> </td>
    <td><input type="text" size="30" name="q_pname"         value="" /> </td>
    <td><input type="text" size="5"  name="q_cubname"        value="" /> 
    <input type="submit" name="qq" value="GO">
    <input type="submit" name="clear" value="Clear"></td>
    </form>
    </tr>

<?php
    echo "<tr>";
    echo "<td align='center'><a href='showEmployees.php?sb=id'>         ID </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=first_name'> First Name </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=last_name'>  Last Name </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=email'>      Email </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=gender'>     Gender </a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=pname'>      Project</a></td>";
    echo "<td align='center'><a href='showEmployees.php?sb=cubicles.name'>      Location</a></td>";
    echo "</tr>";
    while ($row = mysql_fetch_assoc($result))
    {
        echo "<tr>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['id']            ."</a>" . "</td>\n"; // Cubicles 
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['first_name']    ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['last_name']     ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['email']         ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['gender']        ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['pname']         ."</a>" . "</td>\n";
        echo "<td>" . "<a href='edtEmployee.php?id=" . $row['id'] . "'>". $row['name']          ."</a>" . "</td>\n";
        echo "</tr>\n";
    }
    echo "</table>";


    mysql_free_result($result);
    mysql_close($connection);
?>
</body>
</html>

