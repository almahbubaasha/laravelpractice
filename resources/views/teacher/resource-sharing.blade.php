@extends('teacher.layout')

@push('styles')

<title>Resource Sharing</title>
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
      color: #2c3e50;
      line-height: 1.6;
      min-height: 100vh;
      padding: 100px 20px 40px;
      text-align: center;
    }

    /* Fixed Header */
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

    /* Container */
    .container {
      background: white;
      max-width: 700px;
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
      margin-bottom: 15px;
      color: #2c3e50;
      text-align: center;
    }

    #role-info {
      font-size: 16px;
      color: #7f8c8d;
      margin-bottom: 25px;
      text-align: center;
    }

    h3 {
      color: #3498db;
      margin-bottom: 18px;
      font-weight: 600;
    }

    form {
      margin-bottom: 30px;
    }

    input[type="text"],
    input[type="url"] {
      width: 100%;
      padding: 14px 18px;
      margin: 12px 0 18px 0;
      border: 1.5px solid #ecf0f1;
      border-radius: 12px;
      font-size: 16px;
      font-family: inherit;
      color: #2c3e50;
      box-shadow: inset 0 1px 4px rgba(0,0,0,0.07);
      transition: border-color 0.3s ease;
      box-sizing: border-box;
    }

    input[type="text"]:focus,
    input[type="url"]:focus {
      outline: none;
      border-color: #3498db;
      box-shadow: 0 0 8px #3498db;
    }

    button.btn {
      background: #3498db;
      color: white;
      border: none;
      padding: 14px 20px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 4px 10px rgba(52, 152, 219, 0.5);
      transition: background-color 0.3s ease, transform 0.2s ease;
      width: 100%;
      display: block;
      margin-top: 5px;
    }

    button.btn:hover {
      background: #2c80bd;
      transform: translateY(-2px);
    }

    /* Resource list */
    .resources {
      margin-top: 10px;
      text-align: left;
    }

    ul#resourceList {
      list-style: none;
      padding: 0;
      margin-top: 15px;
    }

    ul#resourceList li {
      background: #fff;
      padding: 15px 20px;
      border-radius: 12px;
      margin-bottom: 15px;
      border-left: 6px solid #3498db;
      box-shadow: inset 0 1px 3px rgba(0,0,0,0.05);
      display: flex;
      justify-content: space-between;
      align-items: center;
      font-weight: 600;
      color: #3498db;
      font-size: 16px;
    }

    ul#resourceList li a {
      color: #3498db;
      text-decoration: none;
      flex-grow: 1;
    }

    ul#resourceList li a:hover {
      text-decoration: underline;
    }

    /* Buttons inside list */
    .download-btn,
    .delete-btn {
      border: none;
      padding: 8px 14px;
      border-radius: 10px;
      cursor: pointer;
      font-weight: 600;
      font-size: 14px;
      margin-left: 12px;
      box-shadow: 0 3px 8px rgba(0,0,0,0.12);
      transition: background-color 0.3s ease;
      flex-shrink: 0;
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
      background-color: #b83227;
    }

    /* Responsive */
    @media (max-width: 700px) {
      .container {
        padding: 25px 15px;
        border-radius: 12px;
      }
      ul#resourceList li {
        flex-direction: column;
        align-items: flex-start;
      }
      .download-btn, .delete-btn {
        margin-left: 0;
        margin-top: 8px;
      }
    }
  </style>

@endpush


@section('content')
<div class="header">Resource Sharing</div>

  <div class="container">
    <h2>Resource Sharing</h2>
    <p id="role-info">Role: <strong id="userRole">Teacher/Student</strong></p>

    <!-- Upload Section (Visible for Teachers Only) -->
    <div id="upload-section">
      <h3>Upload Resource</h3>
      <form id="resourceForm">
        <input type="text" id="resourceTitle" placeholder="Resource Title" required />
        <input type="url" id="resourceLink" placeholder="Resource Link (Google Drive, PDF, etc.)" required />
        <button class="btn" type="submit">Upload</button>
      </form>
    </div>

    <!-- Shared Resources (Visible for Both Teachers & Students) -->
    <div class="resources">
      <h3>Shared Resources</h3>
      <ul id="resourceList">
        <!-- Example resource item -->
        <li>
          <a href="#" target="_blank" rel="noopener noreferrer">Sample Research Paper PDF</a>
          <button class="download-btn">Download</button>
          <button class="delete-btn">Delete</button>
        </li>
        <li>
          <a href="#" target="_blank" rel="noopener noreferrer">Thesis Guidelines Document</a>
          <button class="download-btn">Download</button>
          <button class="delete-btn">Delete</button>
        </li>
      </ul>
    </div>
  </div>
@endsection







