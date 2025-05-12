<?php
class Database {
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'user_management';
    public $conn;

    public function __construct() {
        // Create connection without specifying database first
        $this->conn = new mysqli($this->host, $this->username, $this->password);

        // Check connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }

        // Create database if not exists
        $sql = "CREATE DATABASE IF NOT EXISTS " . $this->database;
        if ($this->conn->query($sql) === TRUE) {
            // Select the database
            $this->conn->select_db($this->database);

            // Create users table if not exists
            $create_table_sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(11) AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL UNIQUE,
                phone VARCHAR(20) NOT NULL
            )";
            
            if ($this->conn->query($create_table_sql) !== TRUE) {
                die("Error creating table: " . $this->conn->error);
            }
        } else {
            die("Error creating database: " . $this->conn->error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>