@extends('student.layout')

@push('styles')
<title>Logout</title>
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
      text-align: center;
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
    .container {
      background: white;
      max-width: 500px;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 40px 30px;
      box-sizing: border-box;
    }

    h2 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #2c3e50;
      font-weight: 600;
    }

    #role-info {
      font-size: 16px;
      margin-bottom: 10px;
      color: #7f8c8d;
    }

    #logout-message {
      font-size: 18px;
      margin-bottom: 30px;
      color: #2c3e50;
    }

    button {
      width: 100%;
      padding: 14px 0;
      font-size: 16px;
      font-weight: 600;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
      margin-bottom: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    #logoutBtn {
      background: #3498db;
      color: white;
    }

    #logoutBtn:hover {
      background: #2c80bd;
    }

    #cancelBtn {
      background: #e74c3c;
      color: white;
    }

    #cancelBtn:hover {
      background: #c0392b;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .container {
        padding: 30px 20px;
      }

      h2 {
        font-size: 24px;
      }

      #logout-message {
        font-size: 16px;
      }
    }
  </style>
@endpush



@section('content')
  <div class="header">Logout</div>

  <div class="container">
    <h2>Logout</h2>
    <p id="role-info">Role: <span id="userRole">Student</span></p>

    <p id="logout-message">
      Are you sure you want to log out, <span id="userName">Almahbuba</span>?
    </p>

    <a href="{{ route('logout') }}">
    <button id="logoutBtn">Logout</button>
</a>

    <button id="cancelBtn">Cancel</button>
  </div>
@endsection









{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Logout</title>
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
      text-align: center;
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
    .container {
      background: white;
      max-width: 500px;
      width: 100%;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      padding: 40px 30px;
      box-sizing: border-box;
    }

    h2 {
      font-size: 28px;
      margin-bottom: 20px;
      color: #2c3e50;
      font-weight: 600;
    }

    #role-info {
      font-size: 16px;
      margin-bottom: 10px;
      color: #7f8c8d;
    }

    #logout-message {
      font-size: 18px;
      margin-bottom: 30px;
      color: #2c3e50;
    }

    button {
      width: 100%;
      padding: 14px 0;
      font-size: 16px;
      font-weight: 600;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      transition: background 0.3s ease;
      margin-bottom: 15px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    }

    #logoutBtn {
      background: #3498db;
      color: white;
    }

    #logoutBtn:hover {
      background: #2c80bd;
    }

    #cancelBtn {
      background: #e74c3c;
      color: white;
    }

    #cancelBtn:hover {
      background: #c0392b;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .container {
        padding: 30px 20px;
      }

      h2 {
        font-size: 24px;
      }

      #logout-message {
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
  <div class="header">Logout</div>

  <div class="container">
    <h2>Logout</h2>
    <p id="role-info">Role: <span id="userRole">Student</span></p>

    <p id="logout-message">
      Are you sure you want to log out, <span id="userName">Almahbuba</span>?
    </p>

    <a href="{{ route('logout') }}">
    <button id="logoutBtn">Logout</button>
</a>

    <button id="cancelBtn">Cancel</button>
  </div>
</body>
</html> --}}
