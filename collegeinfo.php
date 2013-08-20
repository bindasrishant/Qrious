<?php

include('functions.php');

function get_status()
{
	db_connect();
	$query = sprintf("SELECT  user_id,MAX(question_id) as level,MAX(answered_at) FROM qrious GROUP by user_id ORDER by MAX(question_id) DESC,MAX(answered_at)"); 
	$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	return $result;
}




function get_collegeInfo($user_id)
{
	$connection=mysql_connect("localhost","apogee_apogee","n0tebo0|<");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_2012';
    mysql_select_db($dbname,$connection)or die("Error");
	
	$query=sprintf("SELECT t1.user_ptr_id,t1.college_id,t2.name from registration_participant t1,registration_college t2 WHERE t1.college_id=t2.id AND t1.user_ptr_id=%s",$user_id);
	
	$result=mysql_query($query);
	
	
	while($row=mysql_fetch_array($result))
	{
		echo $row['name']."<br>";
	}
	
	
}

$result = get_status(); 


while($row = mysql_fetch_array($result)) 
{
	
	get_collegeInfo($row['user_id']); 

}





?>

