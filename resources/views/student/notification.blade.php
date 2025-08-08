
@extends('student.layout')
@push('styles')
<title>Notifications</title>
  <style>
    /* Reset & base */
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
      max-width: 700px;
      margin: 0 auto;
      border-radius: 10px;
      box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
      padding: 30px 25px;
      box-sizing: border-box;
      text-align: left;
    }

    h2 {
      font-size: 28px;
      color: #2c3e50;
      margin-bottom: 15px;
      font-weight: 600;
      text-align: center;
    }

    #role-info {
      font-size: 16px;
      color: #7f8c8d;
      margin-bottom: 25px;
      text-align: center;
    }

    /* Form */
    form {
      margin-bottom: 30px;
    }

    textarea {
      width: 100%;
      min-height: 100px;
      padding: 12px 15px;
      border: 1px solid #ecf0f1;
      border-radius: 10px;
      font-size: 16px;
      resize: vertical;
      font-family: inherit;
      color: #2c3e50;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
      transition: border-color 0.3s ease;
    }

    textarea:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 6px #3498db;
    }

    .btn {
      background: #3498db;
      color: white;
      border: none;
      padding: 14px 20px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 10px;
      cursor: pointer;
      /* width: auto; */
      transition: background-color 0.3s ease;
      box-shadow: 0 2px 6px rgba(0,0,0,0.1);
      text-decoration: none;
    }

    a.btn:hover {
      background: #2c80bd;
    }

    /* Notifications List */
    .notifications h3 {
      font-size: 20px;
      color: #2c3e50;
      margin-bottom: 15px;
      font-weight: 600;
      text-align: left;
    }

    ul#notificationList {
      list-style: none;
      padding: 0;
      margin: 0;
      max-height: 300px;
      overflow-y: auto;
    }

    .notification-item {
      background: #fff;
      padding: 15px 20px;
      margin-bottom: 12px;
      border-left: 5px solid #3498db;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
      display: flex;
      justify-content: space-between;
      align-items: center;
      border-radius: 8px;
      font-size: 15px;
      color: #2c3e50;
      transition: background-color 0.2s ease;
    }

    .notification-item:hover {
      background-color: #f0f4fb;
    }

    .delete-btn {
      background: #e74c3c;
      color: white;
      border: none;
      border-radius: 6px;
      padding: 6px 12px;
      cursor: pointer;
      font-weight: 600;
      transition: background 0.3s ease;
      font-size: 13px;
    }

    .delete-btn:hover {
      background: #c0392b;
    }

    /* Responsive */
    @media (max-width: 600px) {
      .container {
        padding: 25px 15px;
      }
      h2 {
        font-size: 24px;
      }
      a.btn {
        padding: 12px 16px;
        font-size: 14px;
      }
      .notification-item {
        font-size: 14px;
      }
    }
  </style>
@endpush



@section('content')
 <div class="header">Notifications</div>

  <div class="container">
    <h2>Notifications</h2>
    <p id="role-info">Role: <span id="userRole">Teacher/Student</span></p>

    <!-- Teacher Section -->
    <div id="teacher-section">
      <h3>Send Notification</h3>
      
      <form id="notificationForm">
        <textarea id="notificationText" placeholder="Enter notification message..." required></textarea>
        <button class="btn" type="submit"> Send Notification</button>
      </form>



 <li class="notification-item">
    <span>New assignment uploaded.</span>
    <button class="delete-btn">Delete</button>
  </li>

    </div>

    <!-- Notification List -->
    <div class="notifications">
      <h3>All Notifications</h3>
      <ul id="notificationList">
        <li>No notifications yet.</li>
      </ul>
    </div>
  </div>
@endsection



