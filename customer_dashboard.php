<?php
include 'db_connect.php';
session_start();
if ($_SESSION['login_type'] != 3) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Dashboard</title>
</head>
<body>
    <h2>Welcome, <?php echo $_SESSION['login_name']; ?></h2>

    <h3>Apply for a Loan</h3>
    <form id="apply-loan-form">
        <label for="loan_type">Loan Type:</label>
        <select name="loan_type_id" required>
            <?php
            $types = $conn->query("SELECT * FROM loan_types");
            while ($row = $types->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['type_name']}</option>";
            }
            ?>
        </select><br>
        <label for="amount">Loan Amount:</label>
        <input type="number" name="amount" required><br>
        <button type="submit">Apply</button>
    </form>

    <h3>Your Loan Applications</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Loan Type</th>
                <th>Amount</th>
                <th>Credit Score</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $customer_id = $_SESSION['login_id'];
            $apps = $conn->query("SELECT a.*, t.type_name FROM loan_applications a 
                                  JOIN loan_types t ON a.loan_type_id = t.id 
                                  WHERE customer_id = $customer_id");
            while ($row = $apps->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['type_name']}</td>
                        <td>{$row['amount']}</td>
                        <td>{$row['credit_score']}</td>
                        <td>{$row['status']}</td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        document.getElementById('apply-loan-form').addEventListener('submit', function (e) {
            e.preventDefault();
            fetch('ajax.php?action=apply_loan', {
                method: 'POST',
                body: new FormData(this)
            })
            .then(response => response.text())
            .then(data => {
                alert(data == 1 ? "Loan Application Submitted" : "Error Applying Loan");
                location.reload();
            });
        });
    </script>
</body>
</html>
