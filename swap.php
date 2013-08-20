<?php 
include('functions.php');
session_start();
db_connect_qrious(); 
$user=$_SESSION['uid'];
$_SESSION['swap']=0;
//$que=get_max_ques($user);
$q=$_SESSION['max']+1;


//$fetch=sprintf("SELECT * from qrious where user_id='%s'",$user);
//$swp=mysql_query($fetch);
//$s=mysql_fetch_array($swp);
$swp=swap_range($q);
//$index="swap".$swp;
//$sw=$s[$index];


if(check_swap($user,$swp)) //if the user requests for swap then first set swap to 1 
{	
	$update=sprintf("UPDATE qrious SET swap%s='%s' WHERE user_id='%s'",$swp,$q,$user);
	$result=mysql_query($update);
	$_SESSION['swap']=1;
		}
//if swap is equal to question id then proceed else move to back index
if(!chk_swp_ques($user,$swp))  header('Location: index.php');
//else if($_SESSION['swap']!=1){
	//header('Location:index.php');
//}


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

switch($swp)
{
case"1":
include('header.php');
?>
<!-- Question 1 Comes Here  -->
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
<br/><br/></span>

<p>
<img src="images/swap1/1.jpg" width="900" height="650">
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=s1" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>



<?php
break;
case "2";
include('header.php');
?>
<!-- Question 2 comes here -->
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
<br/><br/></span>

<p>
<img src="images/swap2/1.jpg" width="900" height="650">
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=s2" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>


<?php
break;
case "3";
include('header.php');
?>
<!-- Question 3 comes here -->
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
<br/><br/></span>

<p>
<img src="images/swap2/1.jpg" width="900" height="650">
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=s2" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>

<?php
}//switch case ends

?>

