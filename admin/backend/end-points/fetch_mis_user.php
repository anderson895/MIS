<?php
// Set the response header to JSON
header('Content-Type: application/json');

// Include the class
include('../class.php');


session_start();
$sender_id = $_SESSION['id'];
$class = new global_class();
$data = $class->fetch_mis_user($sender_id); // Fetch data

// Output JSON-encoded response
echo json_encode($data);
?>
