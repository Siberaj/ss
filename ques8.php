<?php
echo "<pre>";
$flights = file_get_contents("flights.json");
$flights = json_decode($flights, 1);
date_default_timezone_set("UTC");

//print_r($flights[10]);
$input = "840";
$layovertime = "";
foreach($flights as $flight)
{
    if($flight["stops"]==1){
    foreach($flight["via_flights"] as $flightKey => $flightValue){
        if(in_array($input, $flightValue))
        {   
           $layovertime = $flightValue["layover_time"]; 
        }         
    }
  }
}
echo "Flight: ".$input."<br>";
echo "stop 1 :Layover time: ". $layovertime."<br>";
?>