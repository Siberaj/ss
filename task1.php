<?php
echo "<pre>";
$flights = file_get_contents("flights.json");
$flights = json_decode($flights, 1);

print_r($flights[1]);

echo "total number of flights:".count($flights) . "<br>";


