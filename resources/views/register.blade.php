<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Register - Interactive Follow-up System</title>
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
      justify-content: center;
      font-size: 24px;
      font-weight: 600;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 1000;
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
    }
    .container {
      background: white;
      width: 100%;
      max-width: 400px;
      padding: 30px 25px;
      border-radius: 10px;
      box-shadow: 0 2px 15px rgba(0,0,0,0.1);
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
    button {
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
    button:hover {
      background: #2c3e50;
      transform: translateY(-2px);
    }
    p { text-align: center; margin-top: 10px; }
    a { color: #3498db; text-decoration: none; font-weight: 600; }
    a:hover { color: #2c3e50; }
  </style>
</head>
<body>

    <header class="header">Interactive Follow-up and Query System</header>

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
