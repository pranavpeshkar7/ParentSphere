<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Requests</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f5f7fa;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 20px;
        }
        .leave-box {
            background: white;
            border-radius: 12px;
            padding: 20px;
            margin: 15px 0;
            width: 60%;
            min-width: 350px;
            word-wrap: break-word;
            position: relative;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            border-left: 4px solid #4a6bff;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }
        .leave-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.12);
        }
        .header {
            display: flex;
            justify-content: space-between;
            font-weight: 600;
            font-size: 16px;
            color: #4a6bff;
            margin-bottom: 12px;
        }
        .reason-container {
            margin: 15px 0 8px 0;
            font-weight: 600;
            color: #555;
        }
        .reason {
            background: #f8f9ff;
            color: #333;
            padding: 12px;
            border-radius: 8px;
            font-size: 14px;
            display: block;
            max-width: 100%;
            white-space: normal;
            word-wrap: break-word;
            overflow-wrap: break-word;
            border: 1px solid #e0e4ff;
            line-height: 1.5;
        }
        .dropdown {
            position: relative;
            display: inline-block;
        }
        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            background-color: white;
            min-width: 120px;
            box-shadow: 0px 4px 12px rgba(0,0,0,0.15);
            z-index: 1;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid #eee;
        }
        .dropdown-content button {
            color: #555;
            padding: 10px 12px;
            text-decoration: none;
            display: block;
            width: 100%;
            text-align: left;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.2s ease;
        }
        .dropdown-content button:hover {
            background-color: #f5f7ff;
            color: #4a6bff;
        }
        .dots {
            cursor: pointer;
            padding: 0 8px;
            color: #888;
            font-weight: bold;
            font-size: 18px;
            user-select: none;
        }
        .dots:hover {
            color: #4a6bff;
        }
        .date-container {
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .date-container span {
            color: #666;
            font-weight: normal;
        }
    </style>
</head>
<body>
<?php
// Handle delete request
if (isset($_GET['delete'])) {
    $conn = new mysqli("localhost", "root", "", "parentsphere");
    $id = $_GET['delete'];
    $sql = "DELETE FROM leave_request WHERE roll_no = ? AND date = ?";
    $stmt = $conn->prepare($sql);
    
    // Split the ID into roll_no and date parts
    $parts = explode('|', $id);
    $roll_no = $parts[0];
    $date = $parts[1];
    
    $stmt->bind_param("ss", $roll_no, $date);
    $stmt->execute();
    $stmt->close();
    $conn->close();
    
    // Redirect to refresh the page
    header("Location: leave.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "parentsphere");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT roll_no, date, reason FROM leave_request ORDER BY date DESC";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<div class='leave-box'>";
        echo "<div class='header'>";
        echo "<span>Roll No: " . $row['roll_no'] . "</span>";
        
        // Date with dropdown menu
        echo "<div class='date-container'>";
        echo "<span>Date: " . date("d/m/Y", strtotime($row['date'])) . "</span>";
        echo "<div class='dropdown'>";
        echo "<span class='dots' onclick='toggleDropdown(this)'>⋯</span>";
        echo "<div class='dropdown-content'>";
        $delete_id = $row['roll_no'] . "|" . $row['date'];
        echo "<button onclick=\"deleteEntry('$delete_id')\">Delete</button>";
        echo "</div>";
        echo "</div>";
        echo "</div>";
        
        echo "</div>";
        echo "<div class='reason-container'><strong>Reason:</strong></div>";
        echo "<div class='reason'>" . htmlspecialchars($row['reason']) . "</div>";
        echo "</div>";
    }
} else {
    echo "<p>No leave requests available.</p>";
}
$conn->close();
?>

<script>
    function toggleDropdown(element) {
        // Close all other dropdowns first
        var dropdowns = document.getElementsByClassName("dropdown-content");
        for (var i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown !== element.nextElementSibling && openDropdown.style.display === "block") {
                openDropdown.style.display = "none";
            }
        }
        
        // Toggle the clicked dropdown
        var dropdown = element.nextElementSibling;
        dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
    }

    function deleteEntry(id) {
        if (confirm("Are you sure you want to delete this entry?")) {
            window.location.href = "leave.php?delete=" + encodeURIComponent(id);
        }
    }

    // Close dropdowns when clicking outside
    window.onclick = function(event) {
        if (!event.target.matches('.dots')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            for (var i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.style.display === "block") {
                    openDropdown.style.display = "none";
                }
            }
        }
    }
</script>
</body>
</html>