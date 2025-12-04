@extends('student.layout')

@push('styles')
<title>Notifications</title>
<meta name="csrf-token" content="{{ csrf_token() }}">
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
    padding: 100px 20px 40px;
    text-align: center;
  }

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

  .container {
    background: white;
    max-width: 700px;
    margin: 0 auto;
    border-radius: 10px;
    box-shadow: 0 2px 12px rgba(0, 0, 0, 0.12);
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

  .notifications h3 {
    font-size: 20px;
    color: #2c3e50;
    margin-bottom: 15px;
    font-weight: 600;
    text-align: left;
  }

  .latest-badge {
    display: inline-block;
    background: #3498db;
    color: white;
    padding: 4px 12px;
    border-radius: 15px;
    font-size: 12px;
    font-weight: 600;
    margin-left: 10px;
    vertical-align: middle;
  }

  ul#notificationList {
    list-style: none;
    padding: 0;
    margin: 0;
  }

  .notification-item {
    background: #fff;
    padding: 15px 20px;
    margin-bottom: 12px;
    border-left: 5px solid #3498db;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
    border-radius: 8px;
    font-size: 15px;
    color: #2c3e50;
    transition: all 0.3s ease;
  }

  .notification-item:hover {
    background-color: #f0f4fb;
    transform: translateX(5px);
  }

  .notification-content {
    line-height: 1.6;
  }

  .notification-time {
    font-size: 12px;
    color: #95a5a6;
    margin-top: 8px;
    display: flex;
    align-items: center;
    gap: 5px;
  }

  .notification-time::before {
    content: "🕐";
    font-size: 14px;
  }

  .no-notifications {
    text-align: center;
    color: #95a5a6;
    padding: 30px;
    font-size: 16px;
  }

  @media (max-width: 600px) {
    .container {
      padding: 25px 15px;
    }
    h2 {
      font-size: 24px;
    }
    .notification-item {
      font-size: 14px;
    }
  }
</style>
@endpush

@section('content')
<div class="header">Notifications</div>

<div class="container">
  <h2>Your Notifications</h2>
  <p id="role-info">Role: <span id="userRole">Student</span></p>
  
  <div class="notifications">
    <h3>Latest Notifications <span class="latest-badge">Last 5</span></h3>
    <ul id="notificationList">
      <li class="no-notifications">Loading notifications...</li>
    </ul>
  </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    loadNotifications();
});

function loadNotifications() {
    fetch('{{ route("student.notifications.list") }}')
        .then(response => response.json())
        .then(data => {
            const notificationList = document.getElementById('notificationList');
            notificationList.innerHTML = '';
            
            if (data.notifications && data.notifications.length > 0) {
                // Show only latest 5 notifications
                const latestNotifications = data.notifications.slice(0, 5);
                
                latestNotifications.forEach(notification => {
                    const li = document.createElement('li');
                    li.className = 'notification-item';
                    li.innerHTML = `
                        <div class="notification-content">
                            <div>${notification.message}</div>
                            <div class="notification-time">${formatDate(notification.created_at)}</div>
                        </div>
                    `;
                    notificationList.appendChild(li);
                });
            } else {
                notificationList.innerHTML = '<li class="no-notifications">No notifications yet.</li>';
            }
        })
        .catch(error => {
            console.error('Error loading notifications:', error);
            document.getElementById('notificationList').innerHTML = 
                '<li class="no-notifications">Failed to load notifications.</li>';
        });
}

function formatDate(dateString) {
    const date = new Date(dateString);
    const now = new Date();
    const diffTime = Math.abs(now - date);
    const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays === 0) {
        const diffHours = Math.floor(diffTime / (1000 * 60 * 60));
        if (diffHours === 0) {
            const diffMinutes = Math.floor(diffTime / (1000 * 60));
            return diffMinutes + ' minutes ago';
        }
        return diffHours + ' hours ago';
    } else if (diffDays === 1) {
        return 'Yesterday';
    } else if (diffDays < 7) {
        return diffDays + ' days ago';
    } else {
        return date.toLocaleDateString();
    }
}
</script>
@endpush