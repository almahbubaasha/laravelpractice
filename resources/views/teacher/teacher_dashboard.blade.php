@extends('teacher.layout')
@section('content')
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
@endsection
