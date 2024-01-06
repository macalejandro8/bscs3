<!DOCTYPE html>
<html>
<head>
  <title>Delete Record</title>
  <link rel="stylesheet" href="styles.css">
  <style>
    /* CSS styles */

    body {
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      margin: 0;
      padding: 20px;
    }

    .container {
      max-width: 500px;
      margin: auto;
      background-color: #fff;
      border: 1px solid #ccc;
      border-radius: 4px;
      padding: 20px;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #333;
      margin-top: 0;
    }

    form {
      text-align: center;
      margin-top: 20px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #555;
    }

    input[type="tel"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #050505;
      border-radius: 4px;
      font-size: 16px;
      color: #555;
      margin-bottom: 10px;
    }

    input[type="submit"] {
      background-color: #f50000;
      color: #fff;
      padding: 10px 20px;
      font-size: 14px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #555;
    }

    .back-button {
      text-align: center;
      margin-top: 20px;
    }

    .back-button button {
      margin: 5px;
      padding: 10px 20px;
      font-size: 14px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      background-color: #555;
      color: #fff;
    }

    .back-button button:hover {
      background-color: #333;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Delete Record</h1>

    <form action="delete_form.php" method="post">
      <label for="phone">Enter Phone Number:</label>
      <input type="tel" id="phone" name="phone" required>
      <br>
      <input type="submit" value="Delete">
    </form>

    <div class="back-button">
      <button onclick="location.href='view_data.php'">Go Back</button>
    </div>
  </div>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the delete button is clicked and a phone number is provided
if (isset($_POST["phone"])) {
    $phone = $_POST["phone"];

    // Prepare and execute the DELETE query
    $deleteSql = "DELETE FROM declaration_form WHERE phone = ?"; // Replace with your table name and phone column name
    $stmt = $conn->prepare($deleteSql);
    $stmt->bind_param("s", $phone);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p style='text-align: center;'>Record with phone number $phone deleted successfully.</p>";
    } else {
        echo "<p style='text-align: center;'>No record found with phone number $phone.</p>";
    }

    $stmt->close();
} else {
    echo "<p style='text-align: center;'>:(</p>";
}

$conn->close();
?>
