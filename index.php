<?php
$conn = new mysqli('localhost', 'root', '', 'CreditScoringSystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM Applicant";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Date of Birth</th><th>Contact</th><th>Email</th><th>Credit Score</th></tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row["Name"] . "</td><td>" . $row["DateOfBirth"] . "</td><td>" . $row["ContactNumber"] . "</td><td>" . $row["Email"] . "</td><td>" . $row["CreditScore"] . "</td></tr>";
    }
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
