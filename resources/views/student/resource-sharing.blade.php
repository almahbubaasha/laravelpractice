@extends('student.layout')

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
    margin-bottom: 10px;
    color: #2c3e50;
    text-align: center;
  }

  #role-info {
    font-size: 16px;
    color: #7f8c8d;
    margin-bottom: 30px;
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

  .resources {
    margin-top: 10px;
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

  .teacher-info {
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
    padding: 60px 20px;
    color: #7f8c8d;
  }

  .empty-state-icon {
    font-size: 64px;
    margin-bottom: 20px;
    opacity: 0.5;
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
  <h2>Shared Resources</h2>
  <p id="role-info">Resources shared by your supervisor</p>

  <div id="successMessage" class="alert alert-success"></div>
  <div id="errorMessage" class="alert alert-danger"></div>

  <!-- Shared Resources -->
  <div class="resources">
    <h3>Available Resources</h3>
    <ul class="resource-list" id="resourceList">
      <li class="empty-state">Loading resources...</li>
    </ul>
  </div>
</div>

<script>
  // Load resources on page load
  document.addEventListener('DOMContentLoaded', function() {
    loadResources();
  });

  function loadResources() {
    fetch('{{ route("student.resources.list") }}')
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
              <div class="teacher-info"><strong>Shared by:</strong> Teacher</div>
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
          list.innerHTML = `
            <li class="empty-state">
              <div class="empty-state-icon">📚</div>
              <h3>No Resources Yet</h3>
              <p>Your supervisor hasn't shared any resources with you yet.</p>
            </li>
          `;
        }
      })
      .catch(error => {
        console.error('Error loading resources:', error);
        document.getElementById('resourceList').innerHTML = `
          <li class="empty-state">
            <p>Failed to load resources.</p>
          </li>
        `;
      });
  }

  function downloadResource(id) {
    window.location.href = `/student/resources/download/${id}`;
  }

  function deleteResource(id) {
    if (!confirm('Are you sure you want to delete this resource from your list?')) return;

    fetch(`/student/resources/${id}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
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