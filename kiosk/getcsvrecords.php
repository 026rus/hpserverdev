<?php

    include('connect-db.php');
    $id         = "";
    $firstname  = "";
    $lastname   = "";
    $company    = "";
    $country    = "";
    $reason     = "";
    $sponsor    = "";
    $datein     = "";
    $dateout    = "";
    $tempbadge  = "";
    $order      = "";
    $sb         = "";

if( $_SERVER['REQUEST_METHOD'] == 'POST' )
{
    if(isset($_POST['id']))    		$id   		= mysql_real_escape_string(htmlspecialchars(trim($_POST['id'])));
    if(isset($_POST['firstname']))  $firstname  = mysql_real_escape_string(htmlspecialchars(trim($_POST['firstname'])));
    if(isset($_POST['lastname']))	$lastname   = mysql_real_escape_string(htmlspecialchars(trim($_POST['lastname'])));
    if(isset($_POST['company']))    $company   	= mysql_real_escape_string(htmlspecialchars(trim($_POST['company'])));
    if(isset($_POST['country']))	$country   	= mysql_real_escape_string(htmlspecialchars(trim($_POST['country'])));
    if(isset($_POST['reason']))		$reason   	= mysql_real_escape_string(htmlspecialchars(trim($_POST['reason'])));
    if(isset($_POST['sponsor']))	$sponsor   	= mysql_real_escape_string(htmlspecialchars(trim($_POST['sponsor'])));
    if(isset($_POST['datein']))		$datein   	= mysql_real_escape_string(htmlspecialchars(trim($_POST['datein'])));
    if(isset($_POST['dateout']))    $dateout   	= mysql_real_escape_string(htmlspecialchars(trim($_POST['dateout'])));
    if(isset($_POST['tempbadge']))  $tempbadge  = mysql_real_escape_string(htmlspecialchars(trim($_POST['tempbadge'])));
    if(isset($_POST['order']))      $order      = mysql_real_escape_string(htmlspecialchars(trim($_POST['order'])));
    if(isset($_POST['sb']))         $sb         = mysql_real_escape_string(htmlspecialchars(trim($_POST['sb'])));
 /*       
    echo "id = "		. $id          . "<br>\n"; 
    echo "firstname = "	. $firstname   . "<br>\n";
    echo "lastname = " 	. $lastname    . "<br>\n";
    echo "company = "	. $company     . "<br>\n";
    echo "country = "	. $country     . "<br>\n";
    echo "reason = "	. $reason      . "<br>\n";
    echo "sponsor = "	. $sponsor     . "<br>\n";
    echo "datein = "	. $datein      . "<br>\n";
    echo "dateout = "	. $dateout     . "<br>\n";
    echo "tempbadge = "	. $tempbadge   . "<br>\n";    
    echo "order = "	    . $order       . "<br>\n";    
    echo "sb = "	    . $sb          . "<br>\n";    
  */

    $sql  = "SELECT *";
    $sql .= " FROM records";
    $sql .= " WHERE true ";
    if($id != "") 			$sql .=" AND id=". 				"'"  .   $id .		"'";
    if($firstname != "") 	$sql .=" AND firstname LIKE ". 	"'%" .   $firstname .	"%'";
    if($lastname != "") 	$sql .=" AND lastname LIKE ".	"'%" .   $lastname .	"%'";
    if($company != "") 		$sql .=" AND company LIKE ". 	"'%" .   $company .	"%'";
    if($country != "") 		$sql .=" AND country LIKE ". 	"'%" .   $country .	"%'";
    if($reason != "") 		$sql .=" AND reason LIKE ". 	"'%" .   $reason .	"%'";
    if($sponsor != "") 		$sql .=" AND sponsor LIKE ".	"'%" .   $sponsor .	"%'";
    if($datein != "") 		$sql .=" AND datein LIKE ". 	"'%" .   $datein .	"%'";
    if($dateout != "") 		$sql .=" AND dateout LIKE ". 	"'%" .   $dateout .	"%'";
    if($tempbadge != "") 	$sql .=" AND tempbadge LIKE ".	"'%" .   $tempbadge .	"%'";

   

    if ( $sb != "" )
    	if ( $order == 0 )
    	{
    		$sql .= " ORDER BY " .  $sb . " DESC";
    	}
    	else
    	{
    		$sql .= " ORDER BY " .  $sb . " ASC";
    	}
    

    $result = mysql_query($sql, $connection);
    
    
    $str = '"ID","First Name","Last Name","Company","Country","Reason","Sponsor","Date In","Date Out","Temp Badge"';
    $str .= "\n";
    
    while ($row = mysql_fetch_assoc($result))
    {
        $str .= '"' . $row['id']         . '"' . ",";  
        $str .= '"' . $row['firstname']  . '"' . ",";
        $str .= '"' . $row['lastname']   . '"' . ",";
        $str .= '"' . $row['company']    . '"' . ",";
        $str .= '"' . $row['country']    . '"' . ",";
        $str .= '"' . $row['reason']     . '"' . ",";
        $str .= '"' . $row['sponsor']    . '"' . ",";
        $str .= '"' . $row['datein']     . '"' . ",";
        $str .= '"' . $row['dateout']    . '"' . ",";
        $str .= '"' . $row['tempbadge']  . '"' . "\n";
    }
    
    $file = "records/Records.csv";
    file_put_contents($file, $str);
    mysql_free_result($result);
}


    if(!file_exists($file)) die("I'm sorry, the file doesn't seem to exist.");

    $type = filetype($file);
    // Get a date and timestamp
    $today = date("F j, Y, g:i a");
    $time = time();
    // Send file headers
    header("Content-type: $type");
    header("Content-Disposition: attachment;filename=Records.csv");
    header("Content-Transfer-Encoding: binary"); 
    header('Pragma: no-cache'); 
    header('Expires: 0');
    // Send the file contents.
    set_time_limit(0); 
    readfile($file);
?>
