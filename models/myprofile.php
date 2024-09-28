<?php
class MyProfile {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($username, $password, $email) {
        $stmt = $this->conn->prepare("INSERT INTO myprofile_tb (username, password, email) VALUES (?, ?, ?)");
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt->execute([$username, $hashedPassword, $email]);
        return $this->conn->lastInsertId();
    }

    public function login($username, $password) {
        $stmt = $this->conn->prepare("SELECT * FROM myprofile_tb WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                return $user; 
            }
        }
        return null; 
    }
}
?>
