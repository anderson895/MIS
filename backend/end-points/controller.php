<?php
include('../class.php');

$db = new global_class();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['requestType'])) {

        
        if ($_POST['requestType'] == 'Login') {
            $email = $_POST['email'];
            $password = $_POST['password'];
        
            // Fetch user data based on email
            $response = $db->Login($email);
        
            if ($response) {
                $hashedPassword = $response['password']; // Get stored hashed password
        
                // Verify password
                if (password_verify($password, $hashedPassword)) {
                    // Start session and store user ID
                    session_start();
                    $_SESSION['id'] = $response['id'];
        
                    echo json_encode([
                        'status' => 'success',
                        'message' => 'Login successful',
                        'data' => $response
                    ]);
                } else {
                    echo json_encode([
                        'status' => 'error',
                        'message' => 'Invalid email or password'
                    ]);
                }
            } else {
                echo json_encode([
                    'status' => 'error',
                    'message' => 'Invalid email or password'
                ]);
            }
        }
        
        













    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Access Denied! No Request Type.'
        ]);
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'GET') {
    echo json_encode([
        'status' => 'error',
        'message' => 'GET requests are not supported for login.'
    ]);
}
?>