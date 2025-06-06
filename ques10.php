<?php
echo "<pre>";
include("ques4.php");

//print_r($array);
$fare = array_column($array,"total_fare");

function my_sort($a, $b) {
    if ($a == $b) 
    return 0;
    return ($a < $b) ? -1 : 1;
  }
usort($fare, "my_sort");
foreach($array as $flight){
if(in_array($fare[0],$flight))
{
    echo "airline => ".$flight["airline_code"]." total_fare => ".$fare[0];
    break;
}
}

