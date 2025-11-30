@extends('teacher.layout')

@push('styles')
<title>Resource Sharing</title>
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fa;
    color: #2c3e50;
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
    max-width: 800px;
    margin: 0 auto;
    border-radius: 15px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    padding: 30px 25px;
    box-sizing: border-box;
    text-align: left;
  }

  h2 {
    font-size: 28px;
    font-weight: 700;
    margin-bottom: 25px;
    color: #2c3e50;
    text-align: center;
  }

  .alert {
    padding: 12px 18px;
    border-radius: 10px;
    margin-bottom: 20px;
    font-weight: 500;
    display: none;
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

  h3 {
    color: #2c3e50;
    margin-bottom: 18px;
    font-weight: 600;
    font-size: 20px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-weight: 600;
    margin-bottom: 8px;
    color: #2c3e50;
    font-size: 15px;
  }

  input[type="text"],
  input[type="url"],
  input[type="file"] {
    width: 100%;
    padding: 14px 18px;
    border: 1.5px solid #ecf0f1;
    border-radius: 12px;
    font-size: 16px;
    font-family: inherit;
    color: #2c3e50;
    box-shadow: inset 0 1px 4px rgba(0,0,0,0.07);
    transition: border-color 0.3s ease;
    box-sizing: border-box;
  }

  input[type="text"]:focus,
  input[type="url"]:focus {
    outline: none;
    border-color: #3498db;
    box-shadow: 0 0 8px rgba(52, 152, 219, 0.3);
  }

  input[type="file"] {
    padding: 10px;
    cursor: pointer;
  }

  .student-list-box {
    border: 1.5px solid #ecf0f1;
    padding: 0;
    border-radius: 12px;
    max-height: 300px;
    overflow-y: auto;
    background: #f8f9fa;
  }

  .student-item {
    display: flex;
    align-items: center;
    padding: 12px 15px;
    border-bottom: 1px solid #e9ecef;
    transition: background 0.2s;
  }
  
  .student-item:hover {
    background: #e3f2fd;
  }
  
  .student-item:last-child { 
    border-bottom: none; 
  }

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
    font-weight: normal;
  }

  .select-all-item {
    background: #e3f2fd;
    font-weight: 600 !important;
    border-bottom: 2px solid #3498db !important;
  }

  .selected-count {
    font-size: 14px;
    color: #7f8c8d;
    margin-top: 8px;
    font-weight: 500;
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
    box-shadow: 0 4px 10px rgba(52, 152, 219, 0.3);
    transition: all 0.3s ease;
    width: 100%;
    display: block;
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

  .resources {
    margin-top: 40px;
  }

  .resource-list {
    list-style: none;
    padding: 0;
    margin-top: 15px;
  }

  .resource-item {
    background: #fff;
    padding: 18px 20px;
    border-radius: 12px;
    margin-bottom: 15px;
    border-left: 6px solid #3498db;
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    transition: transform 0.2s;
  }

  .resource-item:hover {
    transform: translateX(5px);
  }

  .resource-title {
    font-weight: 600;
    color: #2c3e50;
    font-size: 17px;
    margin-bottom: 10px;
  }

  .resource-type {
    display: inline-block;
    padding: 4px 10px;
    border-radius: 6px;
    font-size: 12px;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .type-link {
    background: #3498db;
    color: white;
  }

  .type-file {
    background: #27ae60;
    color: white;
  }

  .resource-link {
    color: #3498db;
    text-decoration: none;
    display: block;
    margin: 8px 0;
    word-break: break-all;
    font-size: 14px;
  }

  .resource-link:hover {
    text-decoration: underline;
  }

  .resource-meta {
    font-size: 13px;
    color: #7f8c8d;
    margin: 8px 0;
  }

  .shared-with {
    font-size: 13px;
    color: #555;
    margin-top: 10px;
    padding: 10px;
    background: #f8f9fa;
    border-radius: 8px;
  }

  .resource-actions {
    margin-top: 12px;
    display: flex;
    gap: 10px;
  }

  .download-btn,
  .delete-btn {
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: all 0.3s ease;
    flex: 1;
  }

  .download-btn {
    background-color: #27ae60;
    color: white;
  }
  .download-btn:hover {
    background-color: #1e8449;
  }

  .delete-btn {
    background-color: #e74c3c;
    color: white;
  }
  .delete-btn:hover {
    background-color: #c0392b;
  }

  .empty-state {
    text-align: center;
    padding: 50px 20px;
    color: #7f8c8d;
  }

  @media (max-width: 700px) {
    .container {
      padding: 25px 15px;
    }
    .resource-actions {
      flex-direction: column;
    }
  }
</style>
@endpush

@section('content')
<div class="header">Resource Sharing</div>

<div class="container">
  <h2>Share Resources with Students</h2>

  <div id="successMessage" class="alert alert-success"></div>
  <div id="errorMessage" class="alert alert-danger"></div>

  <!-- Share Resource Form -->
  <div id="share-section">
    <h3>Share New Resource</h3>
    <form id="resourceForm" enctype="multipart/form-data">
      @csrf
      
      <div class="form-group">
        <label for="title">Resource Title</label>
        <input type="text" id="title" name="title" placeholder="Enter resource title" required />
      </div>

      <div class="form-group">
        <label for="link">Resource Link (Optional)</label>
        <input type="url" id="link" name="link" placeholder="https://example.com/resource" />
        <small style="color: #7f8c8d; font-size: 13px;">Leave empty if uploading a file</small>
      </div>

      <div class="form-group">
        <label for="file">Upload File (Optional)</label>
        <input type="file" id="file" name="file" />
        <small style="color: #7f8c8d; font-size: 13px;">All file types allowed, no size limit</small>
      </div>

      <div class="form-group">
        <label style="font-weight: 700; margin-bottom: 12px;">Select Students:</label>
        
        <div class="student-list-box">
          @if(isset($students) && $students->count() > 0)
            {{-- Select All Option --}}
            <div class="student-item select-all-item">
              <input type="checkbox" id="selectAll" class="select-all-checkbox">
              <label for="selectAll" style="font-weight: 600;">✓ Select All Students</label>
            </div>

            {{-- Individual Students --}}
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

      <button class="btn" type="submit" id="submitBtn">Share Resource</button>
    </form>
  </div>

  <!-- Shared Resources List -->
  <div class="resources">
    <h3>My Shared Resources</h3>
    <ul class="resource-list" id="resourceList">
      <li class="empty-state">Loading resources...</li>
    </ul>
  </div>
</div>

<script>
  // Select All functionality
  document.getElementById('selectAll')?.addEventListener('change', function(e) {
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
    
    const totalCheckboxes = document.querySelectorAll('.student-checkbox').length;
    const selectAllCheckbox = document.getElementById('selectAll');
    if (selectAllCheckbox) {
      selectAllCheckbox.checked = count === totalCheckboxes && count > 0;
    }
  }

  // Initialize
  updateSelectedCount();
  loadResources();

  // Form submission
  document.getElementById('resourceForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const formData = new FormData(this);
    const selectedStudents = [];
    document.querySelectorAll('.student-checkbox:checked').forEach(cb => {
      selectedStudents.push(cb.value);
    });

    if (selectedStudents.length === 0) {
      showError('Please select at least one student!');
      return;
    }

    formData.delete('students[]');
    selectedStudents.forEach(id => formData.append('students[]', id));

    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.textContent = 'Sharing...';

    fetch('{{ route("teacher.resources.share") }}', {
      method: 'POST',
      body: formData,
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showSuccess(data.message || 'Resource shared successfully!');
        document.getElementById('resourceForm').reset();
        document.querySelectorAll('.student-checkbox').forEach(cb => cb.checked = false);
        document.getElementById('selectAll').checked = false;
        updateSelectedCount();
        loadResources();
      } else {
        showError(data.message || 'Failed to share resource.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showError('An error occurred. Please try again.');
    })
    .finally(() => {
      submitBtn.disabled = false;
      submitBtn.textContent = 'Share Resource';
    });
  });

  function loadResources() {
    fetch('{{ route("teacher.resources.list") }}')
      .then(response => response.json())
      .then(data => {
        const list = document.getElementById('resourceList');
        list.innerHTML = '';

        if (data.resources && data.resources.length > 0) {
          data.resources.forEach(resource => {
            const li = document.createElement('li');
            li.className = 'resource-item';
            
            const type = resource.file_path ? 'file' : 'link';
            const typeClass = type === 'file' ? 'type-file' : 'type-link';
            const typeText = type === 'file' ? '📎 File' : '🔗 Link';

            li.innerHTML = `
              <div class="resource-title">${resource.resource_name}</div>
              <span class="resource-type ${typeClass}">${typeText}</span>
              ${resource.resource_link ? `<a href="${resource.resource_link}" target="_blank" class="resource-link">${resource.resource_link}</a>` : ''}
              ${resource.file_original_name ? `<div class="resource-meta">📄 ${resource.file_original_name}</div>` : ''}
              <div class="resource-meta">Shared on: ${formatDate(resource.created_at)}</div>
              <div class="resource-actions">
                ${type === 'file' ? 
                  `<button class="download-btn" onclick="downloadResource(${resource.id})">Download</button>` :
                  `<a href="${resource.resource_link}" target="_blank" class="download-btn" style="text-align:center; text-decoration:none; line-height:1;">Open Link</a>`
                }
                <button class="delete-btn" onclick="deleteResource(${resource.id})">Delete</button>
              </div>
            `;
            list.appendChild(li);
          });
        } else {
          list.innerHTML = '<li class="empty-state"><p>No resources shared yet.</p></li>';
        }
      })
      .catch(error => {
        console.error('Error loading resources:', error);
        document.getElementById('resourceList').innerHTML = '<li class="empty-state"><p>Failed to load resources.</p></li>';
      });
  }

  function downloadResource(id) {
    window.location.href = `/teacher/resources/download/${id}`;
  }

  function deleteResource(id) {
    if (!confirm('Are you sure you want to delete this resource?')) return;

    fetch(`/teacher/resources/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
        'Accept': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        showSuccess('Resource deleted successfully!');
        loadResources();
      } else {
        showError('Failed to delete resource.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      showError('An error occurred.');
    });
  }

  function showSuccess(message) {
    const div = document.getElementById('successMessage');
    div.textContent = '✓ ' + message;
    div.style.display = 'block';
    setTimeout(() => div.style.display = 'none', 4000);
  }

  function showError(message) {
    const div = document.getElementById('errorMessage');
    div.textContent = '✗ ' + message;
    div.style.display = 'block';
    setTimeout(() => div.style.display = 'none', 4000);
  }

  function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('en-US', { 
      year: 'numeric', 
      month: 'short', 
      day: 'numeric',
      hour: '2-digit',
      minute: '2-digit'
    });
  }
</script>
@endsection