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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $roll_no = $_POST['roll_no'];
    $gfm_name = $_POST['gfm_name'];
    $student_name = $_POST['student_name'];

    // Insert into database
    $sql = "INSERT INTO gfm_student (roll_no, gfm_name, student_name) VALUES ('$roll_no', '$gfm_name', '$student_name')";

    if ($conn->query($sql) === TRUE) {
        echo "GFM assigned successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
