<?php
// Get the ApplicantID and Credit Score from the query parameters
$applicant_id = isset($_GET['applicant_id']) ? $_GET['applicant_id'] : null;
$credit_score = isset($_GET['credit_score']) ? $_GET['credit_score'] : null;

// Check if the applicant is eligible for a loan
if ($credit_score === null || $credit_score < 600) {
    echo "<h2>Sorry, you are not eligible for a loan due to a low credit score ($credit_score).</h2>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #550be0, #DFFF00);
            color: #333;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        main {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.2);
            width: 90%;
            max-width: 500px;
        }

        h2 {
            font-size: 1.8rem;
            color: #550be0;
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            font-size: 1rem;
            font-weight: 500;
            color: #333;
            margin-bottom: 5px;
            display: block;
        }

        form input,
        form select,
        form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 1rem;
            transition: all 0.3s;
        }

        form input:focus,
        form select:focus {
            outline: none;
            border: 1px solid #550be0;
            box-shadow: 0 0 5px rgba(85, 11, 224, 0.5);
        }

        form button {
            background-color: #550be0;
            color: #fff;
            font-size: 1rem;
            font-weight: bold;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.3s;
        }

        form button:hover {
            background-color: #DFFF00;
            color: #550be0;
            transform: scale(1.05);
        }
    </style>
</head>
<body>
    <main>
        <h2>Loan Application Form</h2>
        <form action="add_loan_application.php" method="POST">
            <input type="hidden" name="applicant_id" value="<?php echo htmlspecialchars($applicant_id); ?>">

            <label for="loan_amount">Loan Amount:</label>
            <input type="number" id="loan_amount" name="loan_amount" step="0.01" placeholder="Enter loan amount" required>

            <label for="loan_type">Loan Type:</label>
            <select id="loan_type" name="loan_type" required>
                <option value="Personal">Personal</option>
                <option value="Mortgage">Mortgage</option>
                <option value="Auto">Auto</option>
            </select>

            <label for="application_date">Application Date:</label>
            <input type="date" id="application_date" name="application_date" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Pending">Pending</option>
                <option value="Approved">Approved</option>
                <option value="Rejected">Rejected</option>
            </select>

            <button type="submit">Submit Application</button>
        </form>
    </main>
</body>
</html>
