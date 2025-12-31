<?php     
$servername = "localhost";
$username = "root";
$password = "";
$database = "parentsphere";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Fetch student records
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #3498db;
            --accent-color: #e74c3c;
            --success-color: #27ae60;
            --warning-color: #f39c12;
            --light-bg: #f8f9fa;
            --dark-text: #2c3e50;
            --light-text: #ecf0f1;
            --border-radius: 8px;
            --box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            margin: 0;
            padding: 20px;
        }
        
        .container {
            width: 95%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .header-box {
            display: grid;
            grid-template-columns: 2fr repeat(8, 1fr);
            padding: 15px 20px;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
            background-color: var(--primary-color);
            color: var(--light-text);
            font-weight: 500;
            box-shadow: var(--box-shadow);
            margin-bottom: 10px;
            gap: 10px;
            align-items: center;
        }
        
        .header-box span {
            text-align: center;
            font-size: 14px;
        }
        
        .header-box span:first-child {
            text-align: left;
        }
        
        .student-box {
            display: grid;
            grid-template-columns: 2fr repeat(8, 1fr);
            padding: 14px 20px;
            border-radius: var(--border-radius);
            background-color: white;
            color: var(--dark-text);
            margin-bottom: 10px;
            box-shadow: var(--box-shadow);
            transition: var(--transition);
            gap: 10px;
            align-items: center;
        }
        
        .student-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        }
        
        .column {
            text-align: center;
            font-size: 14px;
        }
        
        .name-column {
            text-align: left;
            font-weight: 500;
            color: var(--primary-color);
        }
        
        /* Attendance color coding */
        .column:nth-child(3) {
            font-weight: 600;
        }
        
        /* Grade color coding */
        .column:nth-child(4),
        .column:nth-child(5),
        .column:nth-child(6),
        .column:nth-child(7),
        .column:nth-child(8) {
            font-weight: 600;
        }
        
        /* Leave request status */
        .column:last-child {
            font-weight: 500;
            text-transform: capitalize;
        }
        
        @media (max-width: 1200px) {
            .header-box,
            .student-box {
                grid-template-columns: repeat(4, 1fr);
            }
            
            .header-box span,
            .student-box .column {
                grid-column: span 1;
            }
            
            .header-box span:first-child,
            .student-box .name-column {
                grid-column: span 2;
            }
        }
        
        @media (max-width: 768px) {
            .header-box,
            .student-box {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .header-box span,
            .student-box .column {
                grid-column: span 1;
                font-size: 13px;
            }
            
            .header-box span:first-child,
            .student-box .name-column {
                grid-column: span 2;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header-box">
        <span>Student Name</span>
        <span>Roll No</span>
        <span>Attendance</span>
        <span>M3</span>
        <span>DSA</span>
        <span>MP</span>
        <span>SE</span>
        <span>PPL</span>
        <span>Leave Request</span>
    </div>
    <?php
    while ($row = $result->fetch_assoc()) {
        // Determine attendance class
        $attendanceClass = '';
        if ($row['attendance'] < 50) $attendanceClass = 'color: var(--accent-color);';
        elseif ($row['attendance'] < 75) $attendanceClass = 'color: var(--warning-color);';
        else $attendanceClass = 'color: var(--success-color);';
        
        // Determine grade colors
        $gradeStyle = function($grade) {
            $grade = strtoupper($grade);
            if ($grade === 'A') return 'color: var(--success-color);';
            if ($grade === 'B') return 'color: #2ecc71;';
            if ($grade === 'C') return 'color: #f1c40f;';
            if ($grade === 'D') return 'color: #e67e22;';
            if ($grade === 'F') return 'color: var(--accent-color);';
            return '';
        };
        
        // Determine leave request color
        $leaveStyle = '';
        $leaveText = $row['leave_request'];
        if ($row['leave_request'] === 'Approved') {
            $leaveStyle = 'color: var(--success-color);';
        } elseif ($row['leave_request'] === 'Rejected') {
            $leaveStyle = 'color: var(--accent-color);';
        } elseif ($row['leave_request'] === 'Pending') {
            $leaveStyle = 'color: var(--warning-color);';
        }
        
        echo "<div class='student-box'>
                <span class='column name-column'>{$row['name']}</span>
                <span class='column'>{$row['roll_no']}</span>
                <span class='column' style='{$attendanceClass}'>{$row['attendance']}%</span>
                <span class='column' style='{$gradeStyle($row['M3'])}'>{$row['M3']}</span>
                <span class='column' style='{$gradeStyle($row['DSA'])}'>{$row['DSA']}</span>
                <span class='column' style='{$gradeStyle($row['MP'])}'>{$row['MP']}</span>
                <span class='column' style='{$gradeStyle($row['SE'])}'>{$row['SE']}</span>
                <span class='column' style='{$gradeStyle($row['PPL'])}'>{$row['PPL']}</span>
                <span class='column' style='{$leaveStyle}'>{$leaveText}</span>
              </div>";
    }
    ?>
</div>
</body>
</html>
<?php
$conn->close();
?>