<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - Interactive Follow-up System</title>
  
  <!-- Favicon - Browser Tab Logo -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><defs><linearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'><stop offset='0%25' style='stop-color:%232c3e50'/><stop offset='100%25' style='stop-color:%233498db'/></linearGradient></defs><rect fill='url(%23g)' width='100' height='100' rx='20'/><circle cx='35' cy='35' r='8' fill='white'/><circle cx='65' cy='35' r='8' fill='white'/><circle cx='35' cy='65' r='8' fill='white'/><circle cx='65' cy='65' r='8' fill='white'/><line x1='35' y1='35' x2='65' y2='35' stroke='white' stroke-width='3'/><line x1='65' y1='35' x2='65' y2='65' stroke='white' stroke-width='3'/><line x1='65' y1='65' x2='35' y2='65' stroke='white' stroke-width='3'/><line x1='35' y1='65' x2='35' y2='35' stroke='white' stroke-width='3'/><circle cx='50' cy='50' r='6' fill='%2327ae60'/></svg>">
  
  <style>
    /* Login page er moto style copy kora */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    
    /* Header Styles */
    .header {
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      color: white;
      padding: 0 20px;
      height: 70px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      font-size: 24px;
      font-weight: 600;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
    }

    .header-title {
      flex: 1;
      text-align: center;
    }

    /* Home Button in Header */
    .home-button {
      padding: 10px 20px;
      background: rgba(255, 255, 255, 0.2);
      color: white;
      border: 2px solid white;
      border-radius: 8px;
      font-size: 15px;
      font-weight: 600;
      cursor: pointer;
      text-decoration: none;
      display: inline-flex;
      align-items: center;
      gap: 8px;
      transition: all 0.3s ease;
    }
    .home-button:hover {
      background: white;
      color: #2c3e50;
      transform: translateY(-2px);
    }
    .home-button::before {
      content: "←";
      font-size: 18px;
    }
    
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
      padding-top: 70px;
    }
    .container {
      background: white;
      width: 100%;
      max-width: 400px;
      padding: 30px 25px;
      border-radius: 10px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.1);
      margin: 20px;
    }
    h2 {
      text-align: center;
      margin-bottom: 25px;
      color: #2c3e50;
    }
    form { display: flex; flex-direction: column; gap: 15px; }
    input, select {
      padding: 12px 15px;
      border: 1px solid #ecf0f1;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }
    input:focus, select:focus {
      border-color: #3498db;
      outline: none;
      box-shadow: 0 0 5px rgba(52,152,219,0.5);
    }
    button[type="submit"] {
      padding: 14px 0;
      background: #3498db;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background 0.3s ease, transform 0.2s ease;
    }
    button[type="submit"]:hover {
      background: #2c3e50;
      transform: translateY(-2px);
    }
    p { text-align: center; margin-top: 10px; }
    a { color: #3498db; text-decoration: none; font-weight: 600; }
    a:hover { color: #2c3e50; }

    /* Responsive */
    @media (max-width: 480px) {
      .header {
        font-size: 16px;
        padding: 0 10px;
      }
      .home-button {
        padding: 8px 15px;
        font-size: 13px;
      }
    }
  </style>
</head>
<body>

  <header class="header">
    <a href="{{ route('home') }}" class="home-button">
      Back to Home
    </a>
    <div class="header-title">Interactive Follow-up and Query System</div>
  </header>

  <div class="container">
    <h2>Register</h2>
    <form method="POST" action="{{ route('register.post') }}">
      @csrf
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="text" name="identifier" placeholder="Student/Faculty ID" required>
      <input type="password" name="password" placeholder="Password" required>
      <select name="role" required>
        <option value="">Select Role</option>
        <option value="student">Student</option>
        <option value="teacher">Teacher</option>
      </select>
      <button type="submit">Register</button>
    </form>
    <p>
      Already have an account? <a href="{{ route('login') }}">Login here</a>
    </p>
  </div>
</body>
</html>