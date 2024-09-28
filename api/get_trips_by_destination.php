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
$userId = $data->user_id;
$destination = $data->destination;

$result = $trip->getTripsByDestination($userId, $destination);

if ($result->rowCount() > 0) {
    $trips = $result->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode(array("status" => "success", "trips" => $trips));
} else {
    echo json_encode(array("status" => "error", "message" => "ไม่พบข้อมูลการเดินทางที่ไปยังปลายทางที่ระบุ"));
}
?>
