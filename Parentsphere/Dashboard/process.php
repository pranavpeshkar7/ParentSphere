<?php 
$servername = "localhost";
$username = "root";
$password = "";
$database = "parentsphere";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $roll_no = $_POST['roll_no'];
    $attendance = $_POST['attendance'];
    $m3 = $_POST['m3'];
    $dsa = $_POST['dsa'];
    $mp = $_POST['mp'];
    $se = $_POST['se'];
    $ppl = $_POST['ppl'];
    $leave_request = $_POST['leave_request'];
    $sql = "INSERT INTO students (name, roll_no, attendance, m3, dsa, mp, se, ppl, leave_request) 
            VALUES ('$name', '$roll_no', '$attendance', '$m3', '$dsa', '$mp', '$se', '$ppl', '$leave_request')";
    if ($conn->query($sql) === TRUE) {
        echo "<div class='success'>New record added successfully</div>";
    } else {
        echo "<div class='error'>Error: " . $sql . "<br>" . $conn->error . "</div>";
    }
}
$conn->close();
?>
<style>
    .success {
        color: green;
        font-size: 18px;
        text-align: center;
        margin-top: 20px;
    }
    .error {
        color: red;
        font-size: 18px;
        text-align: center;
        margin-top: 20px;
    }
</style>