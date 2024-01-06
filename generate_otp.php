<?php
session_start();

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve data from the POST request
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate and sanitize data
    $name = filter_var($data['name'], FILTER_SANITIZE_STRING);
    $email = filter_var($data['email'], FILTER_SANITIZE_EMAIL);
    $phone = filter_var($data['phone'], FILTER_SANITIZE_STRING);

    // Generate a random 6-digit OTP
    $otp = rand(100000, 999999);

    // Simulate sending the OTP (you need to implement actual sending via SMS or email)
    // For demonstration purposes, we'll store the OTP in the session
    $_SESSION['generated_otp'] = $otp;

    // You should send the OTP to the user via SMS or email here
    // Replace the following line with actual code to send OTP via SMS or email

    // Dummy function to simulate sending SMS (replace with actual SMS sending code)
    function sendOTPviaSMS($phone, $otp) {
        // Replace this with your actual SMS sending code
        echo "Simulating sending OTP $otp to $phone via SMS...";
    }

    // Call the function to send OTP via SMS
    sendOTPviaSMS($phone, $otp);

    // Return a success message
    echo json_encode(['message' => 'OTP sent successfully']);
} else {
    // If the request method is not POST, return an error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['error' => 'Invalid request method']);
}
?>
