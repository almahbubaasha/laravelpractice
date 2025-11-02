
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Interactive Follow-up System</title>
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
    /* Navigation Styles */
    .nav {
      margin-top: 70px;
      background: white;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
      padding: 15px 0;
      text-align: center;
      border-radius: 0 0 10px 10px;
      max-width: 400px;
      margin-left: auto;
      margin-right: auto;
    }
    .nav a {
      margin: 0 20px;
      text-decoration: none;
      color: #3498db;
      font-weight: 600;
      font-size: 16px;
      transition: color 0.3s ease;
    }
    .nav a:hover {
      color: #2c3e50;
    }

    /* Container Styles */
    .container {
      background: white;
      max-width: 400px;
      margin: 40px auto 60px;
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

    /* Responsive */
    @media (max-width: 480px) {
      .container {
        margin: 20px 15px 40px;
      }
      .nav a {
        margin: 0 10px;
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <header class="header">Interactive Follow-up and Query System</header>

  <nav class="nav">
    <a href="#home">Home</a>
    <a href="#login">Login</a>
  </nav>

  <main class="container" id="login">
    <h2>Login</h2>
    {{-- <form>
      <input type="number" placeholder="Student ID/Faculty ID" required />
      <input type="password" placeholder="Enter your password" required />
      <button type="submit">Login</button>
    </form> --}}

    <form method="POST" action="{{ route('login.post') }}">
    @csrf
    <input type="text" name="identifier" placeholder="Student ID/Faculty ID" required />
    <input type="password" name="password" placeholder="Enter your password" required />
    <button type="submit">Login</button>
</form>

<!-- Error Display -->
{{-- @if($errors->any())
    <div style="color:red;">
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif --}}




  </main>
</body>
</html>
