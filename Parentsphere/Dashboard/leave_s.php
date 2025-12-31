<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
            width: 500px;
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin: 12px 0 6px;
            font-size: 16px;
            text-align: left;
        }
        input, textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
        }
        textarea {
            height: 150px; /* Increased the height of the reason box */
            resize: vertical;
        }
        button {
            background: #667eea;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 18px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Leave Request</h2>
        <form action="process_l.php" method="post">
            <label for="roll_no">Roll No:</label>
            <input type="number" id="roll_no" name="roll_no" required>
            
            <label for="date">Select Date:</label>
            <input type="date" id="date" name="date" required>
            
            <label for="reason">Reason:</label>
            <textarea id="reason" name="reason" required></textarea>
            
            <button type="submit">Submit Request</button>
        </form>
    </div>
</body>
</html>
