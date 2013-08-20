<?php

	$connection=mysql_connect("localhost","apogee_apogee","n0tebo0|<");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_2013';
    mysql_select_db($dbname,$connection)or die("Error");
	
	$query= " select * from auth_user ";
		$result=mysql_query($query,$connection);
		//$res=mysql_fetch_array($result);
	while($row = mysql_fetch_array($result)) { foreach($row as $x=>$x_value)
  {
  echo " ". $x_value;
  
  }echo "<br>";}
	
?>