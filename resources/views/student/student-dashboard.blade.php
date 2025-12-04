@extends('student.layout')


@section('content')
<!-- Main Content -->
    <main class="main-content">
        <!-- Welcome Section -->
       <div class="welcome-section">
            <h1>Welcome, {{ Auth::user()->name ?? 'Student' }}</h1>
            <p>Defense Research Management System</p>
        </div>


        <!-- Statistics Cards -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon queries">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $myQueriesCount }}</h3>
                    <p>My Queries</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon tasks">
                    <i class="fas fa-tasks"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $activeTasksCount }}</h3>
                    <p>Active Tasks</p>
                </div>
            </div>
            <div class="stat-card">
                <div class="stat-icon progress">
                    <i class="fas fa-chart-line"></i>
                </div>
                <div class="stat-info">
                    <h3>{{ $progress }}%</h3>
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
                    @forelse($recentUpdates as $update)
                    <div class="activity-item">
                        <div class="activity-icon">
                            <i class="{{ $update['icon'] }}"></i>
                        </div>
                        <div class="activity-content">
                            <p>{!! $update['message'] !!}</p>
                            <span class="time">{{ $update['time'] }}</span>
                        </div>
                    </div>
                    @empty
                    <div class="activity-item">
                        <div class="activity-content">
                            <p style="text-align: center; color: #999;">No recent updates</p>
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
                    <a href="{{ route('student.queries') }}" class="action-btn">
                        <i class="fas fa-question"></i>
                        <span>Submit Query</span>
                    </a>
                    <a href="{{ route('student.tasks.index') }}" class="action-btn">
                        <i class="fas fa-upload"></i>
                        <span>Submit Task</span>
                    </a>
                    <a href="{{ route('student.resource.sharing') }}" class="action-btn">
                        <i class="fas fa-download"></i>
                        <span>Download Resource</span>
                    </a>
                </div>
            </div>

            <!-- Upcoming Deadlines -->
            <div class="card">
                <div class="card-header">
                    <h3>Upcoming Deadlines</h3>
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
                            <p>Supervisor: {{ $deadline['supervisor'] }}</p>
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