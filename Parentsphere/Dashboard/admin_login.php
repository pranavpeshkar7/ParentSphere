<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ParentSphere</title>
    <style>
        /* Header and Background Styles from index.html */
        body {
            font-family: Arial, sans-serif;
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
            height: 30px;
            margin-right: 10px;
        }
        
        .logo-text {
            font-size: 1.5em;
            font-weight: bold;
        }
        
        .logo-text .parent {
            color: #0f172f;
        }
        
        .logo-text .sphere {
            color: #09b6e5;
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

        /* Original Login Page Styles */
        :root {
            --primary-color: #4361ee;
            --primary-hover: #3a56d4;
            --error-color: #f72585;
            --success-color: #4cc9f0;
            --text-color: #2b2d42;
            --light-gray: #f8f9fa;
            --border-radius: 12px;
            --box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }
        
        main {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: var(--border-radius);
            width: 380px;
            box-shadow: var(--box-shadow);
            text-align: center;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transform: translateY(0);
            transition: var(--transition);
            margin: 20px 0;
        }
        
        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        
        .logo {
            width: 60px;
            height: 60px;
            margin: 0 auto 1.5rem;
            background-color: var(--primary-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.8rem;
            font-weight: bold;
        }
        
        .login-container h2 {
            margin-bottom: 1.8rem;
            color: var(--text-color);
            font-weight: 600;
            font-size: 1.8rem;
        }
        
        .input-group {
            margin-bottom: 1.5rem;
            text-align: left;
            position: relative;
        }
        
        .input-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--text-color);
            font-size: 0.9rem;
            font-weight: 500;
        }
        
        .input-group input {
            width: 100%;
            padding: 0.9rem 1.2rem;
            border: 2px solid #e9ecef;
            border-radius: var(--border-radius);
            background-color: var(--light-gray);
            font-size: 1rem;
            transition: var(--transition);
        }
        
        .input-group input:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: white;
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .input-group input::placeholder {
            color: #adb5bd;
        }
        
        .login-btn {
            width: 100%;
            padding: 1rem;
            background-color: var(--primary-color);
            border: none;
            border-radius: var(--border-radius);
            color: white;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            margin-top: 0.5rem;
        }
        
        .login-btn:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }
        
        .login-btn:active {
            transform: translateY(0);
        }
        
        .forgot-password {
            display: block;
            margin-top: 1.5rem;
            color: var(--primary-color);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }
        
        .forgot-password:hover {
            text-decoration: underline;
        }
        
        .error-message {
            color: var(--error-color);
            font-size: 0.9rem;
            margin-top: 0.5rem;
            display: none;
        }
        
        footer {
            text-align: center;
            padding: 15px;
            background-color: rgba(0, 77, 153, 0.8);
            color: white;
        }
        
        @media (max-width: 480px) {
            .login-container {
                width: 90%;
                padding: 1.5rem;
            }
            
            header {
                flex-direction: column;
                padding: 15px;
            }
            
            nav ul {
                margin-top: 15px;
                flex-wrap: wrap;
                justify-content: center;
            }
            
            nav ul li {
                margin: 5px 10px;
            }
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
        <div class="login-container">
            <div class="logo">PS</div>
            <h2>Teacher Login</h2>
            
            <!-- Email Field -->
            <div class="input-group">
                <label for="email">Email Address</label>
                <input type="email" id="email" placeholder="teacher@parentsphere.com" required>
                <div class="error-message" id="email-error">Please enter a valid email address</div>
            </div>
            
            <!-- Password Field -->
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" placeholder="Enter your password" required>
                <div class="error-message" id="password-error">Password must be at least 6 characters</div>
            </div>
            
            <!-- Login Button -->
            <button class="login-btn" type="button" onclick="login()">Sign In</button>
            
            <a href="#" class="forgot-password">Forgot password?</a>
        </div>
    </main>
    
    <footer>
        <p>&copy; 2025 ParentSphere. All rights reserved.</p>
    </footer>

    <script>
        function login() {
            // Clear previous error messages
            document.getElementById('email-error').style.display = 'none';
            document.getElementById('password-error').style.display = 'none';
            
            // Get input values
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            
            // Input validation
            let isValid = true;
            
            if (!email || !email.includes('@') || !email.includes('.')) {
                document.getElementById('email-error').style.display = 'block';
                isValid = false;
            }
            
            if (!password || password.length < 6) {
                document.getElementById('password-error').style.display = 'block';
                isValid = false;
            }
            
            if (!isValid) return;
            
            // Example credentials for testing
            var validEmail = "parentsphere@gmail.com";
            var validPassword = "hello123";
            
            // Show loading state
            const loginBtn = document.querySelector('.login-btn');
            loginBtn.textContent = 'Signing in...';
            loginBtn.disabled = true;
            
            // Simulate API call delay
            setTimeout(function() {
                if (email === validEmail && password === validPassword) {
                    // Success state
                    loginBtn.textContent = 'Success! Redirecting...';
                    loginBtn.style.backgroundColor = '#4cc9f0';
                    
                    setTimeout(function() {
                        window.location.href = "dash.php";
                    }, 1000);
                } else {
                    // Error state
                    loginBtn.textContent = 'Sign In';
                    loginBtn.disabled = false;
                    alert("Invalid Email or Password!");
                }
            }, 1000);
        }
        
        // Add keyboard support (Enter key to submit)
        document.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                login();
            }
        });
    </script>
</body>
</html>