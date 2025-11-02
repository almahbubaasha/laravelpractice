@extends('student.layout')
@push('styles')
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
@endpush




@section('content')
<main class="main-content">
  <div class="card">
    <h3>Assigned Tasks</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($tasks->isEmpty())
      <p>No tasks assigned yet.</p>
    @else
      @foreach($tasks as $task)
        <div class="task-item">
          <h4>{{ $task->title }}</h4>
          <p>{{ $task->description }}</p>
          <p><strong>Deadline:</strong> {{ $task->deadline ? \Carbon\Carbon::parse($task->deadline)->format('d M, Y') : '—' }}</p>

          @if($task->file_path)
            <p>
              <a href="{{ route('teacher.tasks.download', $task->id) }}">Download task file</a>

            </p>
          @endif

          @php
            $submission = $task->submissions()->where('student_id', auth()->id())->first();
          @endphp

          @if($submission)
            <p><strong>Your submission:</strong>
              @if($submission->file_path)
                <a href="{{ route('submissions.download', $submission->id) }}">Download your file</a>

              @else
                No file.
              @endif
            </p>
            <p><strong>Submitted at:</strong> {{ $submission->created_at->diffForHumans() }}</p>
            <p><strong>Remarks:</strong> {{ $submission->remarks }}</p>
          @else
            <form action="{{ route('student.task.submit', $task->id) }}" method="POST" enctype="multipart/form-data" style="margin-top:10px;">
              @csrf
              <label>Upload your file</label>
              <input type="file" name="file" required />
              <label>Remarks (optional)</label>
              <input type="text" name="remarks" />
              <button type="submit" class="btn">Submit</button>
            </form>
          @endif
        </div>
      @endforeach
    @endif

  </div>
</main>
@endsection




