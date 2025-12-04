<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Interactive Follow-up System</title>
  
  <!-- Favicon - Browser Tab Logo -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><defs><linearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'><stop offset='0%25' style='stop-color:%232c3e50'/><stop offset='100%25' style='stop-color:%233498db'/></linearGradient></defs><rect fill='url(%23g)' width='100' height='100' rx='20'/><circle cx='35' cy='35' r='8' fill='white'/><circle cx='65' cy='35' r='8' fill='white'/><circle cx='35' cy='65' r='8' fill='white'/><circle cx='65' cy='65' r='8' fill='white'/><line x1='35' y1='35' x2='65' y2='35' stroke='white' stroke-width='3'/><line x1='65' y1='35' x2='65' y2='65' stroke='white' stroke-width='3'/><line x1='65' y1='65' x2='35' y2='65' stroke='white' stroke-width='3'/><line x1='35' y1='65' x2='35' y2='35' stroke='white' stroke-width='3'/><circle cx='50' cy='50' r='6' fill='%2327ae60'/></svg>">
  
  <style>
    /* Reset and Base Styles */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
    }
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

    /* Container Styles */
    .container {
      background: white;
      max-width: 400px;
      margin: 100px auto 60px;
      padding: 30px 25px;
      border-radius: 10px;
      box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
    }
    .container h2 {
      color: #2c3e50;
      font-weight: 700;
      font-size: 24px;
      margin-bottom: 25px;
      text-align: center;
    }

    /* Form Styles */
    form {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }
    input[type="text"],
    input[type="password"] {
      padding: 12px 15px;
      border: 1px solid #ecf0f1;
      border-radius: 8px;
      font-size: 14px;
      transition: border-color 0.3s ease;
    }
    input[type="text"]:focus,
    input[type="password"]:focus {
      border-color: #3498db;
      outline: none;
      box-shadow: 0 0 5px rgba(52, 152, 219, 0.5);
    }

    /* Button Styles */
    button[type="submit"] {
      padding: 14px 0;
      background: #3498db;
      color: white;
      border: none;
      border-radius: 8px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    button[type="submit"]:hover {
      background: #2c3e50;
      transform: translateY(-2px);
    }

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
      .container {
        margin: 90px 15px 40px;
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

  <main class="container" id="login">
    <h2>Login</h2>

    <form method="POST" action="{{ route('login.post') }}">
      @csrf
      <input type="text" name="identifier" placeholder="Student ID/Faculty ID" required />
      <input type="password" name="password" placeholder="Enter your password" required />
      <button type="submit">Login</button>
    </form>

    <!-- Error Display -->
    @if($errors->any())
      <div style="color:red; margin-top: 15px;">
        <ul style="list-style: none;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif
  </main>
</body>
</html>