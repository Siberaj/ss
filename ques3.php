<?php
echo "<pre>";
$flights = file_get_contents("flights.json");
$flights = json_decode($flights, 1);

$final1 = array();
$final2 = array();
foreach($flights as $flight)
{
    $count = 0;
    foreach($flight["via_flights"] as $flightKey => $flightValue){
        $count++;
    }
    //echo $count."<br>";
    if($count==1)
    {
        array_push($final1, $flight);
    }
    else{
        array_push($final2, $flight);
    } 

}
$final = array();
array_push($final, $final1);
array_push($final, $final2);

print_r($final);