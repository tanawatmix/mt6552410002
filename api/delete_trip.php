<?php 
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "./../connec.php";
require_once "./../models/Trip.php";

$connDB = new ConnectDB();
$trip = new Trip($connDB->getConnectionDB());

$data = json_decode(file_get_contents("php://input"));
$tripId = $data->trip_id;

$result = $trip->deleteTrip($tripId);

if ($result) {
    echo json_encode(array("status" => "success", "message" => "การเดินทางถูกลบแล้ว"));
} else {
    echo json_encode(array("status" => "error", "message" => "การลบการเดินทางล้มเหลว"));
}
?>
