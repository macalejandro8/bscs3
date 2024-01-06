<!DOCTYPE html>
<html>
<head>
    <title>Update Information</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to bottom, #e6f1ff, #fff);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            max-width: 500px;
            margin: auto;
            background-color: #fdfdfd;
            border: 5px solid #000000;
            border-radius: 30px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #050505;
            border-radius: 10px;
            font-size: 16px;
            color: #555;
        }

        input[type="radio"] {
            margin-right: 10px;
        }

        input[type="submit"] {
            background-color: #f50000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        input[type="submit"]:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    
<h2>Update Information</h2>
<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    <label for="phone">Phone Number:</label>
    <input type="text" id="phone" name="phone" required>

    <label for="name">Name:</label>
    <input type="text" id="name" name="name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required>

    <label for="symptoms">Do you have any COVID-19 symptoms?</label>
    <br>
    <input type="radio" id="symptoms_yes" name="symptoms" value="yes">
    <label for="symptoms_yes">Yes</label>
    <input type="radio" id="symptoms_no" name="symptoms" value="no">
    <label for="symptoms_no">No</label>

    <label for="travel">Have you traveled internationally in the past 14 days?</label>
    <br>
    <input type="radio" id="travel_yes" name="travel" value="yes">
    <label for="travel_yes">Yes</label>
    <input type="radio" id="travel_no" name="travel" value="no">
    <label for="travel_no">No</label>

    <label for="contact">Have you been in close contact with someone who tested positive for COVID-19?</label>
    <br>
    <input type="radio" id="contact_yes" name="contact" value="yes">
    <label for="contact_yes">Yes</label>
    <input type="radio" id="contact_no" name="contact" value="no">
    <label for="contact_no">No</label>

    <br><br>
    <center><input type="submit" value="Update"></center>
</form>
</body>
</html>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone = $_POST["phone"]; // Assuming the phone number is provided in the form

    // Retrieve the existing record from the database
    $selectSql = "SELECT * FROM declaration_form WHERE phone = '$phone'";
    $result = $conn->query($selectSql);

    if ($result->num_rows > 0) {
        // Record exists, perform the update
        $name = $_POST["name"];
        $email = $_POST["email"];
        $symptoms = $_POST["symptoms"];
        $travel = $_POST["travel"];
        $contact = $_POST["contact"];

        $updateSql = "UPDATE declaration_form SET name='$name', email='$email',
                      symptoms='$symptoms', travel='$travel', contact='$contact' WHERE phone = '$phone'";

        if ($conn->query($updateSql) === TRUE) {
            echo "<p>Record updated successfully.</p>";
        } else {
            echo "<p>Error updating record: " . $conn->error . "</p>";
        }
    } else {
        echo "<p>Record not found.</p>";
    }
}

$conn->close();
?>