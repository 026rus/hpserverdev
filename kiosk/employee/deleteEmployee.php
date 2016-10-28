 <html>
 <head>
 <title>Edit Delet</title>
<link rel="stylesheet" type="text/css" href="../style.css" />

 </head>

<header>
<table border='0' style='width:100%' background="../img/1.gif" style="" >
<tr><td valign="middle" align="left" ><a href="index.html"> <img src="../img/header.gif" alt="logo" /> </a></td></tr>
</table>
</header>

<body>
<form action="" method="post">
<?php

if (isset($_GET['id']))
{
    if (is_numeric($_GET['id']))
    {
        include('../connect-db.php');
        $id = $_GET['id'];     
        $sql  = "SELECT *";
        $sql .= " FROM employee";
        $sql .= " WHERE id=" . $id;

        $result = mysql_query($sql, $connection);
        if (!$result)
        {
            echo "DB Error, could not query the database:<br>\n";
            echo 'MySQL Error: ' . mysql_error();
            exit;
        }

        $row = mysql_fetch_array($result);
        // check that the 'id' matches up with a row in the databse
        if($row)
        {

            // get data from db
            $first_name     = $row['first_name'];
            $middle_name    = $row['middle_name'];
            $last_name      = $row['last_name'];
            $email          = $row['email'];
            $id             = $row['id'];
        }
        else
        // if no match, display result
        {
            echo "ERROR !!! No results!";
        }
?>
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<table align="center" border='0' > <!-- tyle="width:100%" --> 
<tr>
 <td align ="center">
 <p><br></p></td>
 <td align ="center">
 <p></p></td>
</tr>
<tr><th align ="center" colspan='2'>
<p>Are you sure you want to delete this record: <?php echo $first_name;
            if ($middle_name != "" )  echo ", " . $middle_name;
            echo $last_name . ", " . $email; ?> </p>
</th></tr>
<?php
        mysql_close($connection);
    }
}
if (isset($_POST['cancel']))
{
    header("Location: showEmployees.php");
}


if(isset($_POST['delete']))
{

    if (is_numeric($_POST['id']))
    {
        include('../connect-db.php');
        $id = $_POST['id'];
        mysql_query("DELETE FROM employee WHERE id='$id'")
        or die(mysql_error());
        
        mysql_close($connection);

        header("Location: showEmployees.php");
    }
}

?>

<tr>
<td align="right"> <input type="submit" name="delete" value="Delete"></td>
<td align="left"> <input type="submit" name="cancel" value="Cancel"></td>
</tr>
</table>
</div>
</form>
</body>
</html>


