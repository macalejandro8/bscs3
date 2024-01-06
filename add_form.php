<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $symptoms = $_POST["symptoms"];
    $travel = $_POST["travel"];
    $contact = $_POST["contact"];
    $user_otp = $_POST["otp"];

    // Check if the submitted OTP matches the one generated and stored in the session
    if (isset($_SESSION['generated_otp']) && $user_otp == $_SESSION['generated_otp']) {
        // OTP verification successful, proceed to insert data into the database
        $sql = "INSERT INTO declarations (name, email, phone, symptoms, travel, contact) 
                VALUES ('$name', '$email', '$phone', '$symptoms', '$travel', '$contact')";

        if ($conn->query($sql) === TRUE) {
            echo "Record added successfully.";
        } else {
            echo "Error adding record: " . $conn->error;
        }
    } else {
        echo "OTP verification failed. Please try again.";
    }

    // Clear the generated OTP from the session to prevent reuse
    unset($_SESSION['generated_otp']);
}

$conn->close();
?>
