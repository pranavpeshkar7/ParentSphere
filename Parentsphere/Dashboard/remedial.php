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

// Handle delete request
if (isset($_POST['delete_id'])) {
    $delete_data = json_decode($_POST['delete_id'], true);
    $delete_sql = "DELETE FROM remedial_table WHERE 
                  roll_no = '".$conn->real_escape_string($delete_data['roll_no'])."' AND 
                  subject = '".$conn->real_escape_string($delete_data['subject'])."' AND 
                  date = '".$conn->real_escape_string($delete_data['date'])."' AND 
                  time_slot = '".$conn->real_escape_string($delete_data['time_slot'])."'";
    
    if ($conn->query($delete_sql) === TRUE) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "<div class='error-message'>Error deleting record: " . $conn->error . "</div>";
    }
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
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        
        h2 {
            color: #2c3e50;
            text-align: center;
            margin-bottom: 30px;
            font-size: 2.2rem;
        }
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .box {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            margin-bottom: 20px;
        }
        
        .header {
            display: flex;
            background: linear-gradient(135deg, #3498db, #2c3e50);
            color: white;
            padding: 15px 20px;
            font-weight: 600;
            align-items: center;
        }
        
        .header span {
            flex: 1;
            text-align: center;
            padding: 0 10px;
        }
        
        .data-box {
            display: flex;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
            position: relative;
        }
        
        .data-box:hover {
            background-color: rgb(178, 202, 227);
        }
        
        .data-box span {
            flex: 1;
            text-align: center;
            padding: 0 10px;
        }
        
        .no-data {
            padding: 30px;
            text-align: center;
            color: #7f8c8d;
            font-size: 1.1rem;
        }
        
        .three-dots {
            cursor: pointer;
            padding: 0 15px;
            color: #7f8c8d;
            font-size: 1.2rem;
            transition: all 0.2s ease;
        }
        
        .three-dots:hover {
            color: #3498db;
            transform: scale(1.2);
        }
        
        .delete-btn {
            position: absolute;
            right: 80px;
            top: 50%;
            transform: translateY(-50%);
            background: #e74c3c;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 4px;
            cursor: pointer;
            display: none;
            font-weight: 500;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: all 0.2s ease;
        }
        
        .delete-btn:hover {
            background: #c0392b;
            transform: translateY(-50%) scale(1.05);
        }
        
        .error-message {
            background: #e74c3c;
            color: white;
            padding: 15px;
            border-radius: 4px;
            margin: 20px auto;
            max-width: 800px;
            text-align: center;
        }
        
        @media (max-width: 768px) {
            .header, .data-box {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .header span, .data-box span {
                text-align: left;
                padding: 5px 0;
                width: 100%;
            }
            
            .delete-btn {
                position: relative;
                right: auto;
                top: auto;
                transform: none;
                margin-top: 10px;
                display: block;
            }
            
            .three-dots {
                display: none;
            }
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
            <span>Actions</span>
        </div>

        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $delete_data = json_encode([
                    'roll_no' => $row["roll_no"],
                    'subject' => $row["subject"],
                    'date' => $row["date"],
                    'time_slot' => $row["time_slot"]
                ]);
                echo "<div class='data-box'>
                        <span>" . htmlspecialchars($row["roll_no"]) . "</span>
                        <span>" . htmlspecialchars($row["subject"]) . "</span>
                        <span>" . htmlspecialchars($row["date"]) . "</span>
                        <span>" . htmlspecialchars($row["day"]) . "</span>
                        <span>" . htmlspecialchars($row["time_slot"]) . "</span>
                        <span class='three-dots' onclick='showDeleteBtn(this)'>⋯</span>
                        <form method='POST' style='display:inline;'>
                            <input type='hidden' name='delete_id' value='".htmlspecialchars($delete_data)."'>
                            <button type='submit' class='delete-btn'>Delete</button>
                        </form>
                    </div>";
            }
        } else {
            echo "<div class='box no-data'>No remedial lectures scheduled</div>";
        }
        ?>
    </div>

    <script>
        function showDeleteBtn(element) {
            // Hide all delete buttons first
            document.querySelectorAll('.delete-btn').forEach(btn => {
                btn.style.display = 'none';
            });
            
            // Show the delete button for the clicked row
            const deleteBtn = element.nextElementSibling.querySelector('.delete-btn');
            deleteBtn.style.display = 'block';
            
            // Hide the delete button when clicking anywhere else
            document.addEventListener('click', function hideDeleteBtn(e) {
                if (!element.contains(e.target) && !(deleteBtn && deleteBtn.contains(e.target))) {
                    if (deleteBtn) deleteBtn.style.display = 'none';
                    document.removeEventListener('click', hideDeleteBtn);
                }
            });
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>