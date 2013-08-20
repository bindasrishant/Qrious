<?php
function db_connect()	{
	$con = mysql_connect("localhost","apogee_qrious","pilani");
	mysql_select_db("apogee_qrious12");
}


function db_connect_qrious() 	{
$connection=mysql_connect("localhost","apogee_qrious","pilani");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_qrious12';
    mysql_select_db($dbname,$connection)or die("Error");
	}

function get_max_ques($user_id)
{
db_connect();
	$query = sprintf("SELECT * FROM qrious WHERE user_id = '%s' ORDER by question_id DESC LIMIT 1", mysql_real_escape_string($user_id));
	$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	$row = mysql_fetch_array($result);
	$_SESSION['question_id']=$row['question_id'];
	return $row;
}


function insert($user_id, $ques_id, $ans)
{
db_connect();
	$query = sprintf("INSERT into qrious set user_id = '%s', question_id = '%s', answered_at = NOW() ",mysql_real_escape_string($user_id),
																				                mysql_real_escape_string($ques_id));
	$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	return true;
}


function insert_question($user_id,$ques_id)
{
db_connect();
	$query=sprintf("INSERT into qrious set user_id='%s',question_id='%s'",mysql_real_escape_string($user_id),mysql_real_escape_string($ques_id));
	$result=mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
}


function correct_update($user_id, $ques_id, $ans)
{
db_connect();
	$query = sprintf("UPDATE qrious set answered_at = NOW() WHERE user_id = '%s' AND question_id = '%s'",
																		  mysql_real_escape_string($user_id),
																		  mysql_real_escape_string($ques_id));
	$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	return true;
}


function wrong_update($user_id, $ques_id, $chances)
{
db_connect();
	$query = sprintf("UPDATE qrious set  chances = '%s' WHERE user_id = '%s' AND question_id = '%s'", mysql_real_escape_string($chances),
																								   mysql_real_escape_string($user_id),
																								   mysql_real_escape_string($ques_id));
	$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	return true;
}


function wrong($user_id, $ques_id)
{
db_connect();
	$query = sprintf("INSERT into qrious set user_id = '%s', question_id = '%s', chances = '1'",  mysql_real_escape_string($user_id),
																								  mysql_real_escape_string($ques_id));
	$result = mysql_query($query);
	if(!$result)	{	echo mysql_error();	}
	return true;
}


function check_answer($q,$ans)	{
										if( ($q == "1" && $ans == "b2c3736aca0ac24a37908da0384d6759") ||
											($q == "2" && $ans == "58bd2c13b9a728e23905f1a1f7a51ede") || 
										   ($q == "3" && $ans == "72f884c33844bc8b349881dfd8ac583a") ||
										   ($q == "4" && $ans == "d1387c3147fa69a6f97c8f9b0f830fd6") ||
										   ($q == "5" && $ans == "b98f7b3bf339e51c10c631af1b579bea" ) ||
										   ($q == "6" && $ans == "ccbd4257ce433cff8515cac779f3e19e") ||
										   ($q == "7" && $ans == "a6c6c1754ba0bb1d1e6aa987f6c713f8") ||
										   ($q == "8" && ($ans == "27774a992a0e7b73df749906127d0968" || $ans == "146f83cdcdc3963c585040d560c00f72" ))  ||
										   ($q == "9" && $ans == "9674464f6545ba6e56bed4cf0fdd90eb") ||
										   ($q == "10" && ($ans == "96ea5b3aaec879005b7a931f2b35f33d" )) ||
										   ($q == "11" && ($ans == "40a4ef3d405e721462c75c93f7f293cf" )) ||
										   ($q == "12" && $ans == "e9bc8b14158bc33ff950ac2c7d586a54") ||
										   ($q == "13" && ($ans == "66574fbe51cf5786b0ca745d9e5d5e39" || $ans="9438c14039409390a60a916a66f424b6")) ||
										   ($q == "14" && $ans == "69f884c2f64ca46656298e643846b254") ||
										   ($q == "15" && $ans == "8ee9cddf7e91804c4af3702e01621046") ||
										   ($q == "16" && $ans == "ad08ee4d3092231cc0e251554ad29a10") ||
										   
										
										   ($q == "17" && $ans == "aea1ef014f9d62e4a751820c2323d841") ||
										   ($q == "18" && $ans == "ae0f34eedc3ea2c76610a68305d042c2") ||
										   ($q == "19" && $ans == "d4f78ee2f8d95efac4e484def62d918b") ||
										   ($q == "20" && ($ans == "82efecd41cff7278548bfad1086e3d35" || $ans=="82efecd41cff7278548bfad1086e3d35")) ||
										   ($q == "21" && $ans == "add65d608bdccc3e540c9691e5025782") ||
										   ($q == "22" && ($ans == "65bd1b00a8478169b739c259fb192562" )) || 
										   ($q == "23" && $ans == "1bf7eeef15293dc1a21ea282b98362c0") ||
										   ($q == "24" && ($ans == "a9348d5cb2a7692eafca98838a9bf7d2" || $ans == "a9348d5cb2a7692eafca98838a9bf7d2")) ||
										   ($q == "25" && ($ans == "0f46abbe5a6dab4ce39a29a652fe2af1" )) ||
										   ($q == "26" && $ans == "f1d5ef0ff2737291fd358f645aeb4b73") ||
										   ($q == "27" && $ans == "8693795f3a819673007e1a3495d2878c") ||
										   ($q == "28" && $ans == "a0e25e51a3f9909e0857aff030f9600e") ||
										   ($q == "29" && $ans == "d12f8f86657505512d1814fc5d9ebbad") ||
										   ($q == "30" && $ans == "0cbd6f455b4958bd2d15927232f2d308") ||
										   ($q == "31" && $ans == "e629433ce88191ef8df44c87da5adfe9") ||
										   ($q == "32" && $ans == "40314b015d0f8781ed685db17a3f9126") ||
										   ($q == "33" && $ans == "30b6021421616932c3decc66e9f0f45a") ||
										   ($q == "34" && $ans == "bb492ff96a18d16e62a3c39147c01373") ||
											($q == "35" && $ans == "d1283b77b4aa4436dd516193ada190a5") ||
											($q == "36" && $ans == "72521bf060d608aa744d394ab1a7a1cf") ||
											($q == "37" && $ans == "f3ed5feb17af38ef4ed9e93ce12621ce") ||
											($q == "38" && $ans == "ba168b21960c8b7bfb01b08b783e9803") ||
											($q == "39" && $ans == "333b71835e44bd73df22912031190e37") ||
											($q == "40" && $ans == "3e549cb44cbc2b2a324e6e60244c311a") ||
											($q == "41" && $ans == "3a6af35411398dc1356e744de2c2945a") ||
											($q == "42" && $ans == "71685adfc717c71827b210b1fcc1f729") ||
											($q == "43" && $ans == "e726e0099e0f51b0b484074c5e3ee7a6") ||
											($q == "44" && $ans == "2c66a2303840c3b07873dc44459c6bcc") ||
											($q == "45" && $ans == "9f7ef2f21d27eb09f299bcf094e3e27f") ||
											($q == "46" && $ans == "26081dc25d19d3e000749c045fb44f93") ||
											($q == "47" && $ans == "3e584af90c2c263ff305f3fbcf76ca00") ||
											($q == "48" && $ans == "1f61508326e7063f293677af9e01a482") ||
											($q == "49" && $ans == "4ee1fd928684e3661441775d0daf2749") ||
											($q == "50" && $ans == "cce6f8587b79de7ed67eb30bb6b7da53") ||
											($q == "51" && $ans == "8b20a7108545ef9ac62077333c0c235c") ||
											($q == "52" && $ans == "2f206bbc7cd2555d6e756c73c429e012") ||
											($q == "53" && (($ans == "884d378f7bf3b0c6394aea9843002a00")||($ans == "e67076406fc31b74d4b2b3532507893b"))) ||
											($q == "54" && $ans == "ac911efbdef413c82f7ee8874f135c42") 
											)
	{
		return true;
	}
	else	{	return false;	}
}
function check_swap_answer($q,$ans)	{
	if( ($q == "1" && $ans == "forrestgump") || ($q == "2" && $ans == "asana") || 
										   ($q == "3" && $ans == "cuttherope"))
										   
	{
		return true;
	}
	else	{	return false;	}
}

function check_lifeline($life, $uid)// returns 0 if lifeline is used....
{			db_connect_qrious();
			$query= "select life1, life2 ,life3 from qrious WHERE user_id= '$uid'" ;
			$result=mysql_query($query);
			//echo $result['life1'];
			$row=mysql_fetch_array($result);
			if($row['life1']==TRUE) {return 0;}
			else return 1;
	}
function check_swap($uid,$swp)//returns 1 if swap is set
{	
	//fetch question_id
//$q=get_max_ques($uid);
	//fetch swap
	$query="select * from qrious where user_id='$uid'";
	$sw=mysql_query($query);
	$swa=mysql_fetch_array($sw);
	$index="swap".$swp;
	$swap=$swa[$index];
	if($swap==0)	return 1; //returns 1 if swap is already used
	else return 0;
	}
function chk_swp_ques($user,$swp) //returns 0 if not equal
{	//$que=get_max_ques($user);
	$q=$_SESSION['max']+1;
	//fetch swap
	$query=sprintf("select swap%s from qrious where user_id='%s'",$swp,$user);
	
	$sw=mysql_query($query);
	$swa=mysql_fetch_array($sw);
	$index="swap".$swp;
	$swap=$swa[$index];
	if($swap==$q) return 1;
	return 0;
	}
function swap_range($q)
{	if($q>=1 && q<11) return 1;
	else if ($q>10 && $q<21) return 2;
	else return 3;
}
