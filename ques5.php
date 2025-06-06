<?php
    echo "<pre>";
    $flights = file_get_contents("flights.json");
    $flights = json_decode($flights, 1);
   //print_r($flights[1]);

    $result=[];
    $res1=[];
    foreach($flights as $flight)
    {
        foreach($flight["via_flights"] as $flightKey => $flightValue){
    
        if($flight["stops"]==0)
        {
            if(!in_array($flightValue["airline_name"], $result)){
                $result[] = $flightValue["airline_name"]; 
           }
        }
        else{
                if(!in_array($flightValue["airline_name"], $res1)){
                  $res1[] = $flightValue["airline_name"];
               }
        }

       }
    }

    echo "Stops: 0 - Airlines:".count($result)."<br>";
    echo "Stops: 1 - Airlines:".count($res1);


   
?>