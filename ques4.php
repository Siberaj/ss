<?php
    echo "<pre>";
   $flights = file_get_contents("flights.json");
   $flights = json_decode($flights, 1);
   $array=[];
   
   foreach($flights as $flight)
   {
      $airline_code[] = array_column($flight["via_flights"],"airline_code");
     
   }

   $source= array_column($flights,"origin_airport_code"); 
   $destination_on= array_column($flights,"dest_airport_code");
   $departure_date= array_column($flights,"date_departure");
   $departure_time= array_column($flights,"time_departure");
   $arrival_time= array_column($flights,"time_arrival");
   $stops= array_column($flights,"stops");
   $base_fare= array_column($flights,"base_fare");
   $tax= array_column($flights,"tax");
   $discount= array_column($flights,"discount");
   $n=count($flights);

   for($i=0;$i<$n;$i++){
      $total_departure= strtotime($departure_time[$i])-strtotime("00:00:00");
      $total_arrival= strtotime($arrival_time[$i])-strtotime("00:00:00");
      $total_time_sec= ltrim(($total_arrival-$total_departure),"-");
      $total_minutes= ($total_time_sec/(60));
      $total_hour= floor($total_minutes/(60));
      $rest_minutes= $total_minutes-(($total_hour)*60);
      $total_fare= $base_fare[$i]+$tax[$i];
      $stop= ($stops[$i] == 1) ?(($stops[$i] == 2)? "2 Stop" : "1 Stop"):"Non-stop";
      array_push($array,array("source"=>"{$source[$i]}","destination"=>"{$destination_on[$i]}",
                  "departure_time"=>"{$departure_date[$i]} {$departure_time[$i]}",
                  "arrival_time"=>"{$departure_date[$i]} {$arrival_time[$i]}",
                  "total_travel_time"=>"{$total_hour}h {$rest_minutes}m",
                  "airline_code"=>"{$airline_code[$i][0]}",
                  "stops"=>"{$stop}",
                  "no_of_stops"=>"{$stops[$i]}",
                  "total_fare"=>"{$total_fare}")
               );
   }
  //print_r($array);
?>