<?php	
include('functions.php');

function get_id($user)
{
	$connection=mysql_connect("localhost","apogee_apogee","n0tebo0|<");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_2012';
    mysql_select_db($dbname,$connection)or die("Error");
	
	$query= sprintf(" select * from auth_user where username = '%s'",$user);
		$result=mysql_query($query,$connection);
		$res=mysql_fetch_array($result);
	
	return $res;
}


get_id("karl");

$user_id=$res['id'];

db_connect();
$query = sprintf("SELECT * FROM qrious WHERE user_id='%s'",$user_id);

$result=mysql_query($query);

print_r($result);
echo "<br>";


?>