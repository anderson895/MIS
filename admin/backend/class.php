<?php
include ('db.php');
date_default_timezone_set('Asia/Manila');

class global_class extends db_connect
{
    public function __construct()
    {
        $this->connect();
    }

    public function fetchUserChats($sender_id, $receiver_id) {
        $sql = "SELECT * from chat_messages as cm WHERE (cm.sender_id = ? AND cm.receiver_id = ?) 
                   OR (cm.sender_id = ? AND cm.receiver_id = ?)";
    
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("iiii", $sender_id, $receiver_id, $receiver_id, $sender_id);
        $stmt->execute();
        $result = $stmt->get_result();
    
        $messages = [];
        while ($row = $result->fetch_assoc()) {
            $messages[] = $row;
        }
    
        return $messages;
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
   
    public function send_chat($sender_id, $reciever_id, $messageinput, $fileInput, $system)
    {
        // Set status based on file input
        $status = !empty($fileInput) ? 2 : 1;

        $query = $this->conn->prepare("INSERT INTO `chat_messages` (sender_id, receiver_id, message_text, message_media, systemFrom, message_status) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($query === false) {
            return false; 
        }

        $query->bind_param("sssssi", $sender_id, $reciever_id, $messageinput, $fileInput, $system, $status);

        return $query->execute();
    }



    public function fetch_all_user(){
        $query = $this->conn->prepare("SELECT * FROM `user`");

        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    
}