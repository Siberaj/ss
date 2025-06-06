<?php
echo "<pre>";
include("ques4.php");

//print_r($array);
foreach($array as $flight)
{
    $key[] = $flight["airline_code"];
    $exp = explode(" ",$flight["total_travel_time"]);
    $hours = strstr($exp[0],'h',true);
    $minutes = strstr($exp[1],'m',true);
    $total_time = ($hours*60)+$minutes;
    $time[] = $total_time;
}

function my_sort($a, $b) {
    if ($a == $b) return 0;
    return ($a < $b) ? -1 : 1;
  }
usort($time, "my_sort");

foreach($time as $t)
{
    $hour = floor($t/60);
    $min = floor($t%60);
    $total[] = $hour."h ".$min."m";
}
foreach($array as $flight){
    if(in_array($total[0],$flight))
    {
        echo "airline => ".$flight["airline_code"]." total_travel_time => ".$total[0];
        break;
    }
}






