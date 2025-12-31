<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <style>
        body {
            font-family: 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            color: #343a40;
        }
        form {
            background: white;
            padding: 30px;
            width: 100%;
            max-width: 450px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            border-radius: 12px;
            display: flex;
            flex-direction: column;
            align-items: center;
            max-height: 90vh;
            overflow-y: auto;
        }
        label {
            width: 100%;
            text-align: left;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: 600;
            color: #495057;
            font-size: 14px;
        }
        input, select {
            width: 100%;
            padding: 12px;
            margin-top: 3px;
            border: 1px solid #e0e0e0;
            border-radius: 6px;
            font-size: 14px;
            box-sizing: border-box;
            transition: border 0.2s, box-shadow 0.2s;
            background-color: #f8f9fa;
        }
        input:focus, select:focus {
            outline: none;
            border-color: #4dabf7;
            box-shadow: 0 0 0 3px rgba(77, 171, 247, 0.2);
            background-color: white;
        }
        button {
            margin-top: 25px;
            background-color: #2f9e44;
            color: white;
            border: none;
            padding: 12px;
            width: 100%;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            border-radius: 6px;
            transition: background 0.2s ease-in-out, transform 0.1s;
            letter-spacing: 0.5px;
        }
        button:hover {
            background-color: #2b8a3e;
        }
        button:active {
            transform: scale(0.98);
        }
        .form-group {
            width: 100%;
            margin-bottom: 5px;
        }
    </style>
</head>
<body>
<form action="process.php" method="post">
    <div class="form-group">
        <label>Name:</label>
        <input type="text" name="name" required>
    </div>
    <div class="form-group">
        <label>Roll No:</label>
        <input type="number" name="roll_no" required>
    </div>
    <div class="form-group">
        <label>Attendance:</label>
        <input type="text" name="attendance" required>
    </div>
    <div class="form-group">
        <label>M3:</label>
        <input type="text" name="m3" required>
    </div>
    <div class="form-group">
        <label>DSA:</label>
        <input type="text" name="dsa" required>
    </div>
    <div class="form-group">
        <label>MP:</label>
        <input type="text" name="mp" required>
    </div>
    <div class="form-group">
        <label>SE:</label>
        <input type="text" name="se" required>
    </div>
    <div class="form-group">
        <label>PPL:</label>
        <input type="text" name="ppl" required>
    </div>
    <div class="form-group">
        <label>Leave Request:</label>
        <select name="leave_request">
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>
    </div>
    <button type="submit">Add Student</button>
</form>
</body>
</html>