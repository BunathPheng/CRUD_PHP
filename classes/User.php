<?php
class User {
    private $conn;
    private $table_name = 'users';

    public $id;
    public $name;
    public $email;
    public $phone;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Create User
    public function create() {
        $query = "INSERT INTO " . $this->table_name . " 
                  SET name = ?, email = ?, phone = ?";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        
        // Bind values
        $stmt->bind_param("sss", $this->name, $this->email, $this->phone);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    // Read Users
    public function read() {
        $query = "SELECT * FROM " . $this->table_name;
        $result = $this->conn->query($query);
        return $result;
    }

    // Get Single User
    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $this->id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        return $result;
    }

    // Update User
    public function update() {
        $query = "UPDATE " . $this->table_name . "
                  SET name = ?, email = ?, phone = ?
                  WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize
        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->phone = htmlspecialchars(strip_tags($this->phone));
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Bind values
        $stmt->bind_param("sssi", $this->name, $this->email, $this->phone, $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }

    // Delete User
    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        
        $stmt = $this->conn->prepare($query);
        
        // Sanitize
        $this->id = htmlspecialchars(strip_tags($this->id));
        
        // Bind id of record to delete
        $stmt->bind_param("i", $this->id);
        
        if($stmt->execute()) {
            return true;
        }
        
        return false;
    }
}
?>