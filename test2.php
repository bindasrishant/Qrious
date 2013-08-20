<?php
$z=$_GET['z'];
	$connection=mysql_connect("localhost","apogee_qrious","pilani");
    if(!$connection)
    die("error".mysql_error());
    $dbname='apogee_qrious12';
    mysql_select_db($dbname,$connection)or die("Error");
	
	$query= " SELECT * FROM qrious where user_id='$z' order by question_id desc; ";
		$result=mysql_query($query,$connection);
		//$res=mysql_fetch_array($result);
		?>
		<table>
		<?php
		
	while($row = mysql_fetch_array($result)) { 
	echo "<tr>";
	foreach($row as $x=>$x_value)
  {
  echo "<td>". $x_value."<td/>";
  
  }echo "<tr/>";}
	
?>
</table>