<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Task Assignment & Submission</title>
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
      text-align: left;
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
      padding: 30px 40px;
      min-height: calc(100vh - 70px);
      background: #f5f7fa;
    }

    /* Role Info */
    .role-info {
      font-size: 14px;
      margin-bottom: 25px;
      font-weight: 600;
      color: #7f8c8d;
      text-align: right;
    }

    /* Card */
    .card {
      background: white;
      border-radius: 10px;
      padding: 30px 35px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      border: 1px solid #ecf0f1;
      margin-bottom: 30px;
    }

    /* Headings */
    h2 {
      color: #3498db;
      margin-bottom: 20px;
      text-align: center;
    }
    h3 {
      color: #2c3e50;
      margin-bottom: 15px;
      font-weight: 600;
    }

    /* Form elements */
    input, textarea, select {
      width: 100%;
      padding: 12px 15px;
      margin: 12px 0 18px;
      border: 1px solid #ccc;
      border-radius: 6px;
      font-size: 15px;
      font-family: inherit;
      transition: border-color 0.3s ease;
    }
    input:focus, textarea:focus, select:focus {
      border-color: #3498db;
      outline: none;
    }
    textarea {
      resize: vertical;
      min-height: 80px;
    }

    /* Buttons */
    .btn {
      width: 100%;
      padding: 14px;
       background: #3498db;
      color: white;
      border: none;
      border-radius: 6px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    .btn:hover {
     background: #2c80bd;
      transform: translateY(-2px);
    }

    /* Lists */
    ul {
      list-style: none;
      padding: 0;
    }
    .task-item {
      background: #f9f9f9;
      padding: 14px 18px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 15px;
      color: #2c3e50;
      box-shadow: 0 1px 3px rgba(0,0,0,0.05);
    }

    /* Sections spacing */
    #teacher-section, #student-section {
      margin-top: 30px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .main-content {
        margin-left: 0;
        padding: 20px 20px;
      }
      .sidebar {
        display: none;
      }
      .role-info {
        text-align: left;
      }
    }
  </style>
</head>
<body>

  <header class="header">
    Task Assignment & Submission
  </header>

  <aside class="sidebar">
    <a href="#" class="nav-item active"><i>🏠</i> Dashboard</a>
    <a href="#" class="nav-item"><i>📝</i> Tasks</a>
    <a href="#" class="nav-item"><i>📤</i> Submissions</a>
    <a href="#" class="nav-item"><i>⚙️</i> Settings</a>
  </aside>

  <main class="main-content">
    <p class="role-info">Role: <strong>Teacher / Student</strong></p>

    <!-- Teacher Section -->
    <section id="teacher-section" class="card">
      <h3>Assign a Task</h3>
      <form id="taskForm">
        <input type="text" id="taskTitle" placeholder="Task Title" required />
        <textarea id="taskDesc" placeholder="Task Description" required></textarea>
        <input type="date" id="taskDeadline" required />
        <button class="btn" type="submit">Assign Task</button>
      </form>

      <h3 style="margin-top: 40px;">All Assigned Tasks</h3>
      <ul id="assignedTasks">
        <li class="task-item">No tasks assigned yet.</li>
      </ul>
    </section>

    <!-- Student Section -->
    <section id="student-section" class="card">
      <h3>My Assigned Tasks</h3>
      <ul id="studentTasks">
        <li class="task-item">No tasks assigned.</li>
      </ul>

      <h3 style="margin-top: 40px;">Submit a Task</h3>
      <form id="submissionForm">
        <select id="taskSelect">
          <option value="">Select a Task</option>
        </select>
        <input type="file" id="taskFile" required />
        <button class="btn" type="submit">Submit Task</button>
      </form>

      <h3 style="margin-top: 40px;">Submitted Tasks</h3>
      <ul id="submittedTasks">
        <li class="task-item">No submissions yet.</li>
      </ul>
    </section>
  </main>

</body>
</html>
