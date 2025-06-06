<?php
$data = '[{"origin_airport_code":"MAA","dest_airport_code":"DEL","origin_airport_name":"Chennai","dest_airport_name":"New Delhi","adult":1,"child":0,"infant":0,"date_departure":"2024-11-23","time_departure":"16:10","time_arrival":"08:35","base_fare":7832,"tax":1452,"discount":0,"cancellation_fee":"","seats":"9","trip_type":"O","stops":1,"return_stops":0,"currency_type":"INR","via_flights":[{"origin_airport_code":"MAA","dest_airport_code":"HYD","origin_airport_name":"Chennai","dest_airport_name":"Hyderabad","origin_airport_details":{"airport_name":"Chennai International Airport","city_name":"Chennai","airport_code":"MAA","country_code":"IN","country_name":"India","time_zone":"Asia/Kolkata","offset":"+05:30"},"dest_airport_details":{"airport_name":"Rajiv Gandhi International Airport","city_name":"Hyderabad","airport_code":"HYD","country_code":"IN","country_name":"India","time_zone":"Asia/Kolkata","offset":"+05:30"},"departure_terminal":"4","arrival_terminal":"","departure_date":"2024-11-23","arrival_date":"2024-11-23","time_departure":"16:10","time_arrival":"17:35","meal_code":"","mealAvailable":"","cabin_class":"E","trip_type":"O","flight_number":"545","airline_code":"AI","airline_name":"Air India","operating_airline_code":"AI","operating_airline_name":"","operating_flight_number":"","faretypename":"Non-Refundable","faretype_code":"NR","baggage_allowance":{"HB":{"ADT":{"Weight":"7","Unit":"KG"}},"CB":{"ADT":{"Weight":"15","Unit":"KG"}}},"hopping_flight":[],"fare_basic_code":{"adult":"TU1YXSII"},"productClass":"T","fareFamilyCode":"Published fares"},{"origin_airport_code":"HYD","dest_airport_code":"DEL","origin_airport_name":"Hyderabad","dest_airport_name":"New Delhi","origin_airport_details":{"airport_name":"Rajiv Gandhi International Airport","city_name":"Hyderabad","airport_code":"HYD","country_code":"IN","country_name":"India","time_zone":"Asia/Kolkata","offset":"+05:30"},"dest_airport_details":{"airport_name":"Indira Gandhi International Airport","city_name":"New Delhi","airport_code":"DEL","country_code":"IN","country_name":"India","time_zone":"Asia/Kolkata","offset":"+05:30"},"departure_terminal":"","arrival_terminal":"3","departure_date":"2024-11-24","arrival_date":"2024-11-24","time_departure":"06:15","time_arrival":"08:35","meal_code":"","mealAvailable":"","cabin_class":"E","trip_type":"O","flight_number":"559","airline_code":"AI","airline_name":"Air India","operating_airline_code":"AI","operating_airline_name":"","operating_flight_number":"","faretypename":"Non-Refundable","faretype_code":"NR","baggage_allowance":{"HB":{"ADT":{"Weight":"7","Unit":"KG"}},"CB":{"ADT":{"Weight":"15","Unit":"KG"}}},"hopping_flight":[],"fare_basic_code":{"adult":"TU1YXSII"},"productClass":"T","fareFamilyCode":"Published fares"}],"branded_fare_info":{"fare_family_code":"RP","brand_name":"Published fares","checkIn_baggage":"NA","cabin_baggage":"NA","refunds":"NA","seat":"NA","enrich_miles":"NA","upgrade_with_miles":"NA","meal":"NA","child_discount":"NA","exchange":"NA","go_show":"NA","lounge":"NA","priority_checking":"NA","priority_boarding":"NA","priority_baggage":"NA","travel_insurance":"NA"},"fareFamilyCode":"Published fares","serviceAgent":{"agencyCode":"352","airlineCode":"AI","accountType":true,"pcc":"","reservationCode":"AMADEUS","subAgencyName":"Amadeus test supplier"},"RT_Fare":true,"passenger_fare":[{"passenger_type":"ADT","base_fare":7832,"tax":1452,"old_base_fare":0,"old_tax":0,"discount":0,"taxBreakUpDetails":[{"taxCode":"YR","taxAmount":340,"taxDescription":"Carrier Misc Fee"},{"taxCode":"IN","taxAmount":467,"taxDescription":"User Development Fee"},{"taxCode":"K3","taxAmount":409,"taxDescription":null},{"taxCode":"P2","taxAmount":236,"taxDescription":null}]}]}]';
date_default_timezone_set("UTC");
$flights = json_decode($data, true);
print_r($flights);
foreach($flights as $flight)
{
    foreach($flight["via_flights"] as $flightKey => $flightValue)
    {
        $d_date = $flightValue["departure_date"]." ".$flightValue["time_departure"];
        $a_date = $flightValue["arrival_date"]." ".$flightValue["time_arrival"];
        $dept_date[] = strtotime($d_date);
        $arr_date[] = strtotime($a_date);
    }
}
$layover_time = 0;
$total_travel_time = 0;
foreach($dept_date as $key => $value)
{
    if($key > 0)
    {
        $layover_time += ($dept_date[$key] - $arr_date[$key-1]);
    }
    $time = $arr_date[$key] - $dept_date[$key];
    $total_travel_time += $time;
    $travel_time[] = date("H \h i \m",$time);
}

echo "Layover time: ".date("h \h i \m", $layover_time)."<br>";
echo "Travel time: ";
print_r($travel_time);
echo "<br>";
echo "Total travel time: ".date("h \h i \m", $total_travel_time)."<br>";