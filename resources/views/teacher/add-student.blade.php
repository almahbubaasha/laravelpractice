@extends('teacher.layout')

@section('content')

<style>
/* .header {
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  height: 70px;
  background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%);
  color: white;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 24px;
  font-weight: 600;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
  z-index: 1000;
  gap: 70px
} */

.main-content {
  padding: 100px 20px 40px;
  max-width: 700px;
  margin: 0 auto;
}

.card {
  background: #fff;
  border-radius: 15px;
  box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
  padding: 25px;
  margin-bottom: 30px;
}

.alert {
  padding: 12px 15px;
  border-radius: 8px;
  margin-bottom: 15px;
  font-weight: 500;
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

form label {
  font-weight: 600;
  color: #2c3e50;
  display: block;
  margin-bottom: 8px;
}

form input[type="text"] {
  width: 100%;
  padding: 12px 15px;
  margin-bottom: 15px;
  border-radius: 10px;
  border: 1.5px solid #ecf0f1;
  font-size: 16px;
  box-sizing: border-box;
}

form input[type="text"]:focus {
  outline: none;
  border-color: #3498db;
}

form button.btn {
  background: #3498db;
  color: white;
  border: none;
  padding: 12px 20px;
  font-size: 16px;
  font-weight: 600;
  border-radius: 12px;
  cursor: pointer;
  width: 100%;
  transition: 0.3s;
}

form button.btn:hover {
  background: #2c80bd;
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(52, 152, 219, 0.4);
}

table {
  width: 100%;
  border-collapse: collapse;
  margin-top: 20px;
}

table th, table td {
  padding: 12px;
  border: 1px solid #ddd;
  text-align: left;
}

table th {
  background: #3498db;
  color: white;
  font-weight: 600;
}

table tbody tr:hover {
  background: #f8f9fa;
}

.no-students {
  text-align: center;
  padding: 30px;
  color: #7f8c8d;
  font-size: 16px;
}

.card-title {
  font-size: 20px;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 20px;
  padding-bottom: 10px;
  border-bottom: 2px solid #ecf0f1;
}

/* Student ID Link */
.student-id-link {
  color: #3498db;
  text-decoration: none;
  font-weight: 600;
  cursor: pointer;
  transition: color 0.3s;
}

.student-id-link:hover {
  color: #2c80bd;
  text-decoration: underline;
}

/* Modal Styles */
.modal {
  display: none;
  position: fixed;
  z-index: 2000;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, 0.5);
  animation: fadeIn 0.3s;
}

@keyframes fadeIn {
  from { opacity: 0; }
  to { opacity: 1; }
}

.modal-content {
  background-color: white;
  margin: 5% auto;
  padding: 30px;
  border-radius: 15px;
  width: 90%;
  max-width: 500px;
  box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
  animation: slideDown 0.3s;
}

@keyframes slideDown {
  from { transform: translateY(-50px); opacity: 0; }
  to { transform: translateY(0); opacity: 1; }
}

.close {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
  cursor: pointer;
  transition: color 0.3s;
}

.close:hover {
  color: #000;
}

.modal-header {
  font-size: 24px;
  font-weight: 600;
  color: #2c3e50;
  margin-bottom: 20px;
  text-align: center;
}

.profile-pic {
  width: 120px;
  height: 120px;
  border-radius: 50%;
  object-fit: cover;
  display: block;
  margin: 0 auto 20px;
  border: 4px solid #3498db;
  box-shadow: 0 4px 12px rgba(52, 152, 219, 0.3);
}

.profile-info {
  margin: 15px 0;
}

.info-label {
  font-size: 12px;
  color: #7f8c8d;
  text-transform: uppercase;
  font-weight: 600;
  margin-bottom: 5px;
}

.info-value {
  font-size: 16px;
  color: #2c3e50;
  padding: 10px;
  background: #f8f9fa;
  border-radius: 8px;
}
</style>

<div class="main-content">
    <div class="card">
        <div class="card-title">Add Student</div>

        @if(session('success'))
            <div class="alert alert-success">✓ {{ session('success') }}</div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">✗ {{ session('error') }}</div>
        @endif

        <form action="{{ route('teacher.add.student.store') }}" method="POST">
            @csrf
            <label>Enter Student ID:</label>
            <input 
                type="text" 
                name="student_id" 
                placeholder="e.g., 213-15-4346" 
                required 
                autocomplete="off"
            >
            <button class="btn" type="submit">Add Student</button>
        </form>
    </div>

    <div class="card">
        <div class="card-title">Student List ({{ $students->count() }})</div>
        
        @if($students->count() > 0)
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Student ID</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $index => $ts)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <a href="javascript:void(0)" 
                               class="student-id-link" 
                               onclick="showStudentProfile('{{ $ts->student_id }}')">
                                {{ $ts->student_id }}
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="no-students">
                <p>📋 No students assigned yet.</p>
                <p style="font-size: 14px; color: #95a5a6;">Add students using their Student ID above.</p>
            </div>
        @endif
    </div>
</div>

<!-- Student Profile Modal -->
<div id="studentModal" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <div class="modal-header">Student Profile</div>
        
        <img id="studentAvatar" src="" alt="Student Avatar" class="profile-pic">
        
        <div class="profile-info">
            <div class="info-label">Student ID</div>
            <div class="info-value" id="studentId">Loading...</div>
        </div>
        
        <div class="profile-info">
            <div class="info-label">Full Name</div>
            <div class="info-value" id="studentName">Loading...</div>
        </div>
        
        <div class="profile-info">
            <div class="info-label">Email</div>
            <div class="info-value" id="studentEmail">Loading...</div>
        </div>
        
        <div class="profile-info">
            <div class="info-label">Contact Number</div>
            <div class="info-value" id="studentContact">Loading...</div>
        </div>
        
        <div class="profile-info">
            <div class="info-label">Department</div>
            <div class="info-value" id="studentDepartment">Loading...</div>
        </div>
    </div>
</div>

<script>
function showStudentProfile(studentId) {
    // Show modal
    document.getElementById('studentModal').style.display = 'block';
    
    // Fetch student profile via AJAX
    fetch(`/teacher/student-profile/${studentId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                document.getElementById('studentId').textContent = data.student.identifier || data.student.user_id || 'N/A';
                document.getElementById('studentName').textContent = data.student.name || 'N/A';
                document.getElementById('studentEmail').textContent = data.student.email || 'N/A';
                document.getElementById('studentContact').textContent = data.student.contact || 'N/A';
                document.getElementById('studentDepartment').textContent = data.student.department || 'N/A';
                document.getElementById('studentAvatar').src = data.student.avatar 
                    ? `/` + data.student.avatar 
                    : '/default-avatar.png';
            } else {
                alert('Student profile not found!');
                closeModal();
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Error loading student profile!');
            closeModal();
        });
}

function closeModal() {
    document.getElementById('studentModal').style.display = 'none';
}

// Close modal when clicking outside
window.onclick = function(event) {
    const modal = document.getElementById('studentModal');
    if (event.target == modal) {
        closeModal();
    }
}
</script>

@endsection