<?php
class ConnectDB {
    private $host = "localhost"; 
    private $username = "root"; 
    private $password = ""; 
    private $dbname = "sautrip_db"; 
    private $connDB;

    public function getConnectionDB() {
        $this->connDB = null;
        try {
            $this->connDB = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->connDB->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "เกิดข้อผิดพลาดในการเชื่อมต่อ: " . $exception->getMessage();
        }
        return $this->connDB;
    }
}
?>
