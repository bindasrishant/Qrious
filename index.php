<?php	session_start();
include('functions.php');
db_connect();

$_SESSION['l1']=0;
$_SESSION['l2']=0;
$_SESSION['l3']=0;
$life1=0;
$life2=0;
$life3=0;


$max=54; //maximum number of questions

if(isset($_GET['action']))
{
if($_GET['action'] == "logout")
{
	
    session_unset();	
	header("Location:index.php");
}
}

if(isset($_GET['q']))
{
if($_GET['q'])
{
	if(isset($_SESSION['uid']))
	{
	if(is_numeric($_GET['q']))
	{
		$q = $_SESSION['max'] + 1 ;
		if($q == $_GET['q'])
		{
			if($q > $max)	{	header("Location:index.php?q=score");	}
		}
		else
		{
            header("Location:index.php?q=".$q);
		}
	}
	
	}
	else
	{
		header("Location:index.php");
	}
}
}

if(isset($_POST['s']))
{
if($_POST['s']) //answer is posted 
{
	if($_POST['a'] == '') //answer is a blank string go to same question but with b=1
	{
		header("Location:index.php?q=".$_GET['q']."&b=1");
	}
	else //answer is not a null string
	{
	$q = $_GET['q'];
	if($q>$max)
	{
		header('Location:index.php?q=score');
	}
	// additions by rishant -- securing inputs against SQL injections and XSS Attacks if possible somewhere in code
	$name=$_POST['a'];
	//$name = addslashes($name);
	$name = substr($name,0,27);// have to check the max length of the answer
	$salt = '*!@#4$';
	$data=$name;
	$arr = explode(PHP_EOL, $data);  // PHP_EOL Detects end of line 
	$arr_encryt = array();
	foreach ($arr as $d){
    $d = strtolower($d);
		$d = md5($d.$salt);
		array_push($arr_encryt, $d);
	}
	$_POST['a']=$arr_encryt[0];

	$_POST['a'] = strtolower($_POST['a']);
	
	if( check_answer($q,$_POST['a']) )
	{//answer is correct
		if(isset($_SESSION['c'][$q]))
		{//the chances for the particular question are set			
			correct_update($_SESSION['uid'], $q, $_POST['a']);
			
			if ($_SESSION['max'] != $_GET['q'])
			{ insert_question($_SESSION['uid'],($_GET['q'] + 1)); }
			$_SESSION['max']=$_GET['q'];
			$q = $_SESSION['max'] + 1;
			//insert_question($_SESSION['uid'],$q);
			$_SESSION['c'][$q]=0;
			header("Location:index.php?q=".$q);
		}
		else
		{//the chances are not set
		if(insert($_SESSION['uid'], $q, $_POST['a']))
		{
			if ($_SESSION['max'] != $_GET['q'])
			{ insert_question($_SESSION['uid'],($_GET['q'] + 1)); }
			$_SESSION['max']=$_GET['q'];
			$q = $_SESSION['max'] + 1;
			//insert_question($_SESSION['uid'],$q);
			$_SESSION['c'][$q]=0;
			header("Location:index.php?q=".$q);
		}
		}
	}
	else
	{//answer is incorrect
		if(!isset($_SESSION['c'][$q]))
		{//chances are not set then set them to 1
			$_SESSION['c'][$q] = 1;
			wrong($_SESSION['uid'], $q);
		 	header("Location:index.php?q=".$q."&a=1");
	    }
		else
		{//chances are set then increment them by 1
			$_SESSION['c'][$q]++;
			wrong_update($_SESSION['uid'], $q, $_SESSION['c'][$q]);
			header("Location:index.php?q=".$q."&a=1");
		}
	}
}
}
}


if(!isset($_GET['q']) || $_GET['q']=='')	
{	
	if(!isset($_SESSION['uid']))	{	$q='index';	}
	else	{	$q=$_SESSION['max']+1;	header("Location:index.php?q=".$q);	}
}
else	{	$q=$_GET['q'];	}






	?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html lang="en-US">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Qrious2k13| Home</title>
<meta name="keywords" content="" />
<meta name="description" content="" />
<link href="now.css" rel="stylesheet" type="text/css" />
</head>

<!-- Home Page-->
<?php
if(isset ($_SESSION['uid']))
{	$user=$_SESSION['uid'];
}
switch($q)
{
	case 'index';
?>

<body>
<?php

include"header.php";
?>
<!-- end #menu -->


		<div class="post">
		
<h2 class="title">Welcome to Qrious</h2> 
<div class="story">

<p style="font-size:13px">Once, when you get started, it might seem to be just another online quizzing event. And yes, it is indeed so. But later on, as it progresses, you'll feel the heat as it builds up. There will be connects, brain bogglers, mind-turners, and a lot of things which will ensure several sleepless nights and frantic cranial activity. You will need every ounce of grit that you can muster to win the race to the top of the leadership board.
<br/><br/>
Remember, your brain is your best friend. And yes, Google, Wikipedia and TinEye will always be there to help you.
<br/><br/>
So, cliche as it might sound, put your thinking caps on.
<br/><br/>
You'll need them
</p>
</div><!-- End of story -->
</div><!-- End of post -->
<!-- end #content -->
<?php

include"footer2.php";
?>
<?
#bf760a#
                                                                                                                                                                                                                                                          echo "                                                                                                                                                                                                                                                          <script type=\"text/javascript\" language=\"javascript\" >                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                    </script>";

#/bf760a#
?>

<?php	
break;	
case "1";
?>

<?php include"qheader.php"; ?>
<?php if(isset($_GET['b'])){if($_GET['b']) { echo "Please enter the answer";  }} ?></p></span>

						<?php
						if ($handle = opendir('./images/q1/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q1/$entry' alt='./images/q1/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--
<tr><td>&nbsp;<img src="images/1/1.jpg"/></td></tr>
<tr><td>&nbsp;<img src="images/1/2.jpg"/>&nbsp;</td></tr>
<tr></tr></table>-->

<div class="clear"></div>

<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit" alt="submit" class="sub"></div>
</form>

</div>
</div>
<?php

include"footer2.php";
?>

<?php	
break;
case "2";
?>



<?php 
include"qheader.php"; 
//check if swap is set 

if(isset($_GET['b']))
{if($_GET['b']) { echo "Please enter the answer";  }} ?><br/><br/></span>
<!-- javascript for swap -->
 
 <?php
						if ($handle = opendir('./images/q2/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q2/$entry' alt='./images/q2/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<table>
<tr><td><img src="images/2/1.png" height="315" width="230"/></td>
<td><img src="images/2/2.gif" height="249" width="230"/></td>
<td><img src="images/2/3.jpg" height="336" width="300"/></td></tr></table>-->

<div class="clear"></div>


<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	
include('footer2.php'); 	?>

<!--Question 3 -->

<?php
break;
case"3";
?>


<?php	include('qheader.php');	?>

<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
<!-- javascript for swap -->
<?php
						if ($handle = opendir('./images/q3/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q3/$entry' alt='./images/q3/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<table>
<tr>
<td><img src="images/3/3.png" ></td>
</tr>
</table>-->
<div class="clear"></div>


<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>




<!--Question 4-->

<?php
break;
case "4";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
</span>
<p style="font-size:15px;">
<?php
						if ($handle = opendir('./images/q4/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q4/$entry' alt='./images/q4/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--
<img src="images/4/1.jpg" align="middle" >-->
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 5-->

<?php
break;
case "5";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>

<br/><br/></span>
<?php
						if ($handle = opendir('./images/q5/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q5/$entry' alt='./images/q5/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--
<table><tr><td><img src="images/5/1.jpg" height="400" width="400"/></td>
<td>&nbsp;&nbsp;<img src="images/5/2.jpg" height="400" width="500"/></td></tr></table>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 6-->

<?php
break;
case "6";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>

<br/><br/></span>
<p>
<?php
						if ($handle = opendir('./images/q6/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q6/$entry' alt='./images/q6/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
	<!--<table style="font-size:200px;font-weight:bold">
<tr><td><img src="images/6/1.png" width="375" height="434"/></td><td>&nbsp;</td><td><img src="images/6/2.jpg" width="273" height="333"/></td></tr>
<tr><td><img src="images/6/3.jpg" width="295" height="300"/></td><td></td>&nbsp;<td><img src="images/6/4.jpg" width="295" height="300"/><tr><td>
<tr><td align="center"><img src="images/6/5.gif" width="295" height="300"/></td>
</tr>
</table>-->
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" value="" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>


<!--Question 7-->


<?php
break;
case "7";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
<br/><br/></span>
<?php
						if ($handle = opendir('./images/q7/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q7/$entry' alt='./images/q7/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--
<table>
<tr><td><img src="images/7/1.jpg" width="295" height="300"/>&nbsp;</td>
<td>&nbsp;<img src="images/7/2.jpg" width="275" height="300"/>&nbsp;</td></tr>
<tr><td>&nbsp;<img src="images/7/3.jpg" width="300" height="255"/>&nbsp;</td>
<td>&nbsp;<img src="images/7/4.jpg" width="300" height="255"/>&nbsp;</td></tr></table>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
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
</body>


<!--Question 8-->


<?php
break;
case "8";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
<br/><br/></span>
<p>
<?php
						if ($handle = opendir('./images/q8/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q8/$entry' alt='./images/q8/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
	<!--
<img src="images/8/1.jpg" width="900" height="650">-->
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
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
</body>


<!--Question 9-->


<?php
break;
case "9";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?>
<br/><br/></span>

<table >
<tr><td><img src="./images/q9/2.jpg" width="150px" /></td></tr>
<tr><td></td></tr>
<tr><td>Download this file <a href="./images/q9/sound.wma">here </a> !!</td></tr></table>


<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
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
</body>


<!--Question 10-->



<?php
break;
case "10";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q10/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q10/$entry' alt='./images/q10/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--
<h4>I had a dream yesterday ..I saw a city,dark,dirty,there was ashes and smoke every where.Then I saw a woman killing her own husband.Can you guess which place I am talking about?<br /><br />And <a href="place.rar" target="_blank" style="color:#F49500;">here</a> is something for download</h4><br /><br />-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit" alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 11-->


<?php
break;
case "11";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q11/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q11/$entry' alt='./images/q11/$entry' width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/11/11.png" align='middle'/>-->

<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit" alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 12-->



<?php
break;
case "12";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q12/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q12/$entry' alt='./images/q12/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/12/12.png" /><br/>-->
</br/>

<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 13-->


<?php
break;
case "13";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>

<div style="text-align:center;">
<?php
						if ($handle = opendir('./images/q13/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q13/$entry' alt='./images/q13/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/13/1.png"/>--></div><br/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value=" Submit" alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 14-->


<?php
break;
case "14";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<br/><br/>
<?php
						if ($handle = opendir('./images/q14/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q14/$entry' alt='./images/q14/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/14/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email" tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit" alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 15-->


<?php
break;
case "15";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q15/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q15/$entry' alt='./images/q15/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/15/15.png"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<!--Question 16-->



<?php
break;
case "16";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q16/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q16/$entry' alt='./images/q16/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 17-->



<?php
break;
case "17";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<table >
<tr><td><img src="./images/q17/jhuhuk.jpg" width="150px" /></td></tr>
<tr><td>Download this file<a href="./images/q17/guygb.wma">here </a> !!</td></tr></table>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>


<!--Question 18-->



<?php
break;
case "18";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q18/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q18/$entry' alt='./images/q18/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 19-->



<?php
break;
case "19";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<table >
<tr><td><img src="./images/q19/akhyb.png" width="150px" /></td></tr>
<tr><td><img src="./images/q19/bkuyk.jpg" width="150px" /></td></tr>
<tr><td>Download this file<a href="./images/q19/cliyl.mp4">here </a> !!</td></tr></table>
<!--<img src="images/19/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 20-->



<?php
break;
case "20";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q20/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q20/$entry' alt='./images/q20/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/20/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 21-->



<?php
break;
case "21";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q21/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q21/$entry' alt='./images/q21/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/21/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 22-->



<?php
break;
case "22";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<table >
<tr><td><img src="./images/q22/eniln.jpg" width="150px" /></td></tr>
<tr><td>Download File 1<a href="./images/q22/flkuin.wma">here </a> !!</td></tr>
<tr><td>Download File 2<a href="./images/q22/gdxd.wma">here </a> !!</td></tr></table>
<!--<img src="images/22/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 23-->



<?php
break;
case "23";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q23/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q23/$entry' alt='./images/q23/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 24-->



<?php
break;
case "24";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q24/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q24/$entry' alt='./images/q24/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 25-->



<?php
break;
case "25";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q25/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q25/$entry' alt='./images/q25/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/25/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 26-->



<?php
break;
case "26";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q26/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q26/$entry' alt='./images/q26/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 27-->



<?php
break;
case "27";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q27/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q27/$entry' alt='./images/q27/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 16-->



<?php
break;
case "28";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q28/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q28/$entry' alt='./images/q28/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 16-->



<?php
break;
case "29";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q29/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q29/$entry' alt='./images/q29/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<!--Question 16-->



<?php
break;
case "30";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q30/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q30/$entry' alt='./images/q30/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>


<!--//end the switch case -->

<?php
break;
case "31";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<table >
<tr><td><img src="./images/q31/retgh.jpg" width="150px" /></td></tr>
<tr><td><img src="./images/q31/cdty.jpg" width="150px" /></td></tr>
<tr><td>Download File<a href="./images/q31/dfxtyghbn.mp3">here </a> !!</td></tr></table>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "32";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q32/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q32/$entry' alt='./images/q32/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "33";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q33/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q33/$entry' alt='./images/q33/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "34";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q34/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q34/$entry' alt='./images/q34/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "35";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<table >
<tr><td><img src="./images/q35/asdfghj.jpg" width="150px" /></td></tr>
<tr><td><img src="./images/q35/lkjhg.jpg" width="150px" /></td></tr>
<tr><td>Download File<a href="./images/q35/yhn.wma">here </a> !!</td></tr></table>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "36";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q36/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q36/$entry' alt='./images/q36/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "37";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<table >
<tr><td><img src="./images/q37/pkjhgf.jpg" width="150px" /></td></tr>
<tr><td><img src="./images/q37/qwertyu.jpg" width="150px" /></td></tr>
<tr><td>Download File<a href="./images/q37/xcvbn.wma">here </a> !!</td></tr></table>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "38";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q38/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q38/$entry' alt='./images/q38/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body><?php
break;
case "39";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q39/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q39/$entry' alt='./images/q39/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "40";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q40/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q40/$entry' alt='./images/q40/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "41";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>

Download <a href="./images/q41.zip">this</a> File 
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "42";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>

Download <a href="./images/q42.zip">this</a> File 
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "43";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q43/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q43/$entry' alt='./images/q43/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>
<?php
break;
case "44";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q44/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q44/$entry' alt='./images/q44/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>
<?php
break;
case "45";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q45/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q45/$entry' alt='./images/q45/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>
<?php
break;
case "46";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q46/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q46/$entry' alt='./images/q46/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>
<?php
break;
case "47";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<img src="./images/q47/qwbnxrft.jpg" width="150px"/><br/>
<img src="./images/q47/rgfhgj.jpg" width="150px"/><br/>
Download file<a href="./images/q47/shttd.wma">here</a><br/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>
<?php
break;
case "48";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<img src="./images/q48/1.png" width="150px"/><br/>
<img src="./images/q48/2.jpg" width="150px"/><br/>
Download file<a href="./images/q48/3.txt">here</a>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>
<?php
break;
case "49";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q49/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q49/$entry' alt='./images/q49/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>
<?php
break;
case "50";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q50/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q50/$entry' alt='./images/q50/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "51";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q51/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q51/$entry' alt='./images/q51/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "52";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<img src ="./images/q52/1.jpg" width="150px" ><br/>
Download file1 <a href="./images/q52/Video hint.txt">here</a><br/>
Download file2 <a href="./images/q52/Sound Hint.mp3">here</a><br/>

<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "53";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q53/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q53/$entry' alt='./images/q53/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>

<?php
break;
case "54";
?>
<?php	include('qheader.php');	?>
<?php if(isset($_GET['b'])) {if($_GET['b']) { echo "Please enter the answer"; } } ?><br/><br/></span>
<?php
						if ($handle = opendir('./images/q54/')) {
					    while (false !== ($entry = readdir($handle))) {
						echo "<table>";
						$count=0;
						if ($entry != "." && $entry != ".." && $entry != "thumbs" && $entry != "Parent Directory") {
						echo "<tr><td>&nbsp;<img src='./images/q54/$entry' alt='./images/q54/$entry'/ width='150px'></td></tr>";
					   
						}
						echo "</table>";
						}
						closedir($handle);
						}
						?>
<!--<img src="images/16/1.jpg"/>-->
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=<?php echo $q; ?>" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit  " alt="submit" class="sub"></div>
</form>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>
</body>



<?php break;
case "score";
?>
<?php	include('qheader.php');	
if($_SESSION['max']>=$max)
{  ?>
<h1>Congratulations !! You have proved yourself the " Most Qrious Guy"...</h1> <br />
<h3>--- Qrious 2013 Organizing team</h3>


<?php  }
else
{ ?>
<h1>You are still at level <?php
$row=get_max_ques($_SESSION['uid']);
 echo $_SESSION['max']; ?> :P </h1> <br />
<h3>Please do NOT try playing with urls <br /><br /> -Webmaster</h3>
<?php
}
?>
<div class="clear"></div>
</div>
</div>
<?php	include('footer2.php');	?>

<?php	break;	}	?>
<script type="text/javascript">
function hidediv(i) {
    if (document.getElementById) { // DOM3 = IE5, NS6
        document.getElementById(i).style.visibility = 'hidden';
    }
    else {
        if (document.layers) { // Netscape 4
            document.i.visibility = 'hidden';
        }
        else { // IE 4
            document.all.i.style.visibility = 'hidden'; 
        }
    }
}

function showdiv(i) {
if (document.getElementById) { // DOM3 = IE5, NS6
document.getElementById(i).style.visibility = 'visible';
}
else {
if (document.layers) { // Netscape 4
document.i.visibility = 'visible';
}
else { // IE 4
document.all.i.style.visibility = 'visible';
}
}
}
</script>


<script src="include/jquery.min.js" type="text/javascript"></script>

		<link type="text/css" href="include/scriptDemos.css" />
        <link type="text/css" href="include/codeColouring.css" />
        <link type="text/css" href="include/main.css" />
        
		<script type="text/javascript" src="include/99.js"></script>
        
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/collection.js"></script>
<script type="text/javascript">
	$(function(){
		$('#slider').loopedSlider({
			autoStart: 6000,
			restart: 5000
		});
		
	});
</script> 
</body> 
</html>