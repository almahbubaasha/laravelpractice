@extends('teacher.layout')

@push('styles')
<title>Task Assignment</title>
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
  min-height: 100vh;
  text-align: left;
}

.main-content {
  margin-left: 250px;
  margin-top: 70px;
  padding: 30px 40px;
  min-height: calc(100vh - 70px);
  background: #f5f7fa;
}

.card {
  background: white;
  border-radius: 10px;
  padding: 30px 35px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  border: 1px solid #ecf0f1;
  margin-bottom: 30px;
}

h3 {
  color: #2c3e50;
  margin-bottom: 15px;
  font-weight: 600;
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

/* Submissions Section Styles */
.submissions-section {
  margin-top: 40px;
}

.task-card {
  background: white;
  border-radius: 10px;
  padding: 25px;
  margin-bottom: 25px;
  border: 1px solid #ecf0f1;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.task-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 15px;
  padding-bottom: 15px;
  border-bottom: 2px solid #ecf0f1;
  flex-wrap: wrap;
  gap: 15px;
}

.task-title {
  font-size: 20px;
  font-weight: 600;
  color: #2c3e50;
}

.task-deadline {
  background: #fff3cd;
  color: #856404;
  padding: 5px 12px;
  border-radius: 15px;
  font-size: 13px;
  font-weight: 600;
}

.submissions-list {
  margin-top: 15px;
}

.submission-item {
  background: #f8f9fa;
  padding: 15px;
  border-radius: 8px;
  margin-bottom: 12px;
  border-left: 4px solid #27ae60;
}

.submission-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 10px;
  flex-wrap: wrap;
  gap: 10px;
}

.student-info-badge {
  display: flex;
  gap: 10px;
  align-items: center;
  flex-wrap: wrap;
}

.student-name-badge {
  background: #3498db;
  color: white;
  padding: 5px 12px;
  border-radius: 15px;
  font-size: 13px;
  font-weight: 600;
}

.student-id-badge {
  background: #95a5a6;
  color: white;
  padding: 5px 12px;
  border-radius: 15px;
  font-size: 13px;
  font-weight: 600;
}

.submission-time {
  color: #7f8c8d;
  font-size: 12px;
}

.submission-reply {
  background: white;
  padding: 12px;
  border-radius: 6px;
  margin: 10px 0;
  border: 1px solid #ecf0f1;
}

.submission-actions {
  display: flex;
  gap: 10px;
  margin-top: 10px;
  flex-wrap: wrap;
}

.btn-download {
  background: #27ae60;
  color: white;
  padding: 6px 12px;
  border-radius: 5px;
  text-decoration: none;
  font-size: 13px;
  border: none;
  cursor: pointer;
  transition: background 0.3s;
  display: inline-block;
}

.btn-download:hover {
  background: #229954;
}

.btn-delete-submission {
  background: #e74c3c;
  color: white;
  padding: 6px 12px;
  border-radius: 5px;
  font-size: 13px;
  border: none;
  cursor: pointer;
  transition: background 0.3s;
}

.btn-delete-submission:hover {
  background: #c0392b;
}

.no-submissions {
  text-align: center;
  padding: 30px;
  color: #95a5a6;
  font-style: italic;
}

.btn-delete-task {
  background: #e74c3c;
  color: white;
  padding: 8px 16px;
  border-radius: 6px;
  border: none;
  cursor: pointer;
  font-size: 14px;
  font-weight: 600;
  transition: background 0.3s;
}

.btn-delete-task:hover {
  background: #c0392b;
}

/* Form styles */
.form-group {
  margin-bottom: 20px;
}
.form-group label {
  display: block;
  margin-bottom: 8px;
  font-weight: 600;
  color: #2c3e50;
  font-size: 14px;
}
input, textarea, select {
  width: 100%;
  padding: 12px 15px;
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
  min-height: 100px;
}

.student-select-wrapper {
  border: 1px solid #e0e0e0;
  border-radius: 8px;
  padding: 15px;
  background: #f9f9f9;
}

.select-all-wrapper {
  margin-bottom: 15px;
  padding: 10px;
  background: #e3f2fd;
  border-radius: 6px;
}

.select-all-wrapper label {
  display: flex;
  align-items: center;
  cursor: pointer;
  font-weight: 600;
  color: #1976d2;
}

.select-all-wrapper input[type="checkbox"] {
  width: 18px;
  height: 18px;
  margin-right: 10px;
  cursor: pointer;
}

.student-list {
  max-height: 250px;
  overflow-y: auto;
  border: 1px solid #ddd;
  border-radius: 6px;
  padding: 10px;
  background: white;
}

.student-checkbox-item {
  padding: 10px;
  margin-bottom: 8px;
  border-radius: 4px;
  transition: background 0.2s ease;
}

.student-checkbox-item:hover {
  background: #f0f0f0;
}

.student-checkbox-item label {
  display: flex;
  align-items: center;
  cursor: pointer;
  margin: 0;
  font-weight: normal;
}

.student-checkbox-item input[type="checkbox"] {
  width: 16px;
  height: 16px;
  margin-right: 10px;
  cursor: pointer;
}

.student-info {
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex: 1;
}

.student-name {
  font-weight: 500;
  color: #2c3e50;
}

.student-id {
  font-size: 12px;
  color: #7f8c8d;
  background: #ecf0f1;
  padding: 2px 8px;
  border-radius: 4px;
}

.selected-count {
  margin-top: 10px;
  padding: 8px 12px;
  background: #fff3cd;
  border: 1px solid #ffc107;
  border-radius: 4px;
  font-size: 13px;
  color: #856404;
  text-align: center;
}

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
  transition: all 0.3s ease;
}
.btn:hover {
  background: #2c80bd;
  transform: translateY(-2px);
  box-shadow: 0 4px 8px rgba(52, 152, 219, 0.3);
}
.btn:disabled {
  background: #95a5a6;
  cursor: not-allowed;
  transform: none;
}

@media (max-width: 768px) {
  .main-content {
    margin-left: 0;
    padding: 20px 20px;
  }
  .student-info {
    flex-direction: column;
    align-items: flex-start;
  }
  .student-id {
    margin-top: 5px;
  }
  .task-header {
    flex-direction: column;
    align-items: flex-start;
  }
}
</style>
@endpush

@section('content')
<main class="main-content">
  <!-- Task Assignment Form -->
  <div class="card">
    <h3>📝 Assign a Task</h3>

    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
      <div class="alert alert-danger">
        <ul style="margin: 0; padding-left: 20px;">
          @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    <form action="{{ route('teacher.task.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" id="title" placeholder="Task Title" value="{{ old('title') }}" required />
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea name="description" id="description" placeholder="Task Description" required>{{ old('description') }}</textarea>
      </div>

      <div class="form-group">
        <label for="deadline">Deadline</label>
        <input type="date" name="deadline" id="deadline" value="{{ old('deadline') }}" min="{{ date('Y-m-d') }}" required />
      </div>

      <div class="form-group">
        <label for="file">Attach file (optional)</label>
        <input type="file" name="file" id="file" accept=".pdf,.doc,.docx,.zip,.png,.jpg,.jpeg" />
        <small style="color: #7f8c8d; font-size: 12px;">Allowed: PDF, DOC, DOCX, ZIP, PNG, JPG (Max: 10MB)</small>
      </div>

      <div class="form-group">
        <label>Assign to Students</label>
        <div class="student-select-wrapper">
          <div class="select-all-wrapper">
            <label>
              <input type="checkbox" id="select-all" />
              <span>Select All Students</span>
            </label>
          </div>

          @if($students->count() > 0)
            <div class="student-list" id="student-list">
              @foreach($students as $student)
                <div class="student-checkbox-item">
                  <label>
                    <input 
                      type="checkbox" 
                      name="student_identifiers[]" 
                      value="{{ $student->student_identifier }}" 
                      class="student-checkbox"
                      {{ (is_array(old('student_identifiers')) && in_array($student->student_identifier, old('student_identifiers'))) ? 'checked' : '' }}
                    />
                    <div class="student-info">
                      <span class="student-name">{{ $student->name }}</span>
                      <span class="student-id">ID: {{ $student->student_identifier }}</span>
                    </div>
                  </label>
                </div>
              @endforeach
            </div>

            <div class="selected-count" id="selected-count">
              <strong>0</strong> student(s) selected
            </div>
          @else
            <p style="text-align: center; color: #e74c3c; padding: 20px;">
              No students found. Please add students first.
            </p>
          @endif
        </div>
      </div>

      <button type="submit" class="btn" id="submit-btn" @if($students->count() == 0) disabled @endif>
        Assign Task
      </button>
    </form>
  </div>

  <!-- Student Submissions Section -->
  <div class="submissions-section">
    <h3>📚 Assigned Tasks & Submissions</h3>

    @if(isset($tasks) && $tasks->count() > 0)
      @foreach($tasks as $task)
        <div class="task-card">
          <div class="task-header">
            <div>
              <div class="task-title">{{ $task->title }}</div>
              <div style="color: #7f8c8d; font-size: 13px; margin-top: 5px;">
                {{ Str::limit($task->description, 100) }}
              </div>
            </div>
            <div style="display: flex; gap: 10px; align-items: center;">
              <span class="task-deadline">📅 {{ \Carbon\Carbon::parse($task->deadline)->format('M d, Y') }}</span>
              <form action="{{ route('teacher.task.destroy', $task->id) }}" method="POST" style="margin: 0;">
                @csrf
                @method('DELETE')
                <button 
                  type="submit" 
                  class="btn-delete-task"
                  onclick="return confirm('Delete this task and all submissions?')"
                >
                  🗑️ Delete Task
                </button>
              </form>
            </div>
          </div>

          <!-- Submissions List -->
          <div class="submissions-list">
            <h4 style="margin-bottom: 15px; color: #2c3e50; font-size: 16px;">
              📥 Submissions ({{ $task->assignments->where('submitted_at', '!=', null)->count() }} / {{ $task->assignments->count() }})
            </h4>

            @forelse($task->assignments->where('submitted_at', '!=', null) as $assignment)
              <div class="submission-item">
                <div class="submission-header">
                  <div class="student-info-badge">
                    <span class="student-name-badge">👤 {{ $assignment->student->name ?? 'Unknown' }}</span>
                    <span class="student-id-badge">ID: {{ $assignment->student_identifier }}</span>
                  </div>
                  <span class="submission-time">
                    🕒 {{ \Carbon\Carbon::parse($assignment->submitted_at)->format('M d, Y - h:i A') }}
                  </span>
                </div>

                @if($assignment->reply)
                  <div class="submission-reply">
                    <strong style="color: #2c3e50; font-size: 13px;">Reply:</strong>
                    <p style="margin: 5px 0 0 0; color: #555;">{{ $assignment->reply }}</p>
                  </div>
                @endif

                <div class="submission-actions">
                  @if($assignment->submission_file)
                    <a href="{{ route('teacher.task.submission.download', $assignment->id) }}" class="btn-download">
                      📎 Download File
                    </a>
                  @endif
                  
                  <form action="{{ route('teacher.task.submission.delete', $assignment->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button 
                      type="submit" 
                      class="btn-delete-submission"
                      onclick="return confirm('Delete this submission?')"
                    >
                      🗑️ Delete
                    </button>
                  </form>
                </div>
              </div>
            @empty
              <div class="no-submissions">
                📭 No submissions yet for this task.
              </div>
            @endforelse
          </div>
        </div>
      @endforeach
    @else
      <div class="card">
        <div class="no-submissions">
          📋 No tasks assigned yet. Create your first task above!
        </div>
      </div>
    @endif
  </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('select-all');
    const studentCheckboxes = document.querySelectorAll('.student-checkbox');
    const selectedCountElement = document.getElementById('selected-count');
    const submitBtn = document.getElementById('submit-btn');

    function updateSelectedCount() {
        const checkedCount = document.querySelectorAll('.student-checkbox:checked').length;
        selectedCountElement.innerHTML = `<strong>${checkedCount}</strong> student(s) selected`;
        
        if (submitBtn) {
            submitBtn.disabled = checkedCount === 0;
        }

        if (studentCheckboxes.length > 0) {
            selectAllCheckbox.checked = checkedCount === studentCheckboxes.length;
            selectAllCheckbox.indeterminate = checkedCount > 0 && checkedCount < studentCheckboxes.length;
        }
    }

    updateSelectedCount();

    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            studentCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            updateSelectedCount();
        });
    }

    studentCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectedCount();
        });
    });
});
</script>
@endsection