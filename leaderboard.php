<?php	
include('functions.php');

session_start();


function get_status()
{
	db_connect();
	$query = sprintf("SELECT  user_id,MAX(question_id) as level,MAX(answered_at) FROM qrious GROUP by user_id ORDER by MAX(question_id) DESC,MAX(answered_at)"); 
	$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	return $result;
}



function get_profile($user_id)
{
	$connection=mysql_connect("localhost","apogee_apogee","n0tebo0|<");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_2013';
    mysql_select_db($dbname,$connection)or die("Error");
	
	$query= " select * from auth_user where id = '$user_id' ;";
		$result=mysql_query($query,$connection);
		$res=mysql_fetch_array($result);
	
	return $res;
}



?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="en-US">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Qrious2k13 | Leaderboard</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="now.css" rel="stylesheet" type="text/css" />
</head>
<body>
<?php

include"header.php";
?>
<!-- end #menu -->

		<div class="post">
			<h1 class="title">LEADERBOARD:</h1>

<?php $result = get_status(); ?>

<p>
<table style="font-size:15px;">
<tr><th style="padding:20px 20px 20px 0px; text-align:left">Rank</th><th style="padding:20px 20px 20px 0px; text-align:left">Name</th><th style="padding:20px 20px 20px 0px; text-align:left">Level</th></tr>
<?php 
$i =1;

while($row = mysql_fetch_array($result)) { 


$prof=get_profile($row['user_id']);
?>
<?php if($prof['username'] && $prof['username']!=="dummyplayer4" && $prof['username']!=="dummy_player" && $prof['username']!=="abx" && $row['user_id']!=="5519" && $prof['username'] !=="sandeepkv92" && $prof['username'] !== "qrius" && $prof['username'] !=="wrahool" && $prof['username']!=="art") {  ?><tr><td style="padding:10px; text-align:left"><?php echo $i; ?></td><td style="padding:10px; text-align:left"><?php	echo $prof['username'];	?></td><td style="padding:10px; text-align:left"><?php echo $row['level']-1; ?></td><td style="padding:10px"></td></tr>
<?php $i++; } } ?>
</table>
</p>
</div>
<?php

include"footer2.php";
?>

