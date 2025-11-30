@extends('teacher.layout')

@push('styles')
<title>Notifications</title>
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body {
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      background: #f5f7fa;
      color: #333;
      line-height: 1.6;
      min-height: 100vh;
      padding: 100px 20px 40px;
      text-align: center;
  }

  .header {
      position: fixed;
      top: 0; left: 0; right: 0;
      height: 70px;
      background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
      color: white;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 24px;
      font-weight: 600;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      z-index: 1000;
  }

  .container {
      background: white;
      max-width: 750px;
      margin: 0 auto;
      border-radius: 15px;
      box-shadow: 0 4px 14px rgba(0,0,0,0.12);
      padding: 30px 25px;
      text-align: left;
  }

  h2 { 
      font-size: 28px; 
      color: #2c3e50; 
      text-align: center; 
      margin-bottom: 25px;
      font-weight: 600;
  }

  .alert {
      padding: 12px 15px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-weight: 500;
      display: none;
  }
  .alert-success { background: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
  .alert-danger { background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }

  .form-group {
      margin-bottom: 20px;
  }

  .form-group label {
      font-weight: 600;
      color: #2c3e50;
      display: block;
      margin-bottom: 8px;
      font-size: 16px;
  }

  .student-list-box {
      border: 1.5px solid #ecf0f1;
      padding: 15px;
      border-radius: 12px;
      max-height: 300px;
      overflow-y: auto;
      background: #f8f9fa;
  }

  .student-item {
      display: flex;
      align-items: center;
      padding: 10px;
      border-bottom: 1px solid #e9ecef;
      transition: background 0.2s;
  }
  
  .student-item:hover {
      background: #e3f2fd;
  }
  
  .student-item:last-child { border-bottom: none; }

  .student-item input[type="checkbox"] {
      width: 18px;
      height: 18px;
      margin-right: 12px;
      cursor: pointer;
  }

  .student-item label {
      font-size: 15px;
      color: #2c3e50;
      cursor: pointer;
      flex: 1;
      margin: 0;
  }

  .select-all-item {
      background: #e3f2fd;
      font-weight: 600;
      border-bottom: 2px solid #3498db !important;
  }

  textarea {
      width: 100%;
      min-height: 120px;
      padding: 14px 18px;
      border: 1.5px solid #ecf0f1;
      border-radius: 12px;
      font-size: 16px;
      font-family: inherit;
      resize: vertical;
      transition: border-color 0.3s;
  }
  
  textarea:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
  }

  .btn {
      background: #3498db;
      color: white;
      border: none;
      padding: 14px 20px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 12px;
      cursor: pointer;
      transition: all 0.3s ease;
      width: 100%;
      box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
  }
  
  .btn:hover { 
      background: #2c80bd; 
      transform: translateY(-2px);
      box-shadow: 0 6px 12px rgba(52, 152, 219, 0.4);
  }

  .btn:disabled {
      background: #95a5a6;
      cursor: not-allowed;
      transform: none;
  }

  .selected-count {
      font-size: 14px;
      color: #7f8c8d;
      margin-top: 8px;
      font-weight: 500;
  }
</style>
@endpush

@section('content')
<div class="header">Send Notifications</div>

<div class="container">
  <h2>Send Notification to Students</h2>

  <div id="successMessage" class="alert alert-success"></div>
  <div id="errorMessage" class="alert alert-danger"></div>

  <form id="notificationForm">
      @csrf

      <div class="form-group">
          <label>Select Students:</label>
          <div class="student-list-box">
            {{-- Select All Option --}}
            <div class="student-item select-all-item">
              <input type="checkbox" id="selectAll" class="select-all-checkbox">
              <label for="selectAll">✓ Select All Students</label>
            </div>

            {{-- Individual Students --}}
            @if(isset($students) && $students->count() > 0)
                @foreach($students as $s)
                <div class="student-item">
                  <input type="checkbox" 
                         name="students[]" 
                         value="{{ $s->student_id }}" 
                         class="student-checkbox"
                         id="student_{{ $loop->index }}">
                  <label for="student_{{ $loop->index }}">
                      ID: {{ $s->student_id }}
                      @if(isset($s->studentData))
                          | {{ $s->studentData->name ?? 'N/A' }}
                      @endif
                  </label>
                </div>
                @endforeach
            @else
                <div class="student-item" style="justify-content: center; color: #7f8c8d;">
                    <p>No students added yet.</p>
                </div>
            @endif
          </div>
          <p class="selected-count">Selected: <span id="selectedCount">0</span> student(s)</p>
      </div>

      <div class="form-group">
          <label for="notificationText">Notification Message:</label>
          <textarea id="notificationText" 
                    name="message" 
                    placeholder="Type your notification message here..." 
                    required></textarea>
      </div>

      <button class="btn" type="submit" id="sendBtn">Send Notification</button>
  </form>
</div>

@push('scripts')
<script>
  // Select All functionality
  document.getElementById('selectAll').addEventListener('change', function(e) {
      const isChecked = e.target.checked;
      document.querySelectorAll('.student-checkbox').forEach(checkbox => {
          checkbox.checked = isChecked;
      });
      updateSelectedCount();
  });

  // Update count when individual checkbox changes
  document.querySelectorAll('.student-checkbox').forEach(checkbox => {
      checkbox.addEventListener('change', updateSelectedCount);
  });

  function updateSelectedCount() {
      const count = document.querySelectorAll('.student-checkbox:checked').length;
      document.getElementById('selectedCount').textContent = count;
      
      // Update Select All checkbox state
      const totalCheckboxes = document.querySelectorAll('.student-checkbox').length;
      const selectAllCheckbox = document.getElementById('selectAll');
      selectAllCheckbox.checked = count === totalCheckboxes && count > 0;
  }

  // Form submission
  document.getElementById('notificationForm').addEventListener('submit', function(e) {
      e.preventDefault();

      const message = document.getElementById('notificationText').value.trim();
      const selectedCheckboxes = document.querySelectorAll('.student-checkbox:checked');
      
      let selectedStudents = [];
      selectedCheckboxes.forEach(cb => {
          selectedStudents.push(cb.value);
      });

      // Validation
      if (selectedStudents.length === 0) {
          showError('Please select at least one student!');
          return;
      }

      if (!message) {
          showError('Please enter a notification message!');
          return;
      }

      // Disable button
      const sendBtn = document.getElementById('sendBtn');
      sendBtn.disabled = true;
      sendBtn.textContent = 'Sending...';

      // Send AJAX request
      fetch('{{ route("teacher.notifications.send") }}', {
          method: 'POST',
          headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
              'Accept': 'application/json'
          },
          body: JSON.stringify({
              message: message,
              students: selectedStudents
          })
      })
      .then(response => response.json())
      .then(data => {
          if (data.success) {
              showSuccess(data.message || 'Notifications sent successfully!');
              
              // Reset form
              document.getElementById('notificationText').value = '';
              document.querySelectorAll('.student-checkbox').forEach(cb => cb.checked = false);
              document.getElementById('selectAll').checked = false;
              updateSelectedCount();
          } else {
              showError(data.message || 'Failed to send notifications.');
          }
      })
      .catch(error => {
          console.error('Error:', error);
          showError('An error occurred. Please try again.');
      })
      .finally(() => {
          // Re-enable button
          sendBtn.disabled = false;
          sendBtn.textContent = 'Send Notification';
      });
  });

  function showSuccess(message) {
      const successDiv = document.getElementById('successMessage');
      successDiv.textContent = '✓ ' + message;
      successDiv.style.display = 'block';
      
      setTimeout(() => {
          successDiv.style.display = 'none';
      }, 4000);
  }

  function showError(message) {
      const errorDiv = document.getElementById('errorMessage');
      errorDiv.textContent = '✗ ' + message;
      errorDiv.style.display = 'block';
      
      setTimeout(() => {
          errorDiv.style.display = 'none';
      }, 4000);
  }

  // Initialize count on page load
  updateSelectedCount();
</script>
@endpush
@endsection