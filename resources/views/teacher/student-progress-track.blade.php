
@extends('teacher.layout')

@push('styles')

<title>Student Progress Tracking</title>
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
    }

    /* Main content */
    .main-content {
      margin-left: 250px;
      margin-top: 70px;
      padding: 25px 30px;
      min-height: calc(100vh - 70px);
    }

    /* Role Info */
    .role-info {
      font-size: 14px;
      margin-bottom: 25px;
      font-weight: 600;
      color: #7f8c8d;
    }

    /* Card */
    .card {
      background: white;
      border-radius: 10px;
      padding: 25px 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      border: 1px solid #ecf0f1;
      margin-bottom: 25px;
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      border: 1px solid #ecf0f1;
      padding: 12px 15px;
      text-align: center;
      font-size: 14px;
      color: #2c3e50;
    }
    th {
      background: #3498db;
      color: white;
      font-weight: 600;
    }

    /* Progress bar container */
    .progress-container {
      background: #ecf0f1;
      border-radius: 8px;
      width: 100%;
      height: 15px;
      overflow: hidden;
    }

    /* Actual progress bar */
    .progress-bar {
      height: 100%;
      border-radius: 8px;
      background: #27ae60;
      width: 0%; /* will be inline style */
      transition: width 0.5s ease;
    }

    /* Feedback text */
    .feedback {
      font-size: 13px;
      color: #7f8c8d;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 20px;
      }
      .sidebar {
        display: none;
      }
    }
  </style>

@endpush


@section('content')

  <main class="main-content">
    <p class="role-info">Role: <strong>Teacher</strong></p>

    <section class="card">
      <h3>Student Progress Overview</h3>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Completed Tasks</th>
            <th>Total Tasks</th>
            <th>Progress</th>
            <th>Feedback</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>John Doe</td>
            <td>5</td>
            <td>10</td>
            <td>
              <div class="progress-container">
                <div class="progress-bar" style="width: 50%;"></div>
              </div>
              50%
            </td>
            <td class="feedback">Good progress</td>
          </tr>
          <tr>
            <td>Jane Smith</td>
            <td>8</td>
            <td>10</td>
            <td>
              <div class="progress-container">
                <div class="progress-bar" style="width: 80%;"></div>
              </div>
              80%
            </td>
            <td class="feedback">Excellent work</td>
          </tr>
          <tr>
            <td>Michael Johnson</td>
            <td>3</td>
            <td>10</td>
            <td>
              <div class="progress-container">
                <div class="progress-bar" style="width: 30%;"></div>
              </div>
              30%
            </td>
            <td class="feedback">Needs improvement</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>



@endsection

{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Student Progress Tracking</title>
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
    }

    /* Header */
    .header {
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      color: white;
      padding: 0 20px;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      height: 70px;
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      display: flex;
      align-items: center;
      font-size: 20px;
      font-weight: 600;
    }

    /* Sidebar */
    .sidebar {
      position: fixed;
      top: 70px;
      left: 0;
      width: 250px;
      height: calc(100vh - 70px);
      background: #34495e;
      padding: 20px 0;
      overflow-y: auto;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .sidebar .nav-item {
      color: #bdc3c7;
      padding: 12px 30px;
      display: flex;
      align-items: center;
      gap: 12px;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.3s ease;
      text-decoration: none;
    }
    .sidebar .nav-item:hover,
    .sidebar .nav-item.active {
      background: #3498db;
      color: white;
    }
    .sidebar .nav-item i {
      font-size: 18px;
      width: 20px;
      text-align: center;
    }

    /* Main content */
    .main-content {
      margin-left: 250px;
      margin-top: 70px;
      padding: 25px 30px;
      min-height: calc(100vh - 70px);
    }

    /* Role Info */
    .role-info {
      font-size: 14px;
      margin-bottom: 25px;
      font-weight: 600;
      color: #7f8c8d;
    }

    /* Card */
    .card {
      background: white;
      border-radius: 10px;
      padding: 25px 30px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      border: 1px solid #ecf0f1;
      margin-bottom: 25px;
    }

    /* Table styles */
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }
    th, td {
      border: 1px solid #ecf0f1;
      padding: 12px 15px;
      text-align: center;
      font-size: 14px;
      color: #2c3e50;
    }
    th {
      background: #3498db;
      color: white;
      font-weight: 600;
    }

    /* Progress bar container */
    .progress-container {
      background: #ecf0f1;
      border-radius: 8px;
      width: 100%;
      height: 15px;
      overflow: hidden;
    }

    /* Actual progress bar */
    .progress-bar {
      height: 100%;
      border-radius: 8px;
      background: #27ae60;
      width: 0%; /* will be inline style */
      transition: width 0.5s ease;
    }

    /* Feedback text */
    .feedback {
      font-size: 13px;
      color: #7f8c8d;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 20px;
      }
      .sidebar {
        display: none;
      }
    }
  </style>
</head>
<body>

  <header class="header">
    Student Progress Tracking Dashboard
  </header>

  <aside class="sidebar">
    <a href="#" class="nav-item active"><i>🏠</i> Dashboard</a>
    <a href="#" class="nav-item"><i>📋</i> Tasks</a>
    <a href="#" class="nav-item"><i>📊</i> Reports</a>
    <a href="#" class="nav-item"><i>⚙️</i> Settings</a>
  </aside>

  <main class="main-content">
    <p class="role-info">Role: <strong>Teacher</strong></p>

    <section class="card">
      <h3>Student Progress Overview</h3>
      <table>
        <thead>
          <tr>
            <th>Student Name</th>
            <th>Completed Tasks</th>
            <th>Total Tasks</th>
            <th>Progress</th>
            <th>Feedback</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td>John Doe</td>
            <td>5</td>
            <td>10</td>
            <td>
              <div class="progress-container">
                <div class="progress-bar" style="width: 50%;"></div>
              </div>
              50%
            </td>
            <td class="feedback">Good progress</td>
          </tr>
          <tr>
            <td>Jane Smith</td>
            <td>8</td>
            <td>10</td>
            <td>
              <div class="progress-container">
                <div class="progress-bar" style="width: 80%;"></div>
              </div>
              80%
            </td>
            <td class="feedback">Excellent work</td>
          </tr>
          <tr>
            <td>Michael Johnson</td>
            <td>3</td>
            <td>10</td>
            <td>
              <div class="progress-container">
                <div class="progress-bar" style="width: 30%;"></div>
              </div>
              30%
            </td>
            <td class="feedback">Needs improvement</td>
          </tr>
        </tbody>
      </table>
    </section>
  </main>

</body>
</html> --}}
