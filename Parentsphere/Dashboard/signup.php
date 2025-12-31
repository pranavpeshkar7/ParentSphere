<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - ParentSphere</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background: url('/images/background.webp') no-repeat center center fixed;
            background-size: cover;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: rgba(0, 77, 153, 0.8);
            color: white;
            padding: 15px 20px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .logo-container {
            display: flex;
            align-items: center;
        }
        
        .logo-container img {
            height: 30px; /* Small logo size */
            margin-right: 10px;
        }
        
        .logo-text {
            font-size: 1.5em;
            font-weight: bold;
        }
        
        .logo-text .parent {
            color: #0f172f; /* Darker blue for "Parents" */
        }
        
        .logo-text .sphere {
            color: #09b6e5; /* Light blue for "phere" */
        }
        
        nav ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
        }
        
        nav ul li {
            margin: 0 15px;
        }
        
        nav ul li a {
            text-decoration: none;
            color: white;
            font-size: 1em;
            transition: color 0.3s;
        }
        
        nav ul li a:hover {
            color: #211da8;
        }
        
        :root {
            --primary-color: #4a6fa5;
            --secondary-color: #6b8cae;
            --accent-color: #ff7e5f;
            --light-color: #f8f9fa;
            --dark-color: #343a40;
            --success-color: #28a745;
        }
        
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            padding: 2.5rem;
            width: 100%;
            max-width: 400px;
            transition: transform 0.3s ease;
            margin: 20px 0;
        }
        
        .container:hover {
            transform: translateY(-5px);
        }
        
        h2 {
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 1.5rem;
            font-weight: 600;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark-color);
        }
        
        input, select {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        input:focus, select:focus {
            border-color: var(--primary-color);
            outline: none;
            box-shadow: 0 0 0 3px rgba(74, 111, 165, 0.2);
        }
        
        button {
            width: 100%;
            padding: 0.75rem;
            background-color: var(--primary-color);
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 500;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }
        
        button:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .login-link {
            text-align: center;
            margin-top: 1.5rem;
            color: var(--dark-color);
        }
        
        .login-link a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .login-link a:hover {
            color: var(--accent-color);
            text-decoration: underline;
        }
        
        .password-hint {
            font-size: 0.8rem;
            color: #6c757d;
            margin-top: 0.25rem;
        }
        
        footer {
            text-align: center;
            padding: 15px;
            background-color: rgba(0, 77, 153, 0.8);
            color: white;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-container">
            <img src="/images/ParentSphere.jpg" alt="Small Logo">
            <div class="logo-text">
                <span class="parent">Parents</span><span class="sphere">phere</span>
            </div>
        </div>
        <nav>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="admin_login.php">Teacher Login</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="contact.html">Contact Us</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="container">
            <h2>Join ParentSphere</h2>
            <form action="process_sl.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required placeholder="your@email.com">
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required placeholder="••••••••">
                    <p class="password-hint">Use at least 8 characters with a mix of letters and numbers</p>
                </div>
                
                <div class="form-group">
                    <label for="role">I am a</label>
                    <select id="role" name="role">
                        <option value="Student">Student</option>
                        <option value="Parent">Parent</option>
                    </select>
                </div>
                
                <button type="submit" name="signup">Create Account</button>
            </form>
            <p class="login-link">Already have an account? <a href="login.php">Log in here</a></p>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2025 ParentSphere. All rights reserved.</p>
    </footer>
</body>
</html>