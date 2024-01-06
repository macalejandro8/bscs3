<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "dbms";

// Create a connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$symptoms = $_POST['symptoms'];
$travel = $_POST['travel'];
$contact = $_POST['contact'];

// Insert form data into the database
$sql = "INSERT INTO declaration_form (name, email, phone, symptoms, travel, contact) VALUES ('$name', '$email', '$phone', '$symptoms', '$travel', '$contact')";

if ($conn->query($sql) === TRUE) {
    echo "Form submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>


