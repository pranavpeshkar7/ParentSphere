<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Remedial Lecture</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            margin: 0;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        h2 {
            color: #2c3e50;
            margin-bottom: 25px;
            font-size: 28px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        
        form {
            width: 100%;
            max-width: 400px;
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            color: #2c3e50;
            font-weight: 500;
        }
        
        input, select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 6px;
            font-size: 16px;
            transition: all 0.3s;
            box-sizing: border-box;
        }
        
        input:focus, select:focus {
            border-color: #3498db;
            outline: none;
            box-shadow: 0 0 0 3px rgba(52, 152, 219, 0.2);
        }
        
        button {
            background: linear-gradient(to right, #3498db, #2c3e50);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
            margin-top: 10px;
            width: 100%;
        }
        
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .day-buttons {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin-bottom: 15px;
        }
        
        .day-btn {
            flex: 1 0 calc(33.333% - 8px);
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 6px;
            cursor: pointer;
            text-align: center;
            transition: all 0.2s;
        }
        
        .day-btn:hover {
            background: #e9ecef;
        }
        
        .day-btn.selected {
            background: #3498db;
            color: white;
            border-color: #3498db;
        }
    </style>
</head>
<body>
    <h2>Add Remedial Lecture</h2>
    <form action="process_r.php" method="POST">
        <div class="form-group">
            <label for="roll_no">Roll Number</label>
            <input type="text" id="roll_no" name="roll_no" placeholder="Enter roll number" required>
        </div>
        
        <div class="form-group">
            <label for="subject">Subject</label>
            <input type="text" id="subject" name="subject" placeholder="Enter subject" required>
        </div>
        
        <div class="form-group">
            <label for="date">Date</label>
            <input type="date" id="date" name="date" required>
        </div>
        
        <div class="form-group">
            <label>Day</label>
            <div class="day-buttons">
                <div class="day-btn" data-day="Monday">Monday</div>
                <div class="day-btn" data-day="Tuesday">Tuesday</div>
                <div class="day-btn" data-day="Wednesday">Wednesday</div>
                <div class="day-btn" data-day="Thursday">Thursday</div>
                <div class="day-btn" data-day="Friday">Friday</div>
                <div class="day-btn" data-day="Saturday">Saturday</div>
            </div>
            <input type="hidden" id="day" name="day" required>
        </div>
        
        <div class="form-group">
            <label for="time_slot">Time Slot</label>
            <input type="text" id="time_slot" name="time_slot" placeholder="e.g., 10:00 AM - 12:00 PM" required>
        </div>
        
        <button type="submit">Submit</button>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const dayButtons = document.querySelectorAll('.day-btn');
            const dayInput = document.getElementById('day');
            
            // Auto-set day based on selected date
            document.getElementById('date').addEventListener('change', function() {
                const selectedDate = new Date(this.value);
                if (!isNaN(selectedDate.getTime())) {
                    const days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
                    const dayName = days[selectedDate.getDay()];
                    
                    // Update both the hidden input and visual selection
                    dayInput.value = dayName;
                    
                    // Update button states
                    dayButtons.forEach(btn => {
                        btn.classList.remove('selected');
                        if (btn.dataset.day === dayName) {
                            btn.classList.add('selected');
                        }
                    });
                }
            });
            // Manual day selection
            dayButtons.forEach(button => {
                button.addEventListener('click', function() {
                    dayButtons.forEach(btn => btn.classList.remove('selected'));
                    this.classList.add('selected');
                    dayInput.value = this.dataset.day;
                });
            });
        });
    </script>
</body>
</html>