@extends('student.layout')

@push('styles')
<title>My Assigned Tasks</title>
<style>
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
  }

  .main-content {
    margin-left: 250px;
    margin-top: 70px;
    padding: 30px 40px;
    min-height: calc(100vh - 70px);
    background: #f5f7fa;
  }

  .page-header {
    margin-bottom: 30px;
  }
  .page-header h2 {
    color: #2c3e50;
    font-size: 28px;
    margin-bottom: 8px;
  }
  .page-header p {
    color: #7f8c8d;
    font-size: 14px;
  }

  .alert {
    padding: 12px 20px;
    margin-bottom: 20px;
    border-radius: 6px;
    font-size: 14px;
  }
  .alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }
  .alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  .tasks-container {
    display: grid;
    gap: 20px;
  }

  .task-card {
    background: white;
    border-radius: 10px;
    padding: 25px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
    border-left: 4px solid #3498db;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
  }
  .task-card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.12);
  }

  .task-card.overdue {
    border-left-color: #e74c3c;
  }
  .task-card.completed {
    border-left-color: #27ae60;
    opacity: 0.85;
  }

  .task-header {
    display: flex;
    justify-content: space-between;
    align-items: start;
    margin-bottom: 15px;
    flex-wrap: wrap;
    gap: 10px;
  }

  .task-title {
    font-size: 20px;
    font-weight: 600;
    color: #2c3e50;
    flex: 1;
  }

  .task-status {
    padding: 6px 12px;
    border-radius: 20px;
    font-size: 12px;
    font-weight: 600;
    text-transform: uppercase;
  }
  .status-pending {
    background: #fff3cd;
    color: #856404;
  }
  .status-completed {
    background: #d4edda;
    color: #155724;
  }
  .status-overdue {
    background: #f8d7da;
    color: #721c24;
  }

  .task-meta {
    display: flex;
    gap: 20px;
    margin-bottom: 15px;
    flex-wrap: wrap;
    font-size: 14px;
    color: #7f8c8d;
  }
  .task-meta-item {
    display: flex;
    align-items: center;
    gap: 6px;
  }
  .task-meta-item strong {
    color: #2c3e50;
  }

  .task-description {
    color: #555;
    font-size: 15px;
    line-height: 1.6;
    margin-bottom: 15px;
    padding: 12px;
    background: #f9f9f9;
    border-radius: 6px;
  }

  .task-attachment {
    margin-bottom: 20px;
    padding: 10px;
    background: #e3f2fd;
    border-radius: 6px;
    font-size: 14px;
  }
  .task-attachment a {
    color: #1976d2;
    text-decoration: none;
    font-weight: 600;
  }
  .task-attachment a:hover {
    text-decoration: underline;
  }

  .submission-section {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #ecf0f1;
  }
  .submission-section h4 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 16px;
  }

  .form-group {
    margin-bottom: 15px;
  }
  .form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 600;
    color: #2c3e50;
    font-size: 14px;
  }
  textarea {
    width: 100%;
    padding: 12px 15px;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
    font-family: inherit;
    resize: vertical;
    min-height: 80px;
  }
  textarea:focus {
    border-color: #3498db;
    outline: none;
  }

  input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 2px dashed #ccc;
    border-radius: 6px;
    font-size: 14px;
    background: #f9f9f9;
    cursor: pointer;
  }
  input[type="file"]:hover {
    border-color: #3498db;
    background: #f0f8ff;
  }

  .btn-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
  }

  .btn {
    padding: 10px 20px;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-decoration: none;
    display: inline-block;
    text-align: center;
  }

  .btn-primary {
    background: #3498db;
    color: white;
  }
  .btn-primary:hover {
    background: #2c80bd;
    transform: translateY(-2px);
  }

  .btn-danger {
    background: #e74c3c;
    color: white;
  }
  .btn-danger:hover {
    background: #c0392b;
  }

  .btn:disabled {
    background: #95a5a6;
    cursor: not-allowed;
    transform: none;
  }

  .submission-history {
    margin-top: 20px;
    padding: 15px;
    background: #f0f8ff;
    border-radius: 6px;
    border-left: 4px solid #27ae60;
  }
  .submission-history h5 {
    color: #27ae60;
    margin-bottom: 10px;
    font-size: 15px;
  }
  .submission-item {
    padding: 10px;
    background: white;
    border-radius: 4px;
    margin-bottom: 10px;
    font-size: 14px;
  }
  .submission-item strong {
    color: #2c3e50;
  }
  .submission-file {
    margin-top: 8px;
  }
  .submission-file a {
    color: #1976d2;
    text-decoration: none;
    font-weight: 600;
  }

  .empty-state {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.08);
  }
  .empty-state h3 {
    color: #7f8c8d;
    font-size: 20px;
    margin-bottom: 10px;
  }
  .empty-state p {
    color: #95a5a6;
    font-size: 14px;
  }

  @media (max-width: 768px) {
    .main-content {
      margin-left: 0;
      padding: 20px;
    }
    .task-header {
      flex-direction: column;
    }
    .task-meta {
      flex-direction: column;
      gap: 8px;
    }
    .btn-group {
      flex-direction: column;
    }
    .btn {
      width: 100%;
    }
  }
</style>
@endpush

@section('content')
<main class="main-content">
  <div class="page-header">
    <h2>My Assigned Tasks</h2>
    <p>View and submit your assigned tasks</p>
  </div>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  @if(session('error'))
    <div class="alert alert-danger">{{ session('error') }}</div>
  @endif

  @if($tasks->count() > 0)
    <div class="tasks-container">
      @foreach($tasks as $task)
        @php
          $isOverdue = !$task->pivot->submitted_at && \Carbon\Carbon::parse($task->deadline)->isPast();
          $isCompleted = $task->pivot->submitted_at != null;
        @endphp

        <div class="task-card {{ $isOverdue ? 'overdue' : '' }} {{ $isCompleted ? 'completed' : '' }}">
          
          <div class="task-header">
            <h3 class="task-title">{{ $task->title }}</h3>
            <span class="task-status {{ $isCompleted ? 'status-completed' : ($isOverdue ? 'status-overdue' : 'status-pending') }}">
              {{ $isCompleted ? 'Completed' : ($isOverdue ? 'Overdue' : 'Pending') }}
            </span>
          </div>

          <div class="task-meta">
            <div class="task-meta-item">
              <strong>Assigned:</strong> {{ \Carbon\Carbon::parse($task->created_at)->format('M d, Y') }}
            </div>
            <div class="task-meta-item">
              <strong>Deadline:</strong> 
              <span style="color: {{ $isOverdue ? '#e74c3c' : '#27ae60' }}">
                {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y h:i A') }}
              </span>
            </div>
          </div>

          <div class="task-description">
            {{ $task->description }}
          </div>

          @if($task->file_path)
            <div class="task-attachment">
              📎 <strong>Attachment:</strong> 
              <a href="{{ asset('storage/' . $task->file_path) }}" target="_blank" download>
                {{ $task->file_original_name ?? 'Download File' }}
              </a>
            </div>
          @endif

          @if($task->pivot->submitted_at)
            <div class="submission-history">
              <h5>✓ Your Submission</h5>
              <div class="submission-item">
                <strong>Submitted on:</strong> {{ \Carbon\Carbon::parse($task->pivot->submitted_at)->format('M d, Y h:i A') }}<br>
                @if($task->pivot->reply)
                  <strong>Reply:</strong> {{ $task->pivot->reply }}<br>
                @endif
                @if($task->pivot->submission_file)
                  <div class="submission-file">
                    📄 <a href="{{ asset('storage/' . $task->pivot->submission_file) }}" target="_blank" download>
                      {{ $task->pivot->reply_file_original_name ?? 'Download Submission' }}
                    </a>
                    
                    <form action="{{ route('student.task.delete', $task->id) }}" method="POST" style="display: inline-block; margin-left: 15px;" onsubmit="return confirm('Are you sure you want to delete this submission?')">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger" style="padding: 5px 12px; font-size: 12px;">
                        🗑️ Delete
                      </button>
                    </form>
                  </div>
                @endif
              </div>
            </div>
          @else
            <div class="submission-section">
              <h4>Submit Your Work</h4>
              <form action="{{ route('student.task.submit', $task->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <div class="form-group">
                  <label for="reply-{{ $task->id }}">Your Reply</label>
                  <textarea name="reply" id="reply-{{ $task->id }}" placeholder="Write your answer or explanation here..." required></textarea>
                </div>

                <div class="form-group">
                  <label for="file-{{ $task->id }}">Upload File (Optional)</label>
                  <input type="file" name="submission_file" id="file-{{ $task->id }}" accept=".pdf,.doc,.docx,.zip,.png,.jpg,.jpeg">
                  <small style="color: #7f8c8d; font-size: 12px;">Allowed: PDF, DOC, DOCX, ZIP, PNG, JPG (Max: 10MB)</small>
                </div>

                <div class="btn-group">
                  <button type="submit" class="btn btn-primary">
                    📤 Submit Task
                  </button>
                </div>
              </form>
            </div>
          @endif

        </div>
      @endforeach
    </div>
  @else
    <div class="empty-state">
      <h3>No Tasks Assigned Yet</h3>
      <p>You don't have any assigned tasks at the moment. Check back later!</p>
    </div>
  @endif
</main>
@endsection