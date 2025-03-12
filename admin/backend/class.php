<?php
include ('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }


    public function check_account($user_id ) {
        $query = "SELECT * FROM user WHERE id = $user_id";
        $result = $this->conn->query($query);

        $items = [];
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $items[] = $row;
            }
        }
        return $items; 
    }


    public function fetch_mis_user() {
        $query = $this->conn->prepare("SELECT * FROM `user` WHERE status = ?");
        
        $active_status = 1; // Ensure correct data type (int)
        $query->bind_param("i", $active_status);
    
        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC); // Return as an associative array
        } else {
            return []; // Return an empty array if query fails
        }
    }
    


    
}