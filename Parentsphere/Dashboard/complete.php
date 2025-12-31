<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Complete Attendance - ParentSphere</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #74ebd5, #acb6e5);
            display: flex;
            height: 100vh;
            margin: 0;
        }
        .sidebar {
            width: 20%;
            background-color: #0056b3;
            color: white;
            display: flex;
            flex-direction: column;
            padding: 20px;
            box-sizing: border-box;
        }
        .sidebar h2 {
            text-align: center;
            margin-bottom: 30px;
        }
        .sidebar ul {
            list-style: none;
            padding: 0;
        }
        .sidebar ul li {
            padding: 15px;
            margin-bottom: 10px;
            background-color: #34495E;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
        }
        .sidebar ul li:hover {
            background-color: #1ABC9C;
        }
        .main-content {
            width: 80%;
            padding: 20px;
            box-sizing: border-box;
            overflow-y: auto;
            background: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            width: 80%;
            text-align: center;
        }
        .month-box {
            display: inline-block;
            width: 200px;
            padding: 15px;
            border: 2px solid #333;
            border-radius: 10px;
            margin: 10px;
            background: #f9f9f9;
            cursor: pointer;
            transition: transform 0.2s, background 0.3s;
        }
        .month-box:hover {
            background: #e3e3e3;
            transform: scale(1.05);
        }
        .month-box h3 {
            margin: 0;
            font-size: 18px;
            text-decoration: underline;
        }
        .days-container {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            padding: 10px;
            justify-content: center;
        }
        .day-box {
            width: 25px;
            height: 25px;
            border-radius: 5px;
            display: inline-block;
        }
        .present { background: green; }
        .absent { background: red; }
        #content-display {
            flex-grow: 1;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .sidebar-btn {
            width: 100%;
            padding: 15px;
            background-color: #2C3E50;
            border: none;
            color: white;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            text-align: center;
            transition: background 0.3s, transform 0.2s;
        }
        .sidebar-btn:hover {
            background-color: #1ABC9C;
            transform: scale(1.05);
        }
    </style>
    <script>
        function showAttendance() {
            document.getElementById("content-display").innerHTML = `
                <div class='container'>
                    <h2>Complete Attendance</h2>
                    <div class='month-box' data-sheet-url="https://docs.google.com/spreadsheets/d/1BrO4xbm8TWi-ujVahZGa9nQGfP36O2K6/edit">
                        <h3>January</h3>
                        <div class='days-container'>${generateDays(31)}</div>
                    </div>
                    <div class='month-box' data-sheet-url="https://docs.google.com/spreadsheets/d/1oYPK9w_8RZdzF_xNvqaMTMztlKAeO6bk/edit">
                        <h3>February</h3>
                        <div class='days-container'>${generateDays(28)}</div>
                    </div>
                    <div class='month-box' data-sheet-url="https://docs.google.com/spreadsheets/d/1sbraMGjOmch6HHOWWShLgvnNgdQtvtsc/edit">
                        <h3>March</h3>
                        <div class='days-container'>${generateDays(31)}</div>
                    </div>
                </div>`;
        }
        function generateDays(count) {
            let daysHTML = '';
            for (let i = 0; i < count; i++) {
                let status = Math.random() > 0.3 ? 'present' : 'absent';
                daysHTML += `<div class="day-box ${status}"></div>`;
            }
            return daysHTML;
        }
        document.addEventListener("click", function(event) {
            let monthBox = event.target.closest(".month-box");
            if (monthBox) {
                let sheetURL = monthBox.getAttribute("data-sheet-url");
                if (sheetURL) {
                    window.open(sheetURL, '_blank');
                }
            }
        });
        window.onload = function() {
            showAttendance();
        };
    </script>
</head>
<body>
    <div id="content-display"></div>
</body>
</html>