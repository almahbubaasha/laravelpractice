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
        max-width: 700px;
        margin: 0 auto;
        border-radius: 15px;
        box-shadow: 0 4px 14px rgba(0,0,0,0.12);
        padding: 30px 25px;
        text-align: left;
    }

    h1, h2 {
        text-align: center;
        color: #2c3e50;
    }

    form textarea {
        width: 100%;
        padding: 12px;
        margin: 10px 0;
        border-radius: 12px;
        border: 1.5px solid #ecf0f1;
        resize: vertical;
        min-height: 80px;
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
    }

    form button:hover {
        background: #2c80bd;
    }

    .query-item {
        background: #f9f9f9;
        padding: 15px 20px;
        border-radius: 12px;
        margin-bottom: 15px;
        border: 1px solid #ecf0f1;
    }

    .feedback-box textarea {
        margin-top: 8px;
        width: 100%;
        min-height: 60px;
    }
</style>
@endpush

@section('content')
<div class="header">Query Management System</div>

<div class="container">
    <h1>All Queries</h1>

    @foreach($queries as $q)
    <div class="query-item">
        <p><strong>Query:</strong> {{ $q->query }}</p>
        <p><strong>Student ID:</strong> {{ $q->student_id }}</p>
        <small>Submitted: {{ $q->created_at->diffForHumans() }}</small>

        <form action="{{ route('teacher.queries.feedback', $q->id) }}" method="POST">
            @csrf
            <textarea name="feedback" placeholder="Write feedback here..." required>{{ $q->feedback }}</textarea>
            <button type="submit">Submit Feedback</button>
        </form>
    </div>
    @endforeach
</div>
@endsection
