<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "dbms";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$selectSql = "SELECT * FROM declaration_form"; // Replace with your table name
$result = $conn->query($selectSql);

if ($result->num_rows > 0) {
    echo "<h2>Data in the Database:</h2>";
    echo "<table>";
    echo "<tr><th>Name</th><th>Email</th><th>Phone</th><th>Symptoms</th><th>Travel</th><th>Contact</th></tr>";

    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["name"] . "</td>"; // Replace with your field names
        echo "<td>" . $row["email"] . "</td>";
        echo "<td>" . $row["phone"] . "</td>";
        echo "<td>" . $row["symptoms"] . "</td>";
        echo "<td>" . $row["travel"] . "</td>";
        echo "<td>" . $row["contact"] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No records found.";
}

$conn->close();
?>

<style>
  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }
  
  th, td {
    padding: 10px;
    text-align: left;
    border-bottom: 1px solid #ddd;
  }
  
  th {
    background-color: #f2f2f2;
  }
</style>
