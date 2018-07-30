<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");


//Creating Array for JSON response
$response = array();
 
// Include data base connect class
$filepath = realpath (dirname(__FILE__));
require_once($filepath."/db_connect.php");

 // Connecting to database 
$db = new DB_CONNECT();	
 
 // Fire SQL query to get all data from soil_moisture
$result = mysql_query("SELECT * FROM soil_moisture") or die(mysql_error());
 
// Check for successful execution of query and no results found
if (mysql_num_rows($result) > 0) {
    
	// Storing the returned array in response
    $response["soil_moisture"] = array();
 
	// While loop to store all the returned response in variable
    while ($row = mysql_fetch_array($result)) {

        // temporary user array
        $soil_moisture = array();
        $soil_moisture["id"] = $row["id"];
		$soil_moisture["soil_measurement"] = $row["soil_measurement"];

		// Push all the items 
        array_push($response["soil_moisture"], $soil_moisture);
    }
    // On success
    $response["success"] = 1;
 
    // Show JSON response
    echo json_encode($response);
}	
else 
{
    // If no data is found
	$response["success"] = 0;
    $response["message"] = "No soil moisture data found";
 
    // Show JSON response
    echo json_encode($response);
}
?>