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

// Fetch data from database
$sql = "SELECT * FROM remedial_table";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remedial Lectures</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            text-align: center;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 80%;
            margin: 50px auto;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 15px;
        }
        .box {
            width: 100%;
            max-width: 800px;
            padding: 15px;
            border-radius: 10px;
            background: white;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            font-size: 18px;
            font-weight: 500;
        }
        .header {
            font-size: 20px;
            font-weight: bold;
            color: white;
            background: #007bff;
            padding: 15px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header span {
            flex: 1;
            text-align: center;
            min-width: 100px; /* Ensures proper width for alignment */
        }

        .data-box {
            display: flex;
            justify-content: space-between;
            padding: 12px;
            background: #ffffff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 800px;
        }
        .data-box span {
            flex: 1;
            text-align: center;
            font-size: 16px;
            font-weight: 400;
            color: #333;
        }
        .no-data {
            color: #777;
            padding: 15px;
            font-size: 16px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <h2>Remedial Lectures</h2>
    <div class="container">
        <div class="box header">
            <span>Roll No</span>
            <span>Subject</span>
            <span>Date</span>
            <span>Day</span>
            <span>Time Slot</span>
        </div>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<div class='data-box'>
                        <span>" . $row["roll_no"] . "</span>
                        <span>" . $row["subject"] . "</span>
                        <span>" . $row["date"] . "</span>
                        <span>" . $row["day"] . "</span>
                        <span>" . $row["time_slot"] . "</span>
                    </div>";
            }
        } else {
            echo "<div class='box no-data'>No remedial lectures scheduled</div>";
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
