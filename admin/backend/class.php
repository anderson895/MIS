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


        public function send_chat($sender_id, $reciever_id, $messageinput, $fileInput, $system)
    {
        $user = $this->check_account($sender_id);

        $status = !empty($fileInput) ? 2 : 1;

        if (!empty($user) && $user[0]['type'] === "super admin") {
            $status = 1;
        }

        // Prepare query to insert chat message
        $query = $this->conn->prepare("INSERT INTO `chat_messages` (sender_id, receiver_id, message_text, message_media, systemFrom, message_status) VALUES (?, ?, ?, ?, ?, ?)");
        
        if ($query === false) {
            return false; 
        }

        $query->bind_param("sssssi", $sender_id, $reciever_id, $messageinput, $fileInput, $system, $status);

        return $query->execute();
    }



    public function fetch_mis_user($sender_id){
        $query = $this->conn->prepare("SELECT * FROM `user` WHERE status = ? AND id != ?");
        
        $active_status = 1; // Ensure correct data type (int)
        $query->bind_param("ii", $active_status,$sender_id);
    
        if ($query->execute()) {
            $result = $query->get_result();
            return $result->fetch_all(MYSQLI_ASSOC); // Return as an associative array
        } else {
            return []; // Return an empty array if query fails
        }
    }
   
   



    public function fetch_all_user(){
        $query = $this->conn->prepare("SELECT * FROM `user` where status='1'");

        if ($query->execute()) {
            $result = $query->get_result();
            return $result;
        }
    }


    public function message_approval_list() {
        $query = $this->conn->prepare("
            SELECT chat_messages.*, 
                   sender.name AS sender, 
                   receiver.name AS receiver 
            FROM chat_messages
            LEFT JOIN user AS sender ON sender.id = chat_messages.sender_id
            LEFT JOIN user AS receiver ON receiver.id = chat_messages.receiver_id
            WHERE chat_messages.message_status = '2'
        ");
    
        if ($query->execute()) {
            return $query->get_result();
        }
    }
    
    


    public function DeleteAdmin($admin_id) {
        $query = $this->conn->prepare("UPDATE user SET status = '0' WHERE id = ?");
        $query->bind_param("i", $admin_id); 
    
        if ($query->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    


    public function DeleteChat($chat_id) {
        $query = $this->conn->prepare("UPDATE chat_messages SET message_status = '0' WHERE chat_id  = ?");
        $query->bind_param("i", $chat_id); 
    
        if ($query->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    
    public function ApproveChat($chat_id) {
        $query = $this->conn->prepare("UPDATE chat_messages SET message_status = '1' WHERE chat_id  = ?");
        $query->bind_param("i", $chat_id); 
    
        if ($query->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
    

    public function AddUser($fullname, $email, $userType,$hashed_password) {
        // Check if email already exists
        $check_query = $this->conn->prepare("SELECT id FROM user WHERE email = ?");
        $check_query->bind_param("s", $email);
        $check_query->execute();
        $check_query->store_result();
    
        if ($check_query->num_rows > 0) {
            return "email_exists";  // Return a flag indicating email already exists
        }
    
        // Insert new user if email does not exist
        $query = $this->conn->prepare("INSERT INTO user (`name`, `email`, `password`, `type`) VALUES (?, ?, ?, ?)");
        $query->bind_param("ssss", $fullname, $email, $hashed_password, $userType);
    
        if ($query->execute()) {
            return [
                'id' => $this->conn->insert_id,  // Get last inserted ID
                'fullname' => $fullname,
                'email' => $email,
                'hashed_password' => $hashed_password,
                'userType' => $userType
            ];
        } else {
            return false;  // Return false if insertion failed
        }
    }











    public function updateUser($userid, $fullname, $email, $userType, $hashed_password) {
        // Check if email already exists for another user
        $check_query = $this->conn->prepare("SELECT id FROM user WHERE email = ? AND id != ?");
        $check_query->bind_param("si", $email, $userid);
        $check_query->execute();
        $check_query->store_result();
    
        if ($check_query->num_rows > 0) {
            return "email_exists";  // Return a flag indicating email already exists
        }
    
        // Build the UPDATE query dynamically
        $query_str = "UPDATE user SET `name` = ?, `email` = ?, `type` = ?";
        $params = [$fullname, $email, $userType];
        $types = "sss";
    
        // Isama lang ang password kung may laman
        if (!empty($hashed_password)) {
            $query_str .= ", `password` = ?";
            $params[] = $hashed_password;
            $types .= "s";
        }
    
        // Tapusin ang query
        $query_str .= " WHERE id = ?";
        $params[] = $userid;
        $types .= "i";
    
        // Prepare and bind parameters
        $query = $this->conn->prepare($query_str);
        $query->bind_param($types, ...$params);
    
        if ($query->execute()) {
            return [
                'id' => $userid,
                'fullname' => $fullname,
                'email' => $email,
                'userType' => $userType,
                'hashed_password' => !empty($hashed_password) ? $hashed_password : "not_updated"
            ];
        } else {
            return false;  // Return false if update failed
        }
    }
    
    


    
}