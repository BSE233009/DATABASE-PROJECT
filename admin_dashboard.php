<?php
include 'db_connect.php';
session_start();
if ($_SESSION['login_type'] != 1) {
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin Dashboard</title>
</head>
<body>
    <h3>Loan Applications</h3>
    <table border="1">
        <thead>
            <tr>
                <th>Customer</th>
                <th>Loan Type</th>
                <th>Amount</th>
                <th>Credit Score</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $apps = $conn->query("SELECT a.*, u.name, t.type_name FROM loan_applications a 
                                  JOIN users u ON a.customer_id = u.id 
                                  JOIN loan_types t ON a.loan_type_id = t.id");
            while ($row = $apps->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['name']}</td>
                        <td>{$row['type_name']}</td>
                        <td>{$row['amount']}</td>
                        <td>{$row['credit_score']}</td>
                        <td>{$row['status']}</td>
                        <td>
                            <button onclick='updateStatus({$row['id']}, \"Approved\")'>Approve</button>
                            <button onclick='updateStatus({$row['id']}, \"Rejected\")'>Reject</button>
                        </td>
                      </tr>";
            }
            ?>
        </tbody>
    </table>

    <script>
        function updateStatus(id, status) {
            fetch('ajax.php?action=update_loan_status', {
                method: 'POST',
                body: JSON.stringify({ id, status })
            })
            .then(response => response.text())
            .then(data => {
                alert(data == 1 ? "Status Updated" : "Error Updating Status");
                location.reload();
            });
        }
    </script>
</body>
</html>
