@extends('layouts.default')

@section('title', 'View User')

@section('head')
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .page-container {
    max-width: 900px;
    margin: 0 auto;
    background: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  }

  h1 {
    color: #333;
    margin-bottom: 10px;
    font-size: 28px;
    display: flex;
    align-items: center;
    gap: 10px;
  }

  .page-subtitle {
    color: #666;
    font-size: 14px;
    margin-bottom: 25px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e0e0e0;
  }

  .btn-primary {
    display: inline-block;
    padding: 10px 20px;
    background: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: 500;
    border: none;
    cursor: pointer;
    font-size: 14px;
  }

  .btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,123,255,0.3);
  }

  .btn-secondary {
    display: inline-block;
    padding: 10px 20px;
    background: #6c757d;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: 500;
    border: none;
    cursor: pointer;
    font-size: 14px;
  }

  .btn-secondary:hover {
    background: #545b62;
    transform: translateY(-2px);
  }

  .detail-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin: 20px 0;
    border: 1px solid #e0e0e0;
  }

  .detail-section-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #667eea;
  }

  .detail-grid {
    display: grid;
    grid-template-columns: 220px 1fr;
    gap: 18px;
    align-items: center;
  }

  .detail-row {
    display: contents;
  }

  .detail-label {
    font-weight: 600;
    color: #555;
    font-size: 14px;
  }

  .detail-value {
    color: #333;
    font-size: 14px;
    padding: 10px 12px;
    background: #fff;
    border: 2px solid #e0e0e0;
    border-radius: 5px;
  }

  .detail-value strong {
    color: #007bff;
  }

  .quantity-highlight {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 12px 20px;
    border-radius: 5px;
    font-weight: 600;
    text-align: center;
  }

  .action-buttons {
    display: flex;
    gap: 12px;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
  }

  @media (max-width: 768px) {
    .page-container {
      padding: 15px;
    }

    .detail-grid {
      grid-template-columns: 1fr;
      gap: 10px;
    }

    .detail-section {
      padding: 15px;
    }

    .action-buttons {
      flex-direction: column;
    }

    .action-buttons a {
      width: 100%;
      text-align: center;
    }
  }
</style>
@endsection

@section('content')
<div class="page-container">
  <h1>📄 User Details</h1>
  <p class="page-subtitle">View detailed information about this User</p>

  <div class="detail-section">
    <div class="detail-section-title">📦 User Information</div>
    <div class="detail-grid">
      
      <div class="detail-row">
        <div class="detail-label">ID</div>
        <div class="detail-value"><strong>{{ $item->id }}</strong></div>
      </div>

      <div class="detail-row">
        <div class="detail-label">Name</div>
        <div class="detail-value">{{ $item->name }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">Email</div>
        <div class="detail-value">{{ $item->email }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">Role</div>
        <div class="detail-value">{{ $item->role }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">Created at</div>
        <div class="detail-value">{{ $item->created_at }}</div>
      </div>

      <div class="detail-row">
        <div class="detail-label">Updated at</div>
        <div class="detail-value">{{ $item->updated_at }}</div>
      </div>

    </div>
  </div>

  <div class="action-buttons">
    <a href="{{ url('user-management') }}" class="btn-secondary">← Back to List</a>
    <a href="{{ url('user-management/'.$item->id.'/edit') }}" class="btn-primary">✏️ Edit</a>
  </div>
</div>
@endsection