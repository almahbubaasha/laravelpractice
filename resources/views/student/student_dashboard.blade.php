@extends('student.layout')
@section('content')
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
@endsection