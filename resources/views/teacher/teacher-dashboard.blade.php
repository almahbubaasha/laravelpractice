@extends('teacher.layout')

@section('content')
    <!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Section -->
        <div class="welcome-section">
            <h1>Welcome, {{ Auth::user()->name ?? 'Teacher' }}</h1>
            <p>Defence Research Management System</p>
        </div>

        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon students">
                    <i class="fas fa-users"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $totalStudents }}</h3>
                    <p>Total Students</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon queries">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $pendingQueries }}</h3>
                    <p>Pending Queries</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon tasks">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $activeTasks }}</h3>
                    <p>Active Tasks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon progress">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $avgProgress }}%</h3>
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
                    <span style="font-size: 12px; color: #666;">Last 5 activities</span>
                </div>
                <div class="activity-list">
                    @forelse($recentActivities as $activity)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="{{ $activity['icon'] }}"></i>
                        </div>
                        <div class="activity-content">
                            <p>{!! $activity['message'] !!}</p>
                            <span class="time">{{ $activity['time'] }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="activity-item">
                        <div class="activity-content">
                            <p style="text-align: center; color: #999;">No recent activities</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card">
                <div class="card-header">
                    <h3>Quick Actions</h3>
                </div>
                <div class="quick-actions">
                    <a href="{{ route('teacher.add.student') }}" class="action-btn">
                        <i class="fas fa-user-plus"></i>
                        <span>Add Student</span>
                    </a>
                    <a href="{{ route('teacher.task.assign') }}" class="action-btn">
                        <i class="fas fa-plus-circle"></i>
                        <span>Create Task</span>
                    </a>
                    <a href="{{ route('teacher.resource.sharing') }}" class="action-btn">
                        <i class="fas fa-upload"></i>
                        <span>Share Resource</span>
                    </a>
                    <a href="{{ route('teacher.notification') }}" class="action-btn">
                        <i class="fas fa-bullhorn"></i>
                        <span>Send Notice</span>
                    </a>
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="card">
                <div class="card-header">
                    <h3>Upcoming Deadlines</h3>
                    <span style="font-size: 12px; color: #666;">Next 5 deadlines</span>
                </div>
                <div class="deadline-list">
                    @forelse($upcomingDeadlines as $deadline)
                    <div class="deadline-item">
                        <div class="deadline-date">
                            <span class="day">{{ $deadline['day'] }}</span>
                            <span class="month">{{ $deadline['month'] }}</span>
                        </div>
                        <div class="deadline-info">
                            <h4>{{ $deadline['title'] }}</h4>
                            <p>{{ $deadline['info'] }}</p>
                        </div>
                    </div>
                    @empty
                    <div class="deadline-item">
                        <div class="deadline-info">
                            <p style="text-align: center; color: #999;">No upcoming deadlines</p>
                        </div>
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </main>
@endsection
