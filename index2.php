<?php	session_start();
include('functions.php');
db_connect();

$_SESSION['l1']=0;
$_SESSION['l2']=0;
$_SESSION['l3']=0;
$life1=0;
$life2=0;
$life3=0;


$max=26; //maximum number of questions

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
	
	$_POST['a'] = strtolower($_POST['a']);
	
	if( check_answer($q,$_POST['a']) )
	{//answer is correct
		if(isset($_SESSION['c'][$q]))
		{//the chances for the particular question are set			
			correct_update($_SESSION['uid'], $q, $_POST['a']);
			$_SESSION['max']++;
			$q = $_SESSION['max'] + 1;
			insert_question($_SESSION['uid'],$q);
			$_SESSION['c'][$q]=0;
			header("Location:index.php?q=".$q);
		}
		else
		{//the chances are not set
		if(insert($_SESSION['uid'], $q, $_POST['a']))
		{
			$_SESSION['max']++;
			$q = $_SESSION['max'] + 1;
			insert_question($_SESSION['uid'],$q);
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
<title>Qrious2k12 | Home</title>
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

<?php	
break;	
case "1";
?>

<?php include"qheader.php"; ?>
<?php if(isset($_GET['b'])){if($_GET['b']) { echo "Please enter the answer";  }} ?></p></span>
<table><tr><td>&nbsp;<img src="images/1/1.jpg"/></td></tr>
<tr><td>&nbsp;<img src="images/1/2.jpg"/>&nbsp;</td></tr>
<tr></tr></table>
<div class="clear"></div>

<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=1" method="post">
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
 
<table>
<tr><td><img src="images/2/1.png" height="315" width="230"/></td>
<td><img src="images/2/2.gif" height="249" width="230"/></td>
<td><img src="images/2/3.jpg" height="336" width="300"/></td></tr></table>

<div class="clear"></div>


<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=2" method="post">
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
<table>
<tr>
<td><img src="images/3/3.png" ></td>
</tr>
</table>
<div class="clear"></div>


<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=3" method="post">
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

<img src="images/4/1.jpg" align="middle" >
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=4" method="post">
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
<table><tr><td><img src="images/5/1.jpg" height="400" width="400"/></td>
<td>&nbsp;&nbsp;<img src="images/5/2.jpg" height="400" width="500"/></td></tr></table>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=5" method="post">
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
<p><table style="font-size:200px;font-weight:bold">
<tr><td><img src="images/6/1.png" width="375" height="434"/></td><td>&nbsp;</td><td><img src="images/6/2.jpg" width="273" height="333"/></td></tr>
<tr><td><img src="images/6/3.jpg" width="295" height="300"/></td><td></td>&nbsp;<td><img src="images/6/4.jpg" width="295" height="300"/><tr><td>
<tr><td align="center"><img src="images/6/5.gif" width="295" height="300"/></td>
</tr>
</table>
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=6" method="post">
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
<table>
<tr><td><img src="images/7/1.jpg" width="295" height="300"/>&nbsp;</td>
<td>&nbsp;<img src="images/7/2.jpg" width="275" height="300"/>&nbsp;</td></tr>
<tr><td>&nbsp;<img src="images/7/3.jpg" width="300" height="255"/>&nbsp;</td>
<td>&nbsp;<img src="images/7/4.jpg" width="300" height="255"/>&nbsp;</td></tr></table>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=7" method="post">
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
<img src="images/8/1.jpg" width="900" height="650">
</p>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=8" method="post">
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
<table style="font-size:200px;font-weight:bold">
<tr><td><img src="images/9/1.JPG" width="375" height="280"/></td><td>&nbsp;</td><td><img src="images/9/2.jpg" width="273" height="280"/></td></tr>
<tr><td><img src="images/9/3.jpg" width="350" height="300"/></td></tr></table>

<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=9" method="post">
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
<h4>I had a dream yesterday ..I saw a city,dark,dirty,there was ashes and smoke every where.Then I saw a woman killing her own husband.Can you guess which place I am talking about?<br /><br />And <a href="place.rar" target="_blank" style="color:#F49500;">here</a> is something for download</h4><br /><br />
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=10" method="post">
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

<img src="images/11/11.png" align='middle'/>

<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=11" method="post">
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
<img src="images/12/12.png" /><br/>

<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=12" method="post">
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

<div style="text-align:center;"><img src="images/13/1.png"/></div><br/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=13" method="post">
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
<img src="images/14/1.jpg"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=14" method="post">
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

<img src="images/15/15.png"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=15" method="post">
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

<img src="images/16/1.jpg"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=16" method="post">
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

<img src="images/17/17.png"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=17" method="post">
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
<img src="images/18/1.jpg"/>

<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=18" method="post">
<div class="eml">
<input name="a" id="email"  tabindex="1" type="text">

</div>
<div class="btn">
  <input type="submit" name="s" value="Submit" alt="submit" class="sub"></div>
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
<img src="images/19/1.jpg"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=19" method="post">
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
<h4>Click <a href="afile" target="_blank" style="color:#F49500;">here</a> to download a file</h4> <br /><br />
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=20" method="post">
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
<img src="images/21/21.png"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=21" method="post">
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
<img src="images/22/22.png"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=22" method="post">
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
<img src="images/23/23.png"/>
<h4>And <a href="playthis.mp3" target="_blank" style="color:#F49500;">here</a> is something for you</h4> <br /><br />
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=23" method="post">
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
<img src="images/24/24.png"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=24" method="post">
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
<img src="images/25/25.png"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=25" method="post">
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
<img src="images/26/26.png"/>
<div class="clear"></div>
<h3>Answer :</h3>
<form id="talk-email" action="index.php?q=26" method="post">
<div class="eml">
<input name="a" id="email" tabindex="1" type="text">

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





<?php break;
case "score";
?>
<?php	include('qheader.php');	
if($_SESSION['max']>=$max)
{  ?>
<h1>Yipee !! You have completed Qrious 2012 </h1> <br />
<h3>Click <a href="leaderboard.php" style="color:#F49500;">here</a> to see the leaderboard</h3>
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