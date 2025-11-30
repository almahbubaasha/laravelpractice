<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Research Follow-up System</title>
  <style>
    /* Reset and base */
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
      display: flex;
      flex-direction: column;
      align-items: center;
      padding: 100px 20px 40px;
    }

    /* Header */
    .header {
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      font-weight: 600;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
    }

    /* Container */
    .home-container {
      background: white;
      max-width: 800px;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 40px 30px;
      text-align: center;
    }

    .home-container h2 {
      color: #2c3e50;
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    .home-container p {
      color: #7f8c8d;
      font-size: 16px;
      margin-bottom: 30px;
    }

    .cta-button {
      background: #3498db;
      color: white;
      font-weight: 600;
      font-size: 18px;
      padding: 12px 30px;
      border: none;
      border-radius: 10px;
      cursor: pointer;
      text-decoration: none;
      display: inline-block;
      transition: background 0.3s ease;
    }

    .cta-button:hover {
      background: #2c80bd;
    }

    
  </style>
</head>
<body>
  <div class="header">
    Interactive Follow-up & Query System For Research Management
  </div>

  <div class="home-container">
    <h2>Welcome to the Research Follow-up & Query System</h2>
    <p>
      Stay connected with your supervisor, submit queries, and manage research
      tasks efficiently.
    </p>
    <!-- <a href="login.html" class="cta-button">Get Started</a> -->

    <a href="{{ route('register') }}">
    <button class="cta-button">Get Started</button>
</a>

  </div>
</body>
</html>
