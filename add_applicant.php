<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'CreditScoringSystem');

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$name = $_POST['name'];
$dob = $_POST['dob'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$email = $_POST['email'];
$employment = $_POST['employment'];
$income = $_POST['income'];
$credit_score = $_POST['credit_score'];

// Insert into Applicant table
$sql = "INSERT INTO Applicant (Name, DateOfBirth, Address, ContactNumber, Email, EmploymentStatus, AnnualIncome, CreditScore)
        VALUES ('$name', '$dob', '$address', '$contact', '$email', '$employment', $income, $credit_score)";

if ($conn->query($sql) === TRUE) {
    // Get the last inserted ApplicantID
    $applicant_id = $conn->insert_id;

    // Redirect to loan application form
    header("Location: loan_application_form.php?applicant_id=$applicant_id&credit_score=$credit_score");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
