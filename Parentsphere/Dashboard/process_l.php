<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "parentsphere";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$roll_no = $_POST['roll_no'];
$date = $_POST['date'];
$reason = $_POST['reason'];
$sql = "INSERT INTO leave_request (roll_no, date, reason) VALUES ('$roll_no', '$date', '$reason')";
if ($conn->query($sql) === TRUE) {
    echo "Leave request submitted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();
?>