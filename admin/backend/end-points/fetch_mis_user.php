<?php
// Set the response header to JSON
header('Content-Type: application/json');

// Include the class
include('../class.php');

$class = new global_class();
$data = $class->fetch_mis_user(); // Fetch data

// Output JSON-encoded response
echo json_encode($data);
?>
