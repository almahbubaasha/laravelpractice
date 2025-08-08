@extends('student.layout')
@push('styles')
    <title>Query Management System</title>
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
            max-width: 600px;
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

        /* Form Inputs */
        form textarea {
            width: 100%;
            padding: 14px 18px;
            margin: 12px 0 18px 0;
            border: 1.5px solid #ecf0f1;
            border-radius: 12px;
            font-size: 16px;
            font-family: inherit;
            color: #2c3e50;
            box-shadow: inset 0 1px 4px rgba(0, 0, 0, 0.07);
            resize: vertical;
            min-height: 120px;
            transition: border-color 0.3s ease;
        }

        form textarea:focus {
            outline: none;
            border-color: #3498db;
            box-shadow: 0 0 8px #3498db;
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
        }

        .btn:hover {
            background: #2c80bd;
            transform: translateY(-2px);
        }

        /* Query List */
        .query-list {
            margin-top: 30px;
            text-align: left;
        }

        .query-item {
            background: #f9f9f9;
            padding: 15px 20px;
            border-radius: 12px;
            margin-bottom: 15px;
            border: 1px solid #ecf0f1;
            box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .container {
                padding: 25px 15px;
                border-radius: 12px;
            }

            h2 {
                font-size: 24px;
            }

            form textarea {
                font-size: 14px;
                padding: 12px 15px;
                min-height: 100px;
            }

            .btn {
                padding: 12px 16px;
                font-size: 14px;
            }
        }
    </style>
@endpush
@section('content')
    <div class="header">Query Management System</div>

    <div class="container">
        <h2>Query Management System</h2>
        <p id="role-info">Role: <strong>Student</strong></p>

        <!-- Student Section -->
        <div id="student-section">
            <h3>Submit a Query</h3>
            <form id="queryForm" action="#" method="post">
                <textarea id="queryInput" name="query" placeholder="Enter your query" required></textarea>
                <button class="btn" type="submit">Submit Query</button>
            </form>
        </div>

        <!-- Query list example -->
        <div class="query-list" id="queryList">
            <!-- Example query -->
            <!--
              <div class="query-item">
                <p><strong>Query:</strong> When is the next deadline?</p>
              </div>
              -->
        </div>
    </div>
@endsection
