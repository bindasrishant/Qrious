<?php
$lat="-33.8670522";
$lot="-33.8670522";
$type="pharmacy";
$q="https://maps.googleapis.com/maps/api/place/nearbysearch/json?location=$lat,$lot&radius&rankby=distance&types=$type&sensor=false&key=AIzaSyBaKqwwBfl0OXANVPlx_3CABJIE61RpOZs";


$json = file_get_contents($q); 

$details = json_decode($json, TRUE); 

echo "<pre>"; print_r($details); echo "</pre>"; 
?>