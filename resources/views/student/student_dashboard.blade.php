<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Interactive Follow-up and Query System</title>
    <link rel="stylesheet" href="{{ asset('css/student_dashboard.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="header-content">
            <div class="logo">
                <i class="fas fa-shield-alt"></i>
                <span>Interactive Follow-up and Query System for Research Management</span>
            </div>
            <div class="user-info">
                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=50&h=50&fit=crop" alt="Profile" class="profile-img">
                <span>Fatima Khan</span>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="student-info">
                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" alt="Student" class="student-img">
                <div class="student-details">
                    <h4>Fatima Khan</h4>
                    <p>Research Student</p>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('profile') }}" class="nav-item active">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="#supervisor" class="nav-item">
                <i class="fas fa-user-tie"></i>
                <span>Supervisor Info</span>
            </a>
            <a href="{{ route('student.queries') }}" class="nav-item">
                <i class="fas fa-question-circle"></i>
                <span>My Queries</span>
            </a>
            <a href="{{ route('task_assign') }}" class="nav-item">
                <i class="fas fa-tasks"></i>
                <span>Assigned Tasks</span>
            </a>
            <a href="{{ route('notification') }}" class="nav-item">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
            <a href="{{ route('resource_sharing') }}" class="nav-item">
                <i class="fas fa-folder-open"></i>
                <span>Resource Sharing</span>
            </a>
            <a href="{{ route('logout') }}" class="nav-item logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Section -->
       <div class="welcome-section">
            <h1>Welcome, Student</h1>
            <p>Defence Research Management System</p>
        </div>


        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon queries">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>2</h3>
                    <p>My Queries</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon tasks">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-info">
                    <h3>4</h3>
                    <p>Active Tasks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon progress">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>75%</h3>
                    <p>Progress</p>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <!-- Recent Updates -->
            <div class="card">
                <div class="card-header">
                    <h3>Recent Updates</h3>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-bullhorn"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Dr. Ahmed Rahman</strong> sent a new notice</p>
                            <span class="time">1 hour ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>You</strong> completed Task 3</p>
                            <span class="time">3 days ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-file-download"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>New Resource</strong> added by supervisor</p>
                            <span class="time">5 days ago</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="quick-actions">
                    <button class="action-btn">
                        <i class="fas fa-question"></i>
                        <span>Submit Query</span>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-upload"></i>
                        <span>Submit Task</span>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-download"></i>
                        <span>Download Resource</span>
                    </button>
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="card">
                <div class="card-header">
                    <h3>Upcoming Deadlines</h3>
                </div>
                <div class="deadline-list">
                    <div class="deadline-item">
                        <div class="deadline-date">
                            <span class="day">22</span>
                            <span class="month">Jul</span>
                        </div>
                        <div class="deadline-info">
                            <h4>Submit Chapter 2</h4>
                            <p>Supervisor: Dr. Ahmed Rahman</p>
                        </div>
                    </div>
                    <div class="deadline-item">
                        <div class="deadline-date">
                            <span class="day">30</span>
                            <span class="month">Jul</span>
                        </div>
                        <div class="deadline-info">
                            <h4>Progress Review Meeting</h4>
                            <p>Scheduled via Zoom</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
