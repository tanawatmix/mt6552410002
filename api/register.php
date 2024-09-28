<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json; charset=UTF-8");

require_once "./../connec.php";
require_once "./../models/MyProfile.php";

$connDB = new ConnectDB();
$myProfile = new MyProfile($connDB->getConnectionDB());

$data = json_decode(file_get_contents("php://input"));

$username = $data->username;
$password = $data->password;
$email = $data->email;

$userId = $myProfile->register($username, $password, $email);

if ($userId) {
    echo json_encode(array("status" => "success", "user_id" => $userId));
} else {
    echo json_encode(array("status" => "error", "message" => "การลงทะเบียนล้มเหลว"));
}
?>
