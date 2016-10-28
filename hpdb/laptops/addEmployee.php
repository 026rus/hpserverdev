<?php
//For developing only !
error_reporting(E_ALL);
ini_set("display_errors", TRUE);

function normalizeString ($str = '')
{
	$str = strip_tags($str);
	$str = preg_replace('/[\r\n\t ]+/', ' ', $str);
	$str = preg_replace('/[\"\*\/\:\<\>\?\'\|]+/', ' ', $str);
	$str = strtolower($str);
	$str = html_entity_decode( $str, ENT_QUOTES, "utf-8" );
	$str = htmlentities($str, ENT_QUOTES, "utf-8");
	$str = preg_replace("/(&)([a-z])([a-z]+;)/i", '$2', $str);
	$str = str_replace(' ', '-', $str);
	$str = rawurlencode($str);
	$str = str_replace('%', '-', $str);
	$extp = strrpos($str, ".");
	$str = str_replace('.', '_', substr($str, 0, $extp)) . substr($str, $extp);
	return $str;
}
function sevefile()
{
	try {
			if ( !isset($_FILES['upfile']['error']) || is_array($_FILES['upfile']['error']))
			{
			        throw new RuntimeException('Invalid parameters.');
			}
			
			// Check $_FILES['upfile']['error'] value.
			switch ($_FILES['upfile']['error'])
			{
				case UPLOAD_ERR_OK:
					break;
				case UPLOAD_ERR_NO_FILE:
					throw new RuntimeException('No file sent.');
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					throw new RuntimeException('Exceeded filesize limit.');
				default:
					throw new RuntimeException('Unknown errors.');
			}
			if ($_FILES['upfile']['size'] > 5000000)
			{
				throw new RuntimeException('Exceeded filesize limit.');
			}
			
			$finfo = new finfo(FILEINFO_MIME_TYPE);
			if (false === $ext = array_search(
			$finfo->file($_FILES['upfile']['tmp_name']),
			array(
					'jpg' => 'image/jpeg',
					'png' => 'image/png',
					'gif' => 'image/gif',
				),
			true
			))
			{
				throw new RuntimeException('Invalid file format.');
			}
			
			$filename = normalizeString( $_FILES['upfile']['name'] );
			echo "File = " . $filename;
			if (!move_uploaded_file( $_FILES['upfile']['tmp_name'], sprintf('../../kiosk/people/%s', $filename)))
			{
				throw new RuntimeException('Failed to move uploaded file.');
			}
			
			return $filename;
		} catch (RuntimeException $e)
		{
			return NULL;
		}
}


function getdata()
{
	?>
 <form enctype="multipart/form-data" action="" method="post">
 <input type="hidden" name"MAX_FILE_SIZE" value="5000000"/>
 <div>
 <table align="center" border='1'>
 <tr>
 <td align="right"><strong>First name</strong></td><td align="left"> <input type="text" style="width: 300px;" name="first_name" value=""><br/></td>
 </tr> <tr>
 <td align="right"><strong>Middle name</strong></td><td align="left"> <input type="text" style="width: 300px;" name="middle_name" value=""><br/></td>
 </tr> <tr>
 <td align="right"><strong>Last name</strong></td><td align="left"> <input type="text" style="width: 300px;" name="last_name" value=""><br/></td>
 </tr> <tr>
 <td align="right"><strong>Email</strong></td><td align="left"> <input type="text" style="width: 300px;" name="email" value=""><br/></td>
 </tr> <tr>
 <td align="right"><strong>Photo </strong></td><td align="left"> <input type="file" name="upfile"><br/></td>
</tr>
 </table>

 <table align="center">
 <tr>
 <td align ="center">
 <p></p></td>
 <td align="center"> <input type="submit" name="submit" value="submit"></td>
 <td align="center"> <input type="submit" name="cancel" value="cancel"></td>
 </tr>
 </table>
 </div>
 </form>
	<?php
}
function addEmployee()
{
	var_dump($_REQUEST);
	include_once('connect-db.php');

	// get form data, making sure it is valid
	$first_name  = mysql_real_escape_string(htmlspecialchars($_POST['first_name']));
	$middle_name = mysql_real_escape_string(htmlspecialchars($_POST['middle_name']));
	$last_name   = mysql_real_escape_string(htmlspecialchars($_POST['last_name']));
	$email       = mysql_real_escape_string(htmlspecialchars($_POST['email']));
	$upfile      = mysql_real_escape_string(htmlspecialchars($_POST['upfile']));
	$photo 		 = sevefile();	
	
	// check that firstname/lastname fields are both filled in
	if ($first_name == '' || $last_name == '')
	{
	    // generate error message
	    $error = 'ERROR: Please fill the all required fields!';
	
	    //error, display form
	}
	else
	{
	    // save the data to the database
	    mysql_query("INSERT INTO employee VALUE(null, '$first_name', '$middle_name', '$last_name', '$email', '$photo')")
	    or die(mysql_error());
	
	    // once saved, redirect back to the view page
	    header("Location: laptops.php");
	}
	mysql_free_result($result);
	mysql_close($connection);
}

// check if it wos added! 
if (isset($_POST['submit']))
{
	addEmployee();
}
else if (isset($_POST['cancel']))
{
	// once saved, redirect back to the view page
	header("Location: laptops.php");
}
else
{
?>

<html>
<head>
<title>Add Employee</title>

<link rel="stylesheet" type="text/css" href="style.css"/>

</head>
<header>
<script src="javascript/jadding.js" type="text/javascript"></script>
<table border='0' style='width:100%' background="img/1.gif" style="" >
<tr><td valign="middle" ><a href=""> <img src="img/header.gif" alt="logo" /> </a></td>
<td valign='middle' align="right">
</td></tr>
</table>
</header>

<body>
<?php getdata(); ?>
<?php var_dump($_REQUEST);?>
</body>
</html>
<?php
}
?>
