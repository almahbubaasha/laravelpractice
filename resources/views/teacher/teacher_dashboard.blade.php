<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Interactive Follow-up and Query System for Research Management</title>
    <link rel="stylesheet" href="{{ asset('css/teacher_dashboard.css') }}">

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
                <span>Dr. Ahmed Rahman</span>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="teacher-info">
                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop" alt="Teacher" class="teacher-img">
                <div class="teacher-details">
                    <h4>Dr. Ahmed Rahman</h4>
                    <p>Research Supervisor</p>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="#dashboard" class="nav-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('profile') }}" class="nav-item">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="#students" class="nav-item">
                <i class="fas fa-users"></i>
                <span>Manage Students</span>
            </a>
            <!-- <a href="#queries" class="nav-item">
                <i class="fas fa-question-circle"></i>
                <span>Student Queries</span>
                <span class="badge">5</span>
            </a> -->

            <a href="{{ route('student.queries') }}" class="nav-item">
    <i class="fas fa-question-circle"></i>
    <span>Student Queries</span>
    <span class="badge">5</span>
</a>


            <a href="{{ route('task_assign') }}" class="nav-item">
                <i class="fas fa-tasks"></i>
                <span>Assign Tasks</span>
            </a>

            <a href="{{ route('student.progress.track') }}" class="nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Track Progress</span>
            </a>
            <a href="{{ route('resource_sharing') }}" class="nav-item">
                <i class="fas fa-folder-open"></i>
                <span>Resource Sharing</span>
            </a>
            <a href="{{ route('notification') }}" class="nav-item">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
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
            <h1>Welcome, Dr. Ahmed Rahman</h1>
            <p>Defence Research Management System</p>
        </div>
        
        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon students">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>15</h3>
                    <p>Total Students</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon queries">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>5</h3>
                    <p>Pending Queries</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon tasks">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-info">
                    <h3>12</h3>
                    <p>Active Tasks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon progress">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>87%</h3>
                    <p>Avg Progress</p>
                </div>
            </div>
        </div>

        <!-- Dashboard Cards -->
        <div class="dashboard-grid">
            <!-- Recent Activities -->
            <div class="card">
                <div class="card-header">
                    <h3>Recent Activities</h3>
                </div>
                <div class="activity-list">
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-message"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Fatima Khan</strong> submitted a new query</p>
                            <span class="time">2 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-file-upload"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Rashid Ahmed</strong> uploaded research document</p>
                            <span class="time">4 hours ago</span>
                        </div>
                    </div>
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="activity-content">
                            <p><strong>Ayesha Begum</strong> completed assigned task</p>
                            <span class="time">1 day ago</span>
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
                        <i class="fas fa-user-plus"></i>
                        <span>Add Student</span>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>Create Task</span>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-upload"></i>
                        <span>Share Resource</span>
                    </button>
                    <button class="action-btn">
                        <i class="fas fa-bullhorn"></i>
                        <span>Send Notice</span>
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
                            <span class="day">15</span>
                            <span class="month">Dec</span>
                        </div>
                        <div class="deadline-info">
                            <h4>Research Proposal Review</h4>
                            <p>5 students pending</p>
                        </div>
                    </div>
                    <div class="deadline-item">
                        <div class="deadline-date">
                            <span class="day">20</span>
                            <span class="month">Dec</span>
                        </div>
                        <div class="deadline-info">
                            <h4>Mid-term Progress Report</h4>
                            <p>All students</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>