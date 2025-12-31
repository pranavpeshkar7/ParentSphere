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

// Fetching form data
$roll_no = $_POST['roll_no'];
$subject = $_POST['subject'];
$date = $_POST['date'];
$day = $_POST['day'];
$time_slot = $_POST['time_slot'];

// Insert data into the table
$sql = "INSERT INTO remedial_table (roll_no, subject, date, day, time_slot) 
        VALUES ('$roll_no', '$subject', '$date', '$day', '$time_slot')";

if ($conn->query($sql) === TRUE) {
    echo "New remedial lecture added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close connection
$conn->close();
?>
