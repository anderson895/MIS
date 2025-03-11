<?php
include ('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }


        public function Login($email)
    {
        // Prepare the SQL query to fetch user by email
        $query = $this->conn->prepare("SELECT * FROM `user` WHERE `email` = ? AND `status` = '1'");

        // Bind email parameter
        $query->bind_param("s", $email);

        // Execute the query
        if ($query->execute()) {
            $result = $query->get_result();
            if ($result->num_rows > 0) {
                return $result->fetch_assoc(); // Return user data
            }
        }

        return false;  // User not found
    }

    
}