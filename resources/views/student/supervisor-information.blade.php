@extends('student.layout')

@push('styles')
<title>Supervisor Info</title>
<style>
    /* Reset & base */
    * { margin: 0; padding: 0; box-sizing: border-box; }
    body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f5f7fa; color: #333; line-height: 1.6; min-height: 100vh; padding: 100px 20px 40px; text-align: center; }

    /* Header */
    .header { position: fixed; top: 0; left: 0; right: 0; height: 70px; background: linear-gradient(135deg, #2c3e50 0%, #3498db 100%); color: white; display: flex; align-items: center; justify-content: center; font-size: 24px; font-weight: 600; box-shadow: 0 2px 10px rgba(0,0,0,0.1); z-index:1000; }

    /* Container */
    .container { background: white; max-width: 500px; margin: 0 auto; border-radius: 15px; box-shadow: 0 4px 14px rgba(0,0,0,0.12); padding: 30px 25px; text-align: left; }
    h2 { font-size: 28px; color: #2c3e50; margin-bottom: 15px; font-weight: 600; text-align: center; }
    #role-info { font-size: 16px; color: #7f8c8d; margin-bottom: 25px; text-align: center; }

    /* Profile Picture */
    .profile-pic-container { display: flex; flex-direction: column; align-items: center; margin-bottom: 25px; }
    .profile-pic-container img { width: 120px; height: 120px; border-radius: 50%; object-fit: cover; border: 4px solid #3498db; box-shadow: 0 2px 8px rgba(52,152,219,0.5); transition: transform 0.3s ease; }
    .profile-pic-container img:hover { transform: scale(1.05); }

    /* Info Display Fields */
    .info-group { margin: 15px 0; }
    .info-label { font-size: 12px; color: #7f8c8d; text-transform: uppercase; font-weight: 600; margin-bottom: 5px; display: block; }
    .info-field { width: 100%; padding: 14px 18px; border: 1.5px solid #ecf0f1; border-radius: 12px; font-size: 16px; font-family: inherit; color: #2c3e50; background: #f8f9fa; box-shadow: inset 0 1px 4px rgba(0,0,0,0.07); display: block; }

    /* No Supervisor Message */
    .no-supervisor { text-align: center; padding: 50px 20px; color: #95a5a6; }
    .no-supervisor-icon { font-size: 64px; margin-bottom: 20px; opacity: 0.5; }

    /* Responsive */
    @media (max-width: 600px) {
        .container { padding: 25px 15px; border-radius: 12px; }
        h2 { font-size: 24px; }
        .profile-pic-container img { width: 100px; height: 100px; }
        .info-field { font-size: 14px; padding: 12px 15px; }
    }
</style>
@endpush

@section('content')
<div class="header">Supervisor Info</div>

<div class="container">
    <h2>Supervisor Details</h2>
    <p id="role-info">Role: <span id="userRole">Supervisor</span></p>

    @if($supervisor)
        <!-- Profile Picture -->
        <div class="profile-pic-container">
            @if(!empty($supervisor->img))
                <img src="{{ asset($supervisor->img) }}" alt="Supervisor Picture">
            @else
                <img src="https://images.pexels.com/photos/220453/pexels-photo-220453.jpeg?auto=compress&cs=tinysrgb&w=120&h=120&fit=crop" alt="Supervisor Picture">
            @endif
        </div>

        <!-- Supervisor Details -->
        <div class="info-group">
            <label class="info-label">Faculty ID</label>
            <div class="info-field">{{ $supervisor->user->identifier ?? 'N/A' }}</div>
        </div>

        <div class="info-group">
            <label class="info-label">Full Name</label>
            <div class="info-field">{{ $supervisor->full_name }}</div>
        </div>

        <div class="info-group">
            <label class="info-label">Email</label>
            <div class="info-field">{{ $supervisor->email }}</div>
        </div>

        <div class="info-group">
            <label class="info-label">Department</label>
            <div class="info-field">{{ $supervisor->department }}</div>
        </div>

        <div class="info-group">
            <label class="info-label">Contact Number</label>
            <div class="info-field">{{ $supervisor->contact ?? 'N/A' }}</div>
        </div>
    @else
        <!-- No Supervisor Assigned -->
        <div class="no-supervisor">
            <div class="no-supervisor-icon">👤</div>
            <h3>No Supervisor Assigned</h3>
            <p style="margin-top: 10px;">Your supervisor information will appear here once assigned by a teacher.</p>
        </div>
    @endif
</div>
@endsection