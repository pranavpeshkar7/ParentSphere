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

// Fetch data
$sql = "SELECT * FROM gfm_student ORDER BY gfm_name, student_name";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFM List</title>
    <style>
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #166088;
            --accent-color: #4fc3f7;
            --background-color: #f8f9fa;
            --text-color: #333;
            --card-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            --danger-color: #e74c3c;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background-color);
            color: var(--text-color);
            margin: 0;
            padding: 20px;
        }
        
        h2 {
            color: var(--secondary-color);
            text-align: center;
            margin-bottom: 30px;
        }
        
        .gfm-container {
            display: flex;
            flex-direction: column;
            gap: 20px;
            max-width: 800px;
            margin: 0 auto;
        }
        
        .gfm-card {
            background: white;
            border-radius: 10px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            position: relative;
        }
        
        .gfm-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            background-color: var(--primary-color);
            color: white;
            cursor: pointer;
        }
        
        .gfm-name {
            font-weight: 600;
            font-size: 18px;
        }
        
        .header-actions {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .toggle-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            transition: transform 0.3s ease;
            padding: 0 8px;
        }
        
        .toggle-btn.active {
            transform: rotate(180deg);
        }
        
        .ellipsis-btn {
            background: none;
            border: none;
            color: white;
            font-size: 20px;
            cursor: pointer;
            padding: 0 8px;
        }
        
        .action-menu {
            position: absolute;
            right: 20px;
            top: 60px;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 10;
            display: none;
        }
        
        .student-action-menu {
            position: absolute;
            right: 20px;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 10;
            display: none;
        }
        
        .action-menu.show, .student-action-menu.show {
            display: block;
        }
        
        .delete-btn {
            padding: 8px 16px;
            background-color: var(--danger-color);
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 6px;
            width: 100%;
            text-align: left;
            white-space: nowrap;
        }
        
        .delete-btn:hover {
            background-color: #c0392b;
        }
        
        .students-container {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.3s ease;
        }
        
        .students-container.show {
            max-height: 1000px;
        }
        
        .student-table {
            width: 100%;
            border-collapse: collapse;
            position: relative;
        }
        
        .student-table th {
            background-color: var(--secondary-color);
            color: white;
            padding: 12px;
            text-align: left;
        }
        
        .student-table td {
            padding: 12px;
            border-bottom: 1px solid #eee;
            position: relative;
        }
        
        .student-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .student-table tr:hover {
            background-color: #f1f1f1;
        }
        
        .no-students {
            padding: 20px;
            text-align: center;
            color: #666;
            font-style: italic;
        }
        
        .student-actions {
            position: relative;
            width: 40px;
            text-align: right;
            padding-right: 15px;
        }

        .student-ellipsis {
            background: none;
            border: none;
            color: #666;
            font-size: 18px;
            cursor: pointer;
            padding: 5px 10px;
            margin: 0;
            line-height: 1;
        }

        .student-action-menu {
            position: absolute;
            right: 15px;
            top: 30px;
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
            z-index: 10;
            display: none;
            min-width: 120px;
        }
    </style>
</head>
<body>
    <h2>Guardian Faculty Members</h2>
    
    <div class="gfm-container">
        <?php
        if ($result->num_rows > 0) {
            // Group students by GFM
            $gfms = [];
            while ($row = $result->fetch_assoc()) {
                $gfms[$row['gfm_name']][] = $row;
            }
            
            // Display each GFM with their students
            foreach ($gfms as $gfm_name => $students) {
                echo '<div class="gfm-card">';
                echo '<div class="gfm-header" onclick="toggleStudents(this)">';
                echo '<div class="gfm-name">' . htmlspecialchars($gfm_name) . '</div>';
                echo '<div class="header-actions">';
                echo '<button class="toggle-btn">▼</button>';
                echo '<button class="ellipsis-btn" onclick="event.stopPropagation(); toggleMenu(this)">⋯</button>';
                echo '</div>';
                echo '</div>';
                
                echo '<div class="action-menu">';
                echo '<button class="delete-btn" onclick="deleteGFM(this, \'' . htmlspecialchars($gfm_name) . '\')">';
                echo 'Delete GFM';
                echo '</button>';
                echo '</div>';
                
                echo '<div class="students-container">';
                echo '<table class="student-table">';
                echo '<tr><th>Roll No</th><th>Student Name</th><th></th></tr>';
                
                foreach ($students as $student) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($student['roll_no']) . '</td>';
                    echo '<td>' . htmlspecialchars($student['student_name']) . '</td>';
                    echo '<td class="student-actions">';
                    echo '<button class="student-ellipsis" onclick="event.stopPropagation(); toggleStudentMenu(this)">⋯</button>';
                    echo '<div class="student-action-menu">';
                    echo '<button class="delete-btn" onclick="deleteStudent(this, \'' . htmlspecialchars($student['roll_no']) . '\', \'' . htmlspecialchars($gfm_name) . '\')">Delete Student</button>';
                    echo '</div>';
                    echo '</td>';
                    echo '</tr>';
                }
                
                echo '</table>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div style="text-align: center; padding: 20px; color: #666;">No records found</div>';
        }
        ?>
    </div>

    <script>
        function toggleStudents(header) {
            const card = header.parentElement;
            const studentsContainer = card.querySelector('.students-container');
            const toggleBtn = header.querySelector('.toggle-btn');
            
            studentsContainer.classList.toggle('show');
            toggleBtn.classList.toggle('active');
        }
        
        function toggleMenu(button) {
            const card = button.closest('.gfm-card');
            const menu = card.querySelector('.action-menu');
            
            // Close all other open menus first
            document.querySelectorAll('.action-menu').forEach(m => {
                if (m !== menu) m.classList.remove('show');
            });
            document.querySelectorAll('.student-action-menu').forEach(m => {
                m.classList.remove('show');
            });
            
            menu.classList.toggle('show');
        }
        
        function toggleStudentMenu(button) {
            const menu = button.nextElementSibling;
            
            // Close all other open menus first
            document.querySelectorAll('.action-menu').forEach(m => {
                m.classList.remove('show');
            });
            document.querySelectorAll('.student-action-menu').forEach(m => {
                if (m !== menu) m.classList.remove('show');
            });
            
            menu.classList.toggle('show');
        }
        
        function deleteGFM(button, gfmName) {
            if (confirm(`Are you sure you want to delete ${gfmName} and all associated students?`)) {
                const card = button.closest('.gfm-card');
                card.style.opacity = '0';
                card.style.transition = 'opacity 0.3s ease';
                setTimeout(() => card.remove(), 300);
                
                console.log(`GFM ${gfmName} would be deleted via AJAX here`);
            }
        }
        
        function deleteStudent(button, rollNo, gfmName) {
            if (confirm(`Are you sure you want to delete student with Roll No: ${rollNo}?`)) {
                const row = button.closest('tr');
                row.style.opacity = '0';
                row.style.transition = 'opacity 0.3s ease';
                setTimeout(() => row.remove(), 300);
                
                console.log(`Student ${rollNo} under GFM ${gfmName} would be deleted via AJAX here`);
            }
        }
        
        // Close menus when clicking elsewhere
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.ellipsis-btn') && 
                !e.target.closest('.action-menu') && 
                !e.target.closest('.student-ellipsis') && 
                !e.target.closest('.student-action-menu')) {
                document.querySelectorAll('.action-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
                document.querySelectorAll('.student-action-menu').forEach(menu => {
                    menu.classList.remove('show');
                });
            }
        });
    </script>
</body>
</html>

<?php
$conn->close();
?>