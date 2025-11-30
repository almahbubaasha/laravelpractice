@extends('teacher.layout')

@push('styles')
<style>
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f5f7fa;
    color: #2c3e50;
    line-height: 1.6;
    min-height: 100vh;
    padding: 100px 20px 40px;
}

.container {
    background: white;
    max-width: 1000px;
    margin: 0 auto;
    border-radius: 15px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    padding: 30px 25px;
}

h1, h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 30px;
}

.alert {
    padding: 12px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 500;
}

.alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

.alert-error {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

.queries-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 3px solid #ecf0f1;
}

.queries-header h2 {
    margin: 0;
    font-size: 24px;
}

.total-queries {
    background: #3498db;
    color: white;
    padding: 8px 20px;
    border-radius: 25px;
    font-size: 15px;
    font-weight: 600;
}

.query-item {
    background: #f9f9f9;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 25px;
    border: 1px solid #ecf0f1;
    transition: box-shadow 0.3s;
}

.query-item:hover {
    box-shadow: 0 4px 12px rgba(0,0,0,0.1);
}

.query-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
    padding-bottom: 15px;
    border-bottom: 2px solid #ecf0f1;
    flex-wrap: wrap;
    gap: 10px;
}

.student-info {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: wrap;
}

.student-name {
    background: #3498db;
    color: white;
    padding: 6px 16px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.student-id {
    background: #95a5a6;
    color: white;
    padding: 5px 14px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.time-badge {
    color: #7f8c8d;
    font-size: 13px;
    display: flex;
    align-items: center;
    gap: 5px;
}

.delete-query-btn {
    background: #e74c3c;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.3s;
}

.delete-query-btn:hover {
    background: #c0392b;
}

.query-content {
    margin: 15px 0;
}

.query-label {
    color: #7f8c8d;
    font-size: 13px;
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
}

.query-text {
    font-size: 15px;
    color: #2c3e50;
    line-height: 1.7;
    background: white;
    padding: 18px;
    border-radius: 10px;
    border-left: 4px solid #3498db;
    box-shadow: 0 1px 3px rgba(0,0,0,0.05);
}

.reply-section {
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px dashed #ecf0f1;
}

.existing-reply {
    background: #e8f5e9;
    padding: 18px;
    border-left: 4px solid #27ae60;
    border-radius: 10px;
    margin-bottom: 15px;
}

.reply-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
}

.reply-label {
    color: #27ae60;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}

.reply-time {
    color: #7f8c8d;
    font-size: 12px;
}

.reply-text {
    font-size: 14px;
    color: #2c3e50;
    line-height: 1.6;
    margin-bottom: 12px;
}

.delete-reply-btn {
    background: transparent;
    color: #e74c3c;
    border: 1px solid #e74c3c;
    padding: 5px 12px;
    border-radius: 6px;
    cursor: pointer;
    font-size: 12px;
    transition: all 0.3s;
}

.delete-reply-btn:hover {
    background: #e74c3c;
    color: white;
}

.reply-form {
    background: #f8f9fa;
    padding: 18px;
    border-radius: 10px;
    border: 1px solid #ecf0f1;
}

.reply-form-header {
    color: #2c3e50;
    margin-bottom: 12px;
    font-size: 14px;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 8px;
}

.reply-form textarea {
    width: 100%;
    padding: 12px;
    border-radius: 10px;
    border: 1.5px solid #ecf0f1;
    resize: vertical;
    min-height: 90px;
    font-size: 14px;
    margin-bottom: 12px;
    font-family: inherit;
    transition: border-color 0.3s;
}

.reply-form textarea:focus {
    outline: none;
    border-color: #27ae60;
}

.reply-form button {
    width: 100%;
    padding: 12px;
    background: #27ae60;
    color: white;
    border: none;
    border-radius: 10px;
    cursor: pointer;
    font-weight: 600;
    font-size: 14px;
    transition: background 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.reply-form button:hover {
    background: #229954;
}

.empty-state {
    text-align: center;
    padding: 70px 20px;
    color: #95a5a6;
}

.empty-state i {
    font-size: 80px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state p {
    font-size: 16px;
    margin-top: 10px;
}

.status-indicator {
    display: inline-block;
    width: 8px;
    height: 8px;
    background: #27ae60;
    border-radius: 50%;
    margin-right: 5px;
    animation: pulse 2s infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}

.no-reply-indicator {
    background: #fff3cd;
    border-left: 4px solid #ffc107;
    padding: 12px 15px;
    border-radius: 8px;
    color: #856404;
    font-size: 14px;
    margin-bottom: 15px;
    display: flex;
    align-items: center;
    gap: 8px;
}
</style>
@endpush

@section('content')
<div class="container">
    
    <div class="queries-header">
        <h2>📚 Student Queries</h2>
        <span class="total-queries">{{ $queries->count() }} {{ $queries->count() == 1 ? 'Query' : 'Queries' }}</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">
            ❌ {{ session('error') }}
        </div>
    @endif

    @forelse($queries as $query)
        <div class="query-item">
            <div class="query-header">
                <div class="student-info">
                    <span class="student-name">👤 Student: {{ $query->student_identifier }}</span>
                    <span class="time-badge">
                        🕒 {{ $query->created_at->format('M d, Y - h:i A') }}
                    </span>
                </div>
                <form action="{{ route('teacher.student.queries.destroy', $query->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="delete-query-btn"
                        onclick="return confirm('Are you sure you want to delete this query and its reply?')"
                    >
                        🗑️ Delete Query
                    </button>
                </form>
            </div>

            <div class="query-content">
                <span class="query-label">STUDENT QUESTION:</span>
                <div class="query-text">
                    {{ $query->query }}
                </div>
            </div>

            <div class="reply-section">
                
                @if($query->reply)
                    <div class="existing-reply">
                        <div class="reply-header">
                            <span class="reply-label">
                                <span class="status-indicator"></span>
                                Your Reply:
                            </span>
                            <span class="reply-time">{{ $query->reply->created_at->format('M d, Y - h:i A') }}</span>
                        </div>
                        <div class="reply-text">
                            {{ $query->reply->reply }}
                        </div>
                        <form action="{{ route('teacher.student.queries.replies.destroy', $query->reply->id) }}" method="POST" style="margin: 0;">
                            @csrf
                            @method('DELETE')
                            <button 
                                type="submit" 
                                class="delete-reply-btn"
                                onclick="return confirm('Are you sure you want to delete this reply?')"
                            >
                                🗑️ Delete Reply
                            </button>
                        </form>
                    </div>
                @else
                    <div class="no-reply-indicator">
                        ⚠️ No reply sent yet to this student.
                    </div>
                @endif

                <div class="reply-form">
                    <div class="reply-form-header">
                        💬 {{ $query->reply ? 'Update Reply:' : 'Send Reply to Student ' . $query->student_identifier . ':' }}
                    </div>
                    <form action="{{ route('teacher.student.queries.reply', $query->id) }}" method="POST">
                        @csrf
                        <textarea 
                            name="reply" 
                            placeholder="Type your reply here..." 
                            required
                        >{{ $query->reply->reply ?? '' }}</textarea>
                        @error('reply')
                            <p style="color: #e74c3c; font-size: 13px; margin-top: -8px; margin-bottom: 10px;">{{ $message }}</p>
                        @enderror
                        <button type="submit">
                            📤 {{ $query->reply ? 'Update Reply' : 'Send Reply' }}
                        </button>
                    </form>
                </div>

            </div>
        </div>
    @empty
        <div class="empty-state">
            <i>📭</i>
            <p>No student queries yet. Students will see their queries here once submitted.</p>
        </div>
    @endforelse

</div>
@endsection