<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "parentsphere";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hashing for security
    $role = $_POST['role'];

    // Insert into database
    $sql = "INSERT INTO login (email, password, role) VALUES ('$email', '$password', '$role')";
    
    if ($conn->query($sql) === TRUE) {
        $conn->close();
        header("Location: login.php");
        exit();
    } else {
        echo "Error: " . $conn->error;
        $conn->close();
    }
} else {
    // If someone accesses this page directly without submitting the form
    header("Location: signup.php");
    exit();
}
?>