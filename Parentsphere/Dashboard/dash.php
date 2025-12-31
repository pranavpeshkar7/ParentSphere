<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f5f5;
        }
        
        .header {
            background-color: #2c3e50;
            color: white;
            padding: 15px 20px;
            display: flex;
            align-items: center;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .menu-btn {
            background: none;
            border: none;
            color: white;
            font-size: 24px;
            cursor: pointer;
            margin-right: 20px;
        }
        
        .sidebar {
            width: 250px;
            background-color: #34495e;
            color: white;
            position: fixed;
            height: 100%;
            top: 60px;
            left: -250px;
            transition: left 0.3s ease;
            z-index: 99;
        }
        
        .sidebar.active {
            left: 0;
        }
        
        .sidebar-menu {
            list-style: none;
        }
        
        .sidebar-menu li {
            padding: 15px 20px;
            border-bottom: 1px solid #2c3e50;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        
        .sidebar-menu li:hover {
            background-color: #2c3e50;
        }
        
        .sidebar-menu li a {
            color: white;
            text-decoration: none;
            display: block;
        }
        
        .main-content {
            margin-top: 60px;
            padding: 20px;
            transition: margin-left 0.3s ease;
        }
        
        .main-content.active {
            margin-left: 250px;
        }
        
        .dashboard-title {
            margin-bottom: 20px;
            color: #2c3e50;
        }
        
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 20px;
        }
        
        .card {
            background-color: white;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            transition: transform 0.3s;
        }
        
        .card:hover {
            transform: translateY(-5px);
        }
        
        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
            color: #2c3e50;
        }
        
        @media (max-width: 768px) {
            .main-content.active {
                margin-left: 0;
            }
            
            .sidebar.active {
                width: 100%;
                left: 0;
            }
        }
    </style>
</head>
<body>
    <header class="header">
        <button class="menu-btn" id="menuBtn">☰</button>
        <h2>Teacher Dashboard</h2>
        <button onclick="window.location.href='admin_login.php'" style="margin-left: auto; background: #e74c3c; color: white; border: none; padding: 8px 15px; border-radius: 4px; cursor: pointer;">Logout</button>
    </header>
    
    <aside class="sidebar" id="sidebar">
        <ul class="sidebar-menu">
            <li><a href="my.php">My Class</a></li>
            <li><a href="add.php">Add Student</a></li>
            <li><a href="gfm.php">GFM List</a></li>
            <li><a href="add_gfm.php">Add GFM</a></li>
            <li><a href="remedial.php">Remedial Lectures</a></li>
            <li><a href="add_r.php">Add Remedial Lectures</a></li>
            <li><a href="leave.php">Leave Request</a></li>
            <li><a href="complete.php">Complete Attendance</a></li>
        </ul>
    </aside>
    
    <main class="main-content" id="mainContent">
        <h1 class="dashboard-title">Dashboard Overview</h1>
        
        <div class="dashboard-cards">
            <div class="card">
                <h3 class="card-title">My Class</h3>
                <p>View and manage your class details and student information.</p>
            </div>
            
            <div class="card">
                <h3 class="card-title">GFM Management</h3>
                <p>Access GFM list and add new GFM entries.</p>
            </div>
            
            <div class="card">
                <h3 class="card-title">Remedial Lectures</h3>
                <p>Schedule and manage remedial lectures for students.</p>
            </div>
            
            <div class="card">
                <h3 class="card-title">Attendance</h3>
                <p>Complete and review student attendance records.</p>
            </div>
        </div>
    </main>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuBtn = document.getElementById('menuBtn');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            
            menuBtn.addEventListener('click', function() {
                sidebar.classList.toggle('active');
                mainContent.classList.toggle('active');
            });
            
            // Close sidebar when clicking outside
            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && event.target !== menuBtn) {
                    sidebar.classList.remove('active');
                    mainContent.classList.remove('active');
                }
            });
        });
    </script>
</body>
</html>