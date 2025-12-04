<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Research Follow-up System</title>
  
  <!-- Favicon - Browser Tab Logo -->
  <link rel="icon" type="image/svg+xml" href="data:image/svg+xml,<svg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 100 100'><defs><linearGradient id='g' x1='0%25' y1='0%25' x2='100%25' y2='100%25'><stop offset='0%25' style='stop-color:%232c3e50'/><stop offset='100%25' style='stop-color:%233498db'/></linearGradient></defs><rect fill='url(%23g)' width='100' height='100' rx='20'/><circle cx='35' cy='35' r='8' fill='white'/><circle cx='65' cy='35' r='8' fill='white'/><circle cx='35' cy='65' r='8' fill='white'/><circle cx='65' cy='65' r='8' fill='white'/><line x1='35' y1='35' x2='65' y2='35' stroke='white' stroke-width='3'/><line x1='65' y1='35' x2='65' y2='65' stroke='white' stroke-width='3'/><line x1='65' y1='65' x2='35' y2='65' stroke='white' stroke-width='3'/><line x1='35' y1='65' x2='35' y2='35' stroke='white' stroke-width='3'/><circle cx='50' cy='50' r='6' fill='%2327ae60'/></svg>">
  
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
      gap: 15px;
      font-size: 24px;
      font-weight: 600;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      z-index: 1000;
      padding: 0 20px;
    }

    /* Logo in Header */
    .header-logo {
      width: 50px;
      height: 50px;
      background: white;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
      flex-shrink: 0;
    }

    .header-logo svg {
      width: 35px;
      height: 35px;
    }

    .header-title {
      flex: 1;
      text-align: center;
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

    /* Responsive */
    @media (max-width: 768px) {
      .header {
        font-size: 16px;
        gap: 10px;
      }
      .header-logo {
        width: 40px;
        height: 40px;
      }
      .header-logo svg {
        width: 28px;
        height: 28px;
      }
    }

    @media (max-width: 480px) {
      .header {
        font-size: 14px;
      }
    }
  </style>
</head>
<body>
  <div class="header">
    <div class="header-logo">
      <!-- Follow-up & Query Network Icon -->
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="#3498db" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
        <!-- Connected nodes representing follow-up system -->
        <circle cx="6" cy="6" r="3" fill="#3498db"/>
        <circle cx="18" cy="6" r="3" fill="#3498db"/>
        <circle cx="6" cy="18" r="3" fill="#3498db"/>
        <circle cx="18" cy="18" r="3" fill="#3498db"/>
        <!-- Connection lines -->
        <line x1="6" y1="6" x2="18" y2="6" stroke="#2c3e50" stroke-width="2"/>
        <line x1="18" y1="6" x2="18" y2="18" stroke="#2c3e50" stroke-width="2"/>
        <line x1="18" y1="18" x2="6" y2="18" stroke="#2c3e50" stroke-width="2"/>
        <line x1="6" y1="18" x2="6" y2="6" stroke="#2c3e50" stroke-width="2"/>
        <!-- Center query point -->
        <circle cx="12" cy="12" r="2.5" fill="#27ae60"/>
      </svg>
    </div>
    <span class="header-title">Interactive Follow-up & Query System For Research Management</span>
  </div>

  <div class="home-container">
    <h2>Welcome to the Research Follow-up & Query System</h2>
    <p>
      Stay connected with your supervisor, submit queries, and manage research
      tasks efficiently.
    </p>

    <a href="{{ route('register') }}">
      <button class="cta-button">Get Started</button>
    </a>
  </div>
</body>
</html>