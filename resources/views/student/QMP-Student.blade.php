@extends('student.layout')

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
    max-width: 900px;
    margin: 0 auto;
    border-radius: 15px;
    box-shadow: 0 4px 14px rgba(0,0,0,0.12);
    padding: 30px 25px;
}

h1, h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
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

.section {
    margin-bottom: 35px;
}

.submit-section {
    background: #f8f9fa;
    padding: 25px;
    border-radius: 12px;
    margin-bottom: 35px;
    border: 2px solid #ecf0f1;
}

.submit-section h3 {
    color: #2c3e50;
    margin-bottom: 15px;
    font-size: 18px;
}

form textarea {
    width: 100%;
    padding: 12px;
    margin: 10px 0;
    border-radius: 12px;
    border: 1.5px solid #ecf0f1;
    resize: vertical;
    min-height: 100px;
    font-size: 15px;
    font-family: inherit;
    transition: border-color 0.3s;
}

form textarea:focus {
    outline: none;
    border-color: #3498db;
}

form button {
    width: 100%;
    padding: 12px;
    background: #3498db;
    color: white;
    border: none;
    border-radius: 12px;
    cursor: pointer;
    font-weight: 600;
    margin-top: 5px;
    font-size: 15px;
    transition: background 0.3s;
}

form button:hover {
    background: #2c80bd;
}

.queries-list-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #ecf0f1;
}

.queries-list-header h3 {
    color: #2c3e50;
    margin: 0;
    font-size: 20px;
}

.query-count {
    background: #3498db;
    color: white;
    padding: 5px 15px;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
}

.query-item {
    background: #f9f9f9;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 20px;
    border: 1px solid #ecf0f1;
    transition: box-shadow 0.3s;
}

.query-item:hover {
    box-shadow: 0 2px 8px rgba(0,0,0,0.08);
}

.query-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 12px;
    padding-bottom: 12px;
    border-bottom: 2px solid #ecf0f1;
}

.query-meta {
    display: flex;
    align-items: center;
    gap: 10px;
}

.query-label {
    background: #3498db;
    color: white;
    padding: 4px 12px;
    border-radius: 20px;
    font-size: 13px;
    font-weight: 600;
}

.time-badge {
    color: #7f8c8d;
    font-size: 13px;
}

.delete-btn {
    background: #e74c3c;
    color: white;
    border: none;
    padding: 6px 14px;
    border-radius: 8px;
    cursor: pointer;
    font-size: 13px;
    font-weight: 600;
    transition: background 0.3s;
}

.delete-btn:hover {
    background: #c0392b;
}

.query-text {
    font-size: 15px;
    color: #2c3e50;
    margin: 12px 0;
    line-height: 1.7;
    background: white;
    padding: 15px;
    border-radius: 8px;
    border-left: 4px solid #3498db;
}

.reply-section {
    margin-top: 15px;
    padding-top: 15px;
    border-top: 2px dashed #ecf0f1;
}

.reply-header-label {
    color: #27ae60;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 8px;
}

.reply-header-label i {
    font-size: 16px;
}

.reply-item {
    background: #eef9ff;
    padding: 15px;
    border-left: 4px solid #27ae60;
    border-radius: 8px;
    margin-bottom: 10px;
}

.reply-meta {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
}

.reply-teacher {
    font-weight: 600;
    color: #27ae60;
    font-size: 14px;
}

.reply-time {
    color: #7f8c8d;
    font-size: 12px;
}

.reply-text {
    font-size: 14px;
    color: #2c3e50;
    line-height: 1.6;
    margin-bottom: 10px;
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

.no-reply {
    color: #95a5a6;
    font-style: italic;
    font-size: 14px;
    text-align: center;
    padding: 15px;
    background: #f8f9fa;
    border-radius: 8px;
}

.empty-state {
    text-align: center;
    padding: 60px 20px;
    color: #95a5a6;
}

.empty-state i {
    font-size: 70px;
    margin-bottom: 20px;
    opacity: 0.5;
}

.empty-state p {
    font-size: 16px;
    margin-top: 10px;
}

hr {
    border: none;
    height: 2px;
    background: #ecf0f1;
    margin: 30px 0;
}
</style>
@endpush

@section('content')
<div class="container">

    <h2>📝 My Queries</h2>

    <!-- Success/Error Messages -->
    @if(session('success'))
        <div class="alert alert-success">✅ {{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">❌ {{ session('error') }}</div>
    @endif

    <!-- Submit New Query Section -->
    <div class="submit-section">
        <h3>Submit New Query</h3>
        <form action="{{ route('student.queries.store') }}" method="POST">
            @csrf
            <label for="query" style="font-weight: 600; color: #2c3e50; margin-bottom: 5px; display: block;">Your Question:</label>
            <textarea 
                name="query" 
                id="query"
                placeholder="Type your question here..." 
                required
            ></textarea>
            @error('query')
                <p style="color: #e74c3c; font-size: 13px; margin-top: -8px;">{{ $message }}</p>
            @enderror
            <button type="submit">📤 Submit Query</button>
        </form>
    </div>

    <hr>

    <!-- Queries List -->
    <div class="queries-list-header">
        <h3>Previous Queries</h3>
        <span class="query-count">{{ $queries->count() }} {{ $queries->count() == 1 ? 'Query' : 'Queries' }}</span>
    </div>

    @forelse($queries as $query)
        <div class="query-item">
            <!-- Query Header -->
            <div class="query-header">
                <div class="query-meta">
                    <span class="query-label">Your Query</span>
                    <span class="time-badge">🕒 {{ $query->created_at->format('M d, Y - h:i A') }}</span>
                </div>
                <form action="{{ route('student.queries.destroy', $query->id) }}" method="POST" style="margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button 
                        type="submit" 
                        class="delete-btn"
                        onclick="return confirm('Are you sure you want to delete this query?')"
                    >
                        🗑️ Delete Query
                    </button>
                </form>
            </div>

            <!-- Query Text -->
            <div class="query-text">
                {{ $query->query }}
            </div>

            <!-- Reply Section -->
            <div class="reply-section">
                @if($query->reply)
                    <div class="reply-header-label">
                        <i>💬</i> Teacher's Reply:
                    </div>
                    <div class="reply-item">
                        <div class="reply-meta">
                            <span class="reply-teacher">👨‍🏫 Teacher</span>
                            <span class="reply-time">{{ $query->reply->created_at->format('M d, Y - h:i A') }}</span>
                        </div>
                        <div class="reply-text">
                            {{ $query->reply->reply }}
                        </div>
                        <form action="{{ route('student.queries.replies.destroy', $query->reply->id) }}" method="POST" style="margin: 0;">
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
                    <div class="no-reply">
                        ⏳ No reply yet from teacher. Please wait...
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="empty-state">
            <i>📭</i>
            <p>No queries yet. Submit your first question above!</p>
        </div>
    @endforelse

</div>
@endsection