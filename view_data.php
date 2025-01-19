<?php
$conn = new mysqli('localhost', 'root', '', 'CreditScoringSystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch applicants
$applicant_sql = "SELECT * FROM Applicant";
$applicant_result = $conn->query($applicant_sql);

// Fetch loan applications
$loan_sql = "SELECT * FROM LoanApplication";
$loan_result = $conn->query($loan_sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Data</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>View Applicants and Loan Applications</h1>
    </header>
    <main>
        <h2>Applicants</h2>
        <table border="1">
            <tr>
                <th>Applicant ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Credit Score</th>
            </tr>
            <?php while ($row = $applicant_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ApplicantID']; ?></td>
                <td><?php echo $row['Name']; ?></td>
                <td><?php echo $row['Email']; ?></td>
                <td><?php echo $row['CreditScore']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>

        <h2>Loan Applications</h2>
        <table border="1">
            <tr>
                <th>Application ID</th>
                <th>Applicant ID</th>
                <th>Loan Amount</th>
                <th>Status</th>
            </tr>
            <?php while ($row = $loan_result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['ApplicationID']; ?></td>
                <td><?php echo $row['ApplicantID']; ?></td>
                <td><?php echo $row['LoanAmount']; ?></td>
                <td><?php echo $row['Status']; ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
    </main>
</body>
</html>
