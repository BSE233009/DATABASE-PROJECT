<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'CreditScoringSystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$applicant_id = $_POST['applicant_id'];
$loan_amount = $_POST['loan_amount'];
$loan_type = $_POST['loan_type'];
$application_date = $_POST['application_date'];
$status = $_POST['status'];

// Insert into LoanApplication table
$sql = "INSERT INTO LoanApplication (ApplicantID, LoanAmount, LoanType, ApplicationDate, Status)
        VALUES ($applicant_id, $loan_amount, '$loan_type', '$application_date', '$status')";

if ($conn->query($sql) === TRUE) {
    $application_id = $conn->insert_id; // Get the newly inserted Application ID
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Loan Application Success</title>
        <link href="https://fonts.googleapis.com/css2?family=Orbitron&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Roboto', sans-serif;
                margin: 0;
                padding: 0;
                background: linear-gradient(to bottom right, #550be0, #DFFF00);
                color: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                text-align: center;
            }

            .success-container {
                background-color: rgba(255, 255, 255, 0.9);
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
                width: 90%;
                max-width: 500px;
                color: #333;
            }

            h1 {
                font-family: 'Orbitron', sans-serif;
                font-size: 2.5rem;
                color: #550be0;
            }

            p {
                font-size: 1.2rem;
                margin: 15px 0;
            }

            .highlight {
                color: #DFFF00;
                font-weight: bold;
            }

            .cta-btn {
                display: inline-block;
                margin-top: 20px;
                padding: 10px 20px;
                background-color: #550be0;
                color: #fff;
                text-transform: uppercase;
                text-decoration: none;
                font-weight: bold;
                border-radius: 5px;
                transition: background-color 0.3s, transform 0.3s;
            }

            .cta-btn:hover {
                background-color: #DFFF00;
                color: #550be0;
                transform: scale(1.05);
            }
        </style>
    </head>
    <body>
        <div class="success-container">
            <h1>🎉 Loan Application Successful! 🎉</h1>
            <p>Your loan application has been submitted successfully!</p>
            <p>Application ID: <span class="highlight"><?php echo $application_id; ?></span></p>
            <p>Loan Type: <span class="highlight"><?php echo htmlspecialchars($loan_type); ?></span></p>
            <p>Loan Amount: <span class="highlight">$<?php echo number_format($loan_amount, 2); ?></span></p>
            <p>Application Date: <span class="highlight"><?php echo htmlspecialchars($application_date); ?></span></p>
            <a href="applicant_form.html" class="cta-btn">Back to Applicant Form</a>
        </div>
    </body>
    </html>
    <?php
} else {
    echo "<h1>Error</h1>";
    echo "<p>There was an issue submitting your loan application: " . $conn->error . "</p>";
}

$conn->close();
?>
