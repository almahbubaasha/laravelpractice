<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Interactive Follow-up and Query System</title>
    <link rel="stylesheet" href="{{ asset('css/student_dashboard.css') }}">
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
                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt="Profile" class="profile-img">
                <span>{{ Auth::user()->name ?? 'Student' }}</span>
            </div>
        </div>
    </header>

    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="student-info">
                <img src="https://images.pexels.com/photos/774909/pexels-photo-774909.jpeg" alt="Student" class="student-img">
                <div class="student-details">
                    <h4>{{ Auth::user()->name ?? 'Student' }}</h4>
                    <p>Research Student</p>
                </div>
            </div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('student.dashboard') }}" class="nav-item active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('student.profile') }}" class="nav-item">
                <i class="fas fa-user"></i>
                <span>Profile</span>
            </a>
            <a href="{{ route('student.supervisor.information') }}" class="nav-item">
                <i class="fas fa-user-tie"></i>
                <span>Supervisor Info</span>
            </a>
            <a href="{{ route('student.queries') }}" class="nav-item">
                <i class="fas fa-question-circle"></i>
                <span>My Queries</span>
            </a>
            <a href="{{ route('task.assign') }}" class="nav-item">
                <i class="fas fa-tasks"></i>
                <span>Assigned Tasks</span>
            </a>
            <a href="{{ route('notification') }}" class="nav-item">
                <i class="fas fa-bell"></i>
                <span>Notifications</span>
            </a>
            <a href="{{ route('resource.sharing') }}" class="nav-item">
                <i class="fas fa-folder-open"></i>
                <span>Resource Sharing</span>
            </a>
            <a href="{{ route('logout') }}" class="nav-item logout">
                <i class="fas fa-sign-out-alt"></i>
                <span>Logout</span>
            </a>
        </nav>
    </aside>

    @yield('content')

    @stack('scripts')
</body>
</html>
