<?php	
include('functions.php');

session_start();


function get_status()
{
	db_connect();
	//$query = sprintf("SELECT q1.user_id,MAX(q1.question_id) as level FROM qrious as q1,qrious as q2 WHERE q1.user_id=q2.user_id GROUP by q1.user_id"); 
	$query="SELECT user_id,MAX(question_id) as level FROM qrious
GROUP BY user_id"; 
$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	return $result;
}

function get_count()
{
db_connect();
//$user_id=1355;
//$q="SELECT * FROM qrious WHERE user_id='$user_id'";
$q="SELECT * FROM qrious WHERE answered_at IS NULL ORDER by user_id";
$res=mysql_query($q);
return $res;
}


function get_user_id($user)
{
$connection=mysql_connect("localhost","apogee_apogee","n0tebo0|<");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_2012';
    mysql_select_db($dbname,$connection)or die("Error");
	$query= " select * from auth_user where username = '$user' ;";
		$result=mysql_query($query,$connection);
if(!$result) { echo mysql_error(); }
		$res=mysql_fetch_array($result);
	
		return $res['id'];
}


function get_count2()
{
$user="Benjamin Gates";
$user_id=get_user_id($user);
db_connect();
$q="SELECT * FROM qrious WHERE user_id='$user_id'";
//$q="SELECT * FROM qrious WHERE answered_at IS NULL ORDER by user_id";
$res=mysql_query($q);
if(!$res) { echo mysql_error(); }
return $res;
}



function get_profile($user_id)
{
	$connection=mysql_connect("localhost","apogee_apogee","n0tebo0|<");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_2012';
    mysql_select_db($dbname,$connection)or die("Error");
	
	$query= " select * from auth_user where id = '$user_id' ;";
		$result=mysql_query($query,$connection);
		$res=mysql_fetch_array($result);
	
	return $res;
}



if($_GET['del'])	{
	db_connect();
	$query=sprintf("DELETE FROM qrious WHERE user_id='%s' AND question_id='%s' AND answered_at IS NULL",mysql_real_escape_string($_GET['u']),mysql_real_escape_string($_GET['q']));
	$result=mysql_query($query);
	header("Location:b.php");
}


?>
<!doctype html>

<html lang="en-US">


<?php $result = get_count2(); ?>
<table style="font-size:15px;">
<tr><th style="padding:20px 20px 20px 0px; text-align:left">User_id</th><th style="padding:20px 20px 20px 0px; text-align:left">Name</th><th>Question_id</th><th style="padding:20px 20px 20px 0px; text-align:left">Chances</th><th>Answered Time</tr>
<?php 

while($row = mysql_fetch_array($result)) { 
$prof=get_profile($row['user_id']);
?>
<tr><td style="padding:10px; text-align:left"><?php echo $row['user_id']; ?></td><td style="padding:10px; text-align:left"><?php	echo $prof['username'];	?></td><td><?php echo $row['question_id']; ?><td style="padding:10px; text-align:left"><?php echo $row['chances']; ?></td><td><?php echo $row['answered_at']; ?></td></tr>
<?php   } ?>
</table>
<p><br/><br/>
</p>



</html>