<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard - Interactive Follow-up and Query System for Research Management</title>
    <link rel="stylesheet" href="{{ asset('css/teacher_dashboard.css') }}">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    @stack('styles')
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
                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=50&h=50&fit=crop"
                    alt="Profile" class="profile-img">
                <span>Dr. Ahmed Rahman</span>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="teacher-info">
                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=60&h=60&fit=crop"
                    alt="Teacher" class="teacher-img">
                <div class="teacher-details">
                    <h4>Dr. Ahmed Rahman</h4>
                    <p>Research Supervisor</p>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('teacher.dashboard') }}" class="nav-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('teacher.profile') }}" class="nav-item">
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

            <a href="{{ route('teacher.student.queries') }}" class="nav-item">
                <i class="fas fa-question-circle"></i>
                <span>Student Queries</span>
                <span class="badge">5</span>
            </a>


            <a href="{{ route('teacher.task.assign') }}" class="nav-item">
                <i class="fas fa-tasks"></i>
                <span>Assign Tasks</span>
            </a>

            <a href="{{ route('teacher.student.progress.track') }}" class="nav-item">
                <i class="fas fa-chart-line"></i>
                <span>Track Progress</span>
            </a>
            <a href="{{ route('teacher.resource.sharing') }}" class="nav-item">
                <i class="fas fa-folder-open"></i>
                <span>Resource Sharing</span>
            </a>
            <a href="{{ route('teacher.notification') }}" class="nav-item">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
            <a href="{{ route('teacher.logout') }}" class="nav-item logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </aside>
    @yield('content')
    @stack('scripts')
</body>

</html>
