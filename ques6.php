<?php
echo "<pre>";
$flights = file_get_contents("flights.json");
$flights = json_decode($flights, 1);

$result=[];
$flights_num=1;
foreach($flights as $key=>$value){
    foreach($value["via_flights"] as $key1=>$value1){
        if(!array_key_exists($value1["airline_code"],$result)){
            $result[$value1["airline_code"]]=array("flight".$flights_num);
            
        }else{
            array_push($result[$value1["airline_code"]],"flight".$flights_num);
        }
    }
    $flights_num++;
}
?>