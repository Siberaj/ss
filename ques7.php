<?php
echo "<pre>";
$flights = file_get_contents("flights.json");
$flights = json_decode($flights, 1);

//print_r($flights[9]);

date_default_timezone_set("UTC");
$i=0;
foreach($flights as $flight)
{
    foreach($flight["via_flights"] as $flightKey => $flightValue){
        if($flight["stops"]==0)
        {
            break;
        }
        else
        {
            $d_date = $flightValue["departure_date"]." ".$flightValue["time_departure"];
            $a_date = $flightValue["arrival_date"]." ".$flightValue["time_arrival"];
            $dept_date[] = strtotime($d_date);
            $arr_date[] = strtotime($a_date);
            
            $layover_time = 0;
            if($flightKey > 0){
            foreach($dept_date as $key => $value)
            {
                if($key > 0)
                {
                    $layover_time += ($dept_date[$key] - $arr_date[$key-1]);
                    $result[$i++][$flightValue["airline_code"]] = date("h \H i \m",strtotime($layover_time));
                }
                
            }
        }
        }
    }
    unset($dept_date);
    unset($arr_date);
}

print_r($result);