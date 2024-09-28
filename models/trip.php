<?php
class Trip {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function addTrip($userId, $destination, $startDate, $endDate, $cost) {
        $stmt = $this->conn->prepare("INSERT INTO trip_tb (user_id, destination, start_date, end_date, cost) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([$userId, $destination, $startDate, $endDate, $cost]);
    }

    public function getTripsByUser($userId) {
        $stmt = $this->conn->prepare("SELECT * FROM trip_tb WHERE user_id = :user_id");
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();
        return $stmt;
    }

    public function getTripsByDate($userId, $startDate, $endDate) {
        $stmt = $this->conn->prepare("SELECT * FROM trip_tb WHERE user_id = :user_id AND start_date >= :start_date AND end_date <= :end_date");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':start_date', $startDate);
        $stmt->bindParam(':end_date', $endDate);
        $stmt->execute();
        return $stmt;
    }

    public function getTripsByDestination($userId, $destination) {
        $stmt = $this->conn->prepare("SELECT * FROM trip_tb WHERE user_id = :user_id AND destination LIKE :destination");
        $stmt->bindParam(':user_id', $userId);
        $destination = "%$destination%";
        $stmt->bindParam(':destination', $destination);
        $stmt->execute();
        return $stmt;
    }

    public function getTripsByCost($userId, $minCost, $maxCost) {
        $stmt = $this->conn->prepare("SELECT * FROM trip_tb WHERE user_id = :user_id AND cost BETWEEN :min_cost AND :max_cost");
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':min_cost', $minCost);
        $stmt->bindParam(':max_cost', $maxCost);
        $stmt->execute();
        return $stmt;
    }

    public function updateTrip($tripId, $destination, $startDate, $endDate, $cost) {
        $stmt = $this->conn->prepare("UPDATE trip_tb SET destination = ?, start_date = ?, end_date = ?, cost = ? WHERE trip_id = ?");
        return $stmt->execute([$destination, $startDate, $endDate, $cost, $tripId]);
    }

    public function deleteTrip($tripId) {
        $stmt = $this->conn->prepare("DELETE FROM trip_tb WHERE trip_id = ?");
        return $stmt->execute([$tripId]);
    }
}
?>
