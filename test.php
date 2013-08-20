<?php
	//$name="madametussads";
	$name=$_GET['a'];
	$name = addslashes($name);
	$name = substr($name,0,27);// have to check the max length of the answer
	$salt = '*!@#4$';
	$data=$name;
	$arr = explode(PHP_EOL, $data);  // PHP_EOL Detects end of line 
	$arr_encryt = array();
	foreach ($arr as $d){
    $d = strtolower($d);
		$d = md5($d.$salt);
		array_push($arr_encryt, $d);}
		echo $arr_encryt[0];
		
		?>