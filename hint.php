<?php  
include('functions.php');
db_connect_qrious();
session_start();
$user=$_SESSION['uid'];
$q=get_max_ques($user);
if(check_lifeline($q,$user)) //if true then update all entries with the user id
	{
		$update="UPDATE qrious SET life1=1 where user_id ='$user' ";
		mysql_query($update);
	}
	//try for a javascript pop saying hint used...
	else header('Location: index.php');
	$h=get_max_ques($user);
	$hint=$h['question_id'];
	
	?>
    
    <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="en-US">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Qrious2k12 | Home</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="now.css" rel="stylesheet" type="text/css" />
</head>
	<?php
switch($hint)
{
	case 1:
	include('header.php');
	?>
<!-- hint (1) here -->

<?php
include('footer2.php');
break;
case 2:
include('header.php');
?>
<!--  hint (2) here -->
<p>TRY Harder!!! LOL :P</p>

<?php
include(footer2.php);
break;
case 3:
include('header.php');
?> 

<?php
include(footer2.php);
break;
case 4:
include('header.php');
?> 
<?php
include(footer2.php);
break;
case 5:
include('header.php');
?> 
<?php
include(footer2.php);
break;
case 6:
include('header.php');
?> 
<?php
include(footer2.php);
break;
case 7:
include('header.php');
?> <?php
include(footer2.php);
break;
case 8:
include('header.php');
?> 
<?php
include(footer2.php);
break;
case 9:
include('header.php');
?> 
<!--  hint (3) here -->
<p>TRY Harder!!! LOL :P</p>
 <?php
include('footer.php');
}//switch case ends
?>
