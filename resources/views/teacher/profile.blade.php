@extends('teacher.layout')

@push('styles')

<title>Profile Page</title>
  <style>
    /* Reset & base */
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
      padding: 100px 20px 40px;
      text-align: center;
    }

    /* Header */
    .header {
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
    }

    /* Container */
    .container {
      background: white;
      max-width: 500px;
      margin: 0 auto;
      border-radius: 15px;
      box-shadow: 0 4px 14px rgba(0, 0, 0, 0.12);
      padding: 30px 25px;
      box-sizing: border-box;
      text-align: left;
    }

    h2 {
      font-size: 28px;
      color: #2c3e50;
      margin-bottom: 15px;
      font-weight: 600;
      text-align: center;
    }

    #role-info {
      font-size: 16px;
      color: #7f8c8d;
      margin-bottom: 25px;
      text-align: center;
    }

    /* Profile Picture */
    .profile-pic-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-bottom: 25px;
    }

    .profile-pic-container img {
      width: 120px;
      height: 120px;
      border-radius: 50%;
      object-fit: cover;
      border: 4px solid #3498db;
      box-shadow: 0 2px 8px rgba(52, 152, 219, 0.5);
      margin-bottom: 15px;
      transition: transform 0.3s ease;
    }

    .profile-pic-container img:hover {
      transform: scale(1.05);
      cursor: pointer;
    }

    .profile-pic-container input[type="file"] {
      cursor: pointer;
      font-size: 14px;
      color: #3498db;
      border: none;
      background: none;
      outline: none;
    }

    /* Form Inputs */
    form input,
    form textarea {
      width: 100%;
      padding: 14px 18px;
      margin: 12px 0;
      border: 1.5px solid #ecf0f1;
      border-radius: 12px;
      font-size: 16px;
      font-family: inherit;
      color: #2c3e50;
      box-shadow: inset 0 1px 4px rgba(0,0,0,0.07);
      transition: border-color 0.3s ease;
      resize: vertical;
    }

    form input:focus,
    form textarea:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 8px #3498db;
    }

    form input[readonly] {
      background: #ecf0f1;
      cursor: not-allowed;
    }

    /* Button */
    .btn {
      background: #3498db;
      color: white;
      border: none;
      padding: 14px 20px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 12px;
      cursor: pointer;
      width: 100%;
      box-shadow: 0 4px 10px rgba(52, 152, 219, 0.5);
      transition: background-color 0.3s ease, transform 0.2s ease;
      margin-top: 15px;
    }

    .btn:hover {
      background: #2c80bd;
      transform: translateY(-2px);
    }

    .alert {
      padding: 12px 15px;
      border-radius: 8px;
      margin-top: 15px;
      font-weight: 500;
    }

    .alert-success {
      background: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

  </style>

@endpush



@section('content')

<div class="header">Profile</div>

  <div class="container">
    <h2>Profile</h2>
    <p id="role-info">Role: <span id="userRole">Teacher</span></p>

   <form id="profileForm" action="{{ route('teacher.profile.save') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="hidden" id="user_id" name="user_id" value="{{ Auth::id() }}">

    <!-- Profile Picture Upload -->
    <div class="profile-pic-container">
      <img id="profilePic" src="{{ isset($profile->img) ? asset($profile->img) : 'https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=120&h=120&fit=crop' }}" alt="Profile Picture" />
      <input type="hidden" name="old_img" value="{{ $profile->img ?? '' }}">
      <input type="file" id="uploadPic" name="img" accept="image/*" />
    </div>


    <!-- Faculty ID (identifier from users table) -->
    <label for="faculty_id" style="font-weight: 600; color: #2c3e50; display: block; margin-bottom: 5px;">Faculty ID</label>
    <input type="text" 
           id="faculty_id"
           name="faculty_id" 
           value="{{ Auth::user()->identifier }}" 
           readonly 
           style="background: #ecf0f1; cursor: not-allowed;">

    <input type="text" id="name" name="full_name" placeholder="Full Name" value="{{ $profile->full_name ?? '' }}" required />
    <input type="email" id="email" name="email" placeholder="Email" value="{{ $profile->email ?? '' }}" required />
    <input type="text" id="department" name="department" placeholder="Department" value="{{ $profile->department ?? '' }}" />
    <textarea id="bio" name="short_bio" placeholder="Short Bio">{{ $profile->short_bio ?? '' }}</textarea>
    <input type="text" id="contact" name="contact" placeholder="Contact Number" value="{{ $profile->contact ?? '' }}" />

    <button class="btn" type="submit">Save Changes</button>
</form>

@if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
@endif

  </div>

<script>
// Preview image before upload
document.getElementById('uploadPic').addEventListener('change', function(e) {
    const file = e.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            document.getElementById('profilePic').src = e.target.result;
        }
        reader.readAsDataURL(file);
    }
});
</script>

@endsection