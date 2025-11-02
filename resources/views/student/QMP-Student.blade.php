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
    text-align: center;
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

.feedback {
    background: #eef9ff;
    padding: 10px 15px;
    border-left: 4px solid #3498db;
    border-radius: 8px;
    margin-top: 8px;
    font-size: 0.95rem;
    color: #2c3e50;
}
</style>
@endpush

@section('content')
<div class="container">
    <h1>My Queries</h1>

    <!-- Submit New Query -->
    <div class="section">
        <h2>Submit a Query</h2>
        <form action="{{ route('student.queries.store') }}" method="POST">
            @csrf
            <textarea name="query" placeholder="Enter your query..." required></textarea>
            <button type="submit">Submit Query</button>
        </form>
    </div>

    <!-- All submitted queries -->
    <div class="section">
        <h2>Previous Queries</h2>
        @foreach($queries as $q)
            <div class="query-item">
                <p><strong>You:</strong> {{ $q->query }}</p>
                <small>Submitted: {{ $q->created_at->diffForHumans() }}</small>

                @if($q->feedback)
                    <div class="feedback">
                        <strong>Teacher Feedback:</strong> {{ $q->feedback }}
                    </div>
                @else
                    <div class="feedback" style="font-style: italic; color: #777;">
                        No feedback yet.
                    </div>
                @endif
            </div>
        @endforeach
    </div>
</div>
@endsection
