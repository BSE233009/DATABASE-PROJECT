<?php
include('db_connect.php');
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Check if email already exists
    $chk = $conn->query("SELECT * FROM users WHERE username = '$email'")->num_rows;
    if ($chk > 0) {
        echo "<script>alert('Email already exists!');</script>";
    } else {
        $sql = "INSERT INTO users (name, contact, address, username, password, type, credit_score) 
                VALUES ('$name', '$contact', '$address', '$email', '$password', 3, 700)";
        if ($conn->query($sql)) {
            echo "<script>alert('Account created successfully!'); window.location = 'login.php';</script>";
        } else {
            echo "<script>alert('Error creating account.');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer Signup</title>
</head>
<body>
    <form method="POST" action="signup.php">
        <h2>Signup</h2>
        <label>Name:</label>
        <input type="text" name="name" required><br>
        <label>Contact:</label>
        <input type="text" name="contact" required><br>
        <label>Address:</label>
        <textarea name="address" required></textarea><br>
        <label>Email:</label>
        <input type="email" name="email" required><br>
        <label>Password:</label>
        <input type="password" name="password" required><br>
        <button type="submit">Signup</button>
    </form>
</body>
</html>
