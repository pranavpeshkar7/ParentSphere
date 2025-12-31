<?php    
$servername = "localhost";
$username = "root";
$password = "";
$database = "parentsphere";
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Handle student deletion (if request is made via AJAX)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["roll_no"])) {
    $roll_no = $_POST["roll_no"];

    $sql = "DELETE FROM students WHERE roll_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $roll_no);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }

    $stmt->close();
    $conn->close();
    exit();  // Stop further execution for AJAX requests
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
        
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--light-bg);
            color: var(--dark-text);
            line-height: 1.6;
            padding: 20px;
        }
        
        .container {
            width: 95%;
            max-width: 1400px;
            margin: 0 auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }
        
        .page-title {
            font-size: 28px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .search-bar {
            display: flex;
            width: 300px;
        }
        
        .search-bar input {
            flex: 1;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: var(--border-radius) 0 0 var(--border-radius);
            font-family: 'Poppins', sans-serif;
            outline: none;
            transition: var(--transition);
        }
        
        .search-bar input:focus {
            border-color: var(--secondary-color);
        }
        
        .search-bar button {
            background-color: var(--secondary-color);
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 0 var(--border-radius) var(--border-radius) 0;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .search-bar button:hover {
            background-color: #2980b9;
        }
        
        .records-container {
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            overflow: hidden;
        }
        
        .header-row {
            display: flex;
            background-color: var(--primary-color);
            color: var(--light-text);
            padding: 15px 20px;
            font-weight: 500;
            border-radius: var(--border-radius) var(--border-radius) 0 0;
        }
        
        .header-row span {
            flex: 1;
            text-align: center;
            padding: 0 5px;
        }
        
        .header-row .name-header {
            flex: 2;
            text-align: left;
        }
        
        .student-row {
            display: flex;
            align-items: center;
            padding: 15px 20px;
            border-bottom: 1px solid #eee;
            transition: var(--transition);
            position: relative;
        }
        
        .student-row:last-child {
            border-bottom: none;
        }
        
        .student-row:hover {
            background-color: #f5f7fa;
        }
        
        .student-cell {
            flex: 1;
            text-align: center;
            padding: 0 5px;
            color: var(--dark-text);
        }
        
        .student-name {
            flex: 2;
            text-align: left;
            font-weight: 500;
            display: flex;
            align-items: center;
        }
        
        .student-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background-color: var(--secondary-color);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 14px;
            font-weight: 600;
        }
        
        .attendance-cell {
            font-weight: 600;
        }
        
        .attendance-high {
            color: var(--success-color);
        }
        
        .attendance-medium {
            color: var(--warning-color);
        }
        
        .attendance-low {
            color: var(--accent-color);
        }
        
        .grade-cell {
            font-weight: 600;
        }
        
        .grade-a {
            color: var(--success-color);
        }
        
        .grade-b {
            color: #2ecc71;
        }
        
        .grade-c {
            color: #f1c40f;
        }
        
        .grade-d {
            color: #e67e22;
        }
        
        .grade-f {
            color: var(--accent-color);
        }
        
        .leave-cell {
            display: flex;
            justify-content: center;
        }
        
        .leave-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 12px;
            font-weight: 500;
        }
        
        .leave-pending {
            background-color: #fff3cd;
            color: #856404;
        }
        
        .leave-approved {
            background-color: #d4edda;
            color: #155724;
        }
        
        .leave-rejected {
            background-color: #f8d7da;
            color: #721c24;
        }
        
        .action-cell {
            position: relative;
        }
        
        .action-btn {
            background: none;
            border: none;
            color: #7f8c8d;
            cursor: pointer;
            font-size: 18px;
            padding: 5px;
            transition: var(--transition);
        }
        
        .action-btn:hover {
            color: var(--primary-color);
        }
        
        .dropdown-menu {
            position: absolute;
            right: 0;
            top: 100%;
            background-color: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            min-width: 150px;
            z-index: 100;
            display: none;
            overflow: hidden;
        }
        
        .dropdown-menu.show {
            display: block;
        }
        
        .dropdown-item {
            padding: 10px 15px;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
        }
        
        .dropdown-item:hover {
            background-color: #f8f9fa;
        }
        
        .dropdown-item i {
            margin-right: 8px;
            width: 18px;
            text-align: center;
        }
        
        .dropdown-item.delete {
            color: var(--accent-color);
        }
        
        .no-records {
            text-align: center;
            padding: 40px;
            color: #7f8c8d;
        }
        
        .status-indicator {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            display: inline-block;
            margin-right: 5px;
        }
        
        .status-active {
            background-color: var(--success-color);
        }
        
        .status-inactive {
            background-color: #95a5a6;
        }
        
        @media (max-width: 1200px) {
            .header-row,
            .student-row {
                flex-wrap: wrap;
            }
            
            .header-row span,
            .student-cell {
                flex: 0 0 25%;
                margin-bottom: 10px;
            }
            
            .header-row .name-header,
            .student-name {
                flex: 0 0 50%;
            }
            
            .action-cell {
                flex: 0 0 100%;
                text-align: right;
            }
        }
        
        @media (max-width: 768px) {
            .header {
                flex-direction: column;
                align-items: flex-start;
            }
            
            .search-bar {
                width: 100%;
                margin-top: 15px;
            }
            
            .header-row span,
            .student-cell {
                flex: 0 0 50%;
                font-size: 14px;
            }
            
            .header-row .name-header,
            .student-name {
                flex: 0 0 100%;
            }
        }
        
        /* Toast notification */
        .toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: var(--success-color);
            color: white;
            padding: 15px 25px;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            display: flex;
            align-items: center;
            z-index: 1000;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        
        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }
        
        .toast.error {
            background-color: var(--accent-color);
        }
        
        .toast i {
            margin-right: 10px;
            font-size: 20px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="header">
        <h1 class="page-title">Student Records</h1>
        <div class="search-bar">
            <input type="text" placeholder="Search students...">
            <button><i class="fas fa-search"></i></button>
        </div>
    </div>
    
    <div class="records-container">
        <div class="header-row">
            <span class="name-header">Student Name</span>
            <span>Roll No</span>
            <span>Attendance</span>
            <span>M3</span>
            <span>DSA</span>
            <span>MP</span>
            <span>SE</span>
            <span>PPL</span>
            <span>Leave Status</span>
            <span>Actions</span>
        </div>
        
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Determine attendance class
                $attendanceClass = 'attendance-high';
                if ($row['attendance'] < 75) $attendanceClass = 'attendance-medium';
                if ($row['attendance'] < 50) $attendanceClass = 'attendance-low';
                
                // Determine leave status class
                $leaveClass = 'leave-pending';
                $leaveText = 'Pending';
                if ($row['leave_request'] === 'Yes') {
                    $leaveClass = 'leave-approved';
                    $leaveText = 'Approved';
                } elseif ($row['leave_request'] === 'No') {
                    $leaveClass = 'leave-rejected';
                    $leaveText = 'Rejected';
                }
                
                // Get initials for avatar
                $nameParts = explode(' ', $row['name']);
                $initials = '';
                foreach ($nameParts as $part) {
                    $initials .= strtoupper(substr($part, 0, 1));
                }
                if (strlen($initials) > 2) $initials = substr($initials, 0, 2);
                
                echo "<div class='student-row' id='student-{$row['roll_no']}'>
                        <div class='student-cell student-name'>
                            <div class='student-avatar'>{$initials}</div>
                            {$row['name']}
                        </div>
                        <div class='student-cell'>{$row['roll_no']}</div>
                        <div class='student-cell attendance-cell {$attendanceClass}'>{$row['attendance']}%</div>
                        <div class='student-cell grade-cell grade-".strtolower($row['M3'])."'>{$row['M3']}</div>
                        <div class='student-cell grade-cell grade-".strtolower($row['DSA'])."'>{$row['DSA']}</div>
                        <div class='student-cell grade-cell grade-".strtolower($row['MP'])."'>{$row['MP']}</div>
                        <div class='student-cell grade-cell grade-".strtolower($row['SE'])."'>{$row['SE']}</div>
                        <div class='student-cell grade-cell grade-".strtolower($row['PPL'])."'>{$row['PPL']}</div>
                        <div class='student-cell leave-cell'>
                            <span class='leave-badge {$leaveClass}'>{$leaveText}</span>
                        </div>
                        <div class='student-cell action-cell'>
                            <button class='action-btn' onclick='toggleDropdown(this)'><i class='fas fa-ellipsis-v'></i></button>
                            <div class='dropdown-menu'>
                                <div class='dropdown-item delete' onclick='deleteStudent({$row['roll_no']})'>
                                    <i class='fas fa-trash'></i> Delete
                                </div>
                            </div>
                        </div>
                    </div>";
            }
        } else {
            echo "<div class='no-records'>
                    <i class='fas fa-user-graduate' style='font-size: 48px; margin-bottom: 15px; color: #bdc3c7;'></i>
                    <h3>No Student Records Found</h3>
                    <p>Add new students to get started</p>
                </div>";
        }
        ?>
    </div>
</div>

<div id="toast" class="toast">
    <i class="fas fa-check-circle"></i>
    <span id="toast-message">Student deleted successfully</span>
</div>

<script>
    // Toggle dropdown menu
    function toggleDropdown(button) {
        const dropdown = button.nextElementSibling;
        const allDropdowns = document.querySelectorAll('.dropdown-menu');
        
        // Close all other dropdowns
        allDropdowns.forEach(menu => {
            if (menu !== dropdown) {
                menu.classList.remove('show');
            }
        });
        
        // Toggle current dropdown
        dropdown.classList.toggle('show');
    }
    
    // Close dropdowns when clicking outside
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.action-cell')) {
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.classList.remove('show');
            });
        }
    });
    
    // Delete student function
    function deleteStudent(roll_no) {
        if (confirm("Are you sure you want to delete this student? This action cannot be undone.")) {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "my.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    if (xhr.status === 200) {
                        if (xhr.responseText.trim() === "success") {
                            document.getElementById("student-" + roll_no).remove();
                            showToast('Student deleted successfully');
                            
                            // If no students left, show empty state
                            if (document.querySelectorAll('.student-row').length === 1) { // 1 because header is also .student-row
                                document.querySelector('.records-container').innerHTML = `
                                    <div class='no-records'>
                                        <i class='fas fa-user-graduate' style='font-size: 48px; margin-bottom: 15px; color: #bdc3c7;'></i>
                                        <h3>No Student Records Found</h3>
                                        <p>Add new students to get started</p>
                                    </div>
                                `;
                            }
                        } else {
                            showToast('Error deleting student', true);
                        }
                    } else {
                        showToast('Error deleting student', true);
                    }
                }
            };
            xhr.send("roll_no=" + roll_no);
        }
    }
    
    // Placeholder functions for view and edit
    function viewStudent(roll_no) {
        showToast('View student ' + roll_no);
        // Implement view functionality here
    }
    
    function editStudent(roll_no) {
        showToast('Edit student ' + roll_no);
        // Implement edit functionality here
    }
    
    // Toast notification function
    function showToast(message, isError = false) {
        const toast = document.getElementById('toast');
        const toastMessage = document.getElementById('toast-message');
        
        toastMessage.textContent = message;
        toast.className = isError ? 'toast error show' : 'toast show';
        toast.innerHTML = isError 
            ? `<i class="fas fa-exclamation-circle"></i><span id="toast-message">${message}</span>`
            : `<i class="fas fa-check-circle"></i><span id="toast-message">${message}</span>`;
        
        setTimeout(() => {
            toast.className = 'toast';
        }, 3000);
    }
    
    // Search functionality
    document.querySelector('.search-bar input').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const students = document.querySelectorAll('.student-row:not(.header-row)');
        
        students.forEach(student => {
            const name = student.querySelector('.student-name').textContent.toLowerCase();
            const rollNo = student.querySelector('.student-cell:nth-child(2)').textContent.toLowerCase();
            
            if (name.includes(searchTerm) || rollNo.includes(searchTerm)) {
                student.style.display = 'flex';
            } else {
                student.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
<?php
$conn->close();
?>