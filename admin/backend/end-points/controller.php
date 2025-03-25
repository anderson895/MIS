<?php
include('../class.php');

$db = new global_class();

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['requestType'])) {
        if ($_POST['requestType'] == 'send_chat') {
            

            if (isset($_FILES['file-input']) && $_FILES['file-input']['error'] == 0) {
                $uploadedFile = $_FILES['file-input'];
                $uploadDir = '../../../assets/upload_files/';
                
                // Get the original file extension
                $fileExtension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);
                
                // Generate a unique file name using a timestamp and a random unique ID
                $uniqueFileName = uniqid('file_', true) . '.' . $fileExtension;
                $uploadFilePath = $uploadDir . $uniqueFileName;
            
                // Ensure the directory exists
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }
            
                // Move the uploaded file to the target directory
                if (move_uploaded_file($uploadedFile['tmp_name'], $uploadFilePath)) {
                    $fileInput = $uniqueFileName; // Store the unique file name
                } else {
                    $fileInput = null; // File upload failed
                }
            } else {
                $fileInput = null; // No file uploaded
            }
            
            // Collect other form data
            $sender_id = $_POST['sender_id'];
            $reciever_id = $_POST['reciever_id'];
            $messageinput = $_POST['message-input'];
            $systemFrom = $_POST['systemFrom'];
            $systemTo = $_POST['systemTo'];
            
            
            // Insert the car record into the database
            $user = $db->send_chat($sender_id,$reciever_id, $messageinput, $fileInput,$systemFrom,$systemTo);
            
            if ($user) {
                echo "success";
            } else {
                echo "Error Messages .";
            }
        }else if ($_POST['requestType'] == 'AddUser') {

           

            $uploadDir = "../../../assets/upload_files/";

            function generateUniqueFilename($file) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                return uniqid() . '.' . $ext;
            }

            function handleFileUpload($file, $uploadDir) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                $maxFileSize = 10 * 1024 * 1024; // 10MB
            
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    return null;
                }
            
                // Ensure the temp file exists before checking MIME type
                if (!file_exists($file['tmp_name'])) {
                    return null;
                }
            
                if (!in_array(mime_content_type($file['tmp_name']), $allowedTypes)) {
                    return null;
                }
            
                if ($file['size'] > $maxFileSize) {
                    return null;
                }
            
                $fileName = generateUniqueFilename($file);
                $destination = $uploadDir . $fileName;
            
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $fileName;
                }
                return null;
            }
        

            $userPhoto = $_FILES['upload_profile'] ?? null;

            $userPhotoName = $userPhoto ? handleFileUpload($userPhoto, $uploadDir) : null;


            $fullname = $_POST['fullname'];
            $username = $_POST['username'];
            
            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $password = $_POST['password'];
            $userType = $_POST['userType'];
          
           $hashed_password = password_hash($password, PASSWORD_DEFAULT);



            // Call the method
            $user = $db->AddUser($fullname, $username,$email,$phone, $userType,$userPhotoName,$hashed_password);

            if ($user === "username_exists") {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'username already exists!'
                ]);
            } elseif ($user) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'User added successfully!',
                    'data' => $user
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'User addition failed!'
                ]);
            }

            
        }else if ($_POST['requestType'] == 'updateUser') {


            $uploadDir = "../../../assets/upload_files/";

            function generateUniqueFilename($file) {
                $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
                return uniqid() . '.' . $ext;
            }

            function handleFileUpload($file, $uploadDir) {
                $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                $maxFileSize = 10 * 1024 * 1024; // 10MB
            
                if ($file['error'] !== UPLOAD_ERR_OK) {
                    return null;
                }
            
                // Ensure the temp file exists before checking MIME type
                if (!file_exists($file['tmp_name'])) {
                    return null;
                }
            
                if (!in_array(mime_content_type($file['tmp_name']), $allowedTypes)) {
                    return null;
                }
            
                if ($file['size'] > $maxFileSize) {
                    return null;
                }
            
                $fileName = generateUniqueFilename($file);
                $destination = $uploadDir . $fileName;
            
                if (move_uploaded_file($file['tmp_name'], $destination)) {
                    return $fileName;
                }
                return null;
            }
        

            $userPhoto = $_FILES['upload_profile'] ?? null;

            $userPhotoName = $userPhoto ? handleFileUpload($userPhoto, $uploadDir) : null;







            $userid = $_POST['userid'];
            $fullname = $_POST['fullname'];
            $username = $_POST['username'];

            $email = $_POST['email'];
            $phone = $_POST['phone'];

            $password = $_POST['password'];
            $userType = $_POST['userType'];
            
            // Check if password is empty
            if (!empty($password)) {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            } else {
                $hashed_password = ""; // Set as empty string
            }
            
            // Call the method
            $user = $db->updateUser($userid,$userPhotoName, $fullname, $username,$email,$phone, $userType, $hashed_password);
            
            if ($user === "username_exists") {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Username already exists!'
                ]);
            } elseif ($user) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'User updated successfully!',
                    'data' => $user
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'User update failed!'
                ]);
            }
            

            
        }else if ($_POST['requestType'] === "DeleteAdmin") {
            $admin_id = $_POST['admin_id'];
    
            if ($db->DeleteAdmin($admin_id)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Admin deleted successfully!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete admin. Please try again!'
                ]);
            }
        }else if ($_POST['requestType'] === "DeleteChat") {
            $chat_id = $_POST['chat_id'];
    
            if ($db->DeleteChat($chat_id)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Chat deleted successfully!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete admin. Please try again!'
                ]);
            }
        }else if ($_POST['requestType'] === "ApproveChat") {
            $chat_id = $_POST['chat_id'];
    
            if ($db->ApproveChat($chat_id)) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Chat deleted successfully!'
                ]);
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Failed to delete admin. Please try again!'
                ]);
            }
        } else {
            echo 'requestType NOT FOUND';
        }
        
    } else {
        echo 'Access Denied! No Request Type.';
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
}
?>