<?php
// Database configuration
$dbHost = 'localhost:3308';
$dbUsername = 'root';
$dbPassword = 'asdf1234';
$dbName = 'mydatabase';

// Create database connection
$conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

$id = $_POST['partID'];
$partName = $_POST['partName'];
$partType = $_POST['partType'];

// Update the database with the new data (you'll need to implement your own logic for this)
$sql = "UPDATE computerparts SET PartName='$partName', PartType='$partType' WHERE ID='$id'";
if ($conn->query($sql) === TRUE) {
	echo '<script>alert("Successfully updated computer part!")</script>';
} else {
	echo '<script>alert("Something went wrong with the update. Please contact administrator.")</script>';
}

$conn->close();
// Redirect back to the index page
// delay a little bit to display the alert pop up
header("Refresh:0.5; url=/htdocs", true, 303);
exit;
?>