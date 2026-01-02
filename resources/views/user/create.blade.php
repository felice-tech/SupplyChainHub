@extends('layouts.default')

@section('title', 'Create User')

@section('content')
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: #f8f9fa;
  }

  .container { 
    max-width: 900px; 
    margin: 20px auto;
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
    padding: 10px 24px;
    background: #007bff;
    color: #fff;
    border: none;
    border-radius: 5px;
    transition: all 0.3s ease;
    font-weight: 500;
    cursor: pointer;
    font-size: 14px;
  }

  .btn-primary:hover {
    background: #0056b3;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,123,255,0.3);
  }

  .btn-secondary {
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
    display: inline-block;
  }

  .btn-secondary:hover {
    background: #545b62;
    transform: translateY(-2px);
  }

  .alert {
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
  }

  .alert-success {
    background: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
  }

  .alert-danger {
    background: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
  }

  .alert-danger ul {
    margin: 10px 0 0 20px;
  }

  .form-section {
    background: #f8f9fa;
    border-radius: 8px;
    padding: 25px;
    margin: 20px 0;
    border: 1px solid #e0e0e0;
  }

  .form-section-title {
    font-size: 18px;
    font-weight: 600;
    color: #333;
    margin-bottom: 20px;
    padding-bottom: 10px;
    border-bottom: 2px solid #667eea;
  }

  .form-grid { 
    display: grid; 
    grid-template-columns: 220px 1fr; 
    gap: 18px; 
    align-items: center; 
  }

  .form-row { 
    display: contents;
  }

  .form-grid label { 
    font-weight: 600; 
    color: #555;
  }

  .field-error { 
    color: #dc3545; 
    font-size: 0.9em; 
    margin-top: 4px;
    grid-column: 2;
  }

  input[type="number"], 
  input[type="text"], 
  input[type="datetime-local"], 
  select, 
  textarea { 
    width: 100%; 
    padding: 10px 12px;
    box-sizing: border-box;
    border: 2px solid #e0e0e0;
    border-radius: 5px;
    font-size: 14px;
    color: #333;
    background: #fff;
    transition: all 0.3s ease;
  }

  input:focus, 
  select:focus, 
  textarea:focus {
    outline: none;
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
  }

  input[readonly] {
    background: #e9ecef;
    cursor: not-allowed;
  }

  textarea { 
    min-height: 90px;
    resize: vertical;
  }

  .radio-group {
    display: flex;
    gap: 15px;
  }

  .radio-group label {
    display: flex;
    align-items: center;
    gap: 8px;
    cursor: pointer;
    font-weight: 500;
    padding: 10px 20px;
    background: #fff;
    border: 2px solid #e0e0e0;
    border-radius: 5px;
    transition: all 0.3s ease;
  }

  .radio-group label:hover {
    border-color: #667eea;
    background: #f0f4ff;
  }

  .radio-group input[type="radio"] {
    width: auto;
    margin: 0;
  }

  .radio-group label:has(input:checked) {
    border-color: #667eea;
    background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%);
    font-weight: 600;
    color: #667eea;
  }

  .form-actions { 
    display: flex; 
    gap: 12px; 
    align-items: center;
    margin-top: 30px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
  }

  .quantity-display {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: #fff;
    padding: 12px 20px;
    border-radius: 5px;
    font-weight: 600;
    text-align: center;
  }

  @media (max-width: 768px) { 
    .form-grid { 
      grid-template-columns: 1fr;
      gap: 10px;
    }

    .field-error {
      grid-column: 1;
    }

    .container {
      padding: 15px;
    }

    .form-section {
      padding: 15px;
    }

    .radio-group {
      flex-direction: column;
    }

    .form-actions {
      flex-direction: column;
    }

    .form-actions button,
    .form-actions a {
      width: 100%;
      text-align: center;
    }
  }
</style>

<div class="container">
  <h1>➕ Create User</h1>
  <p class="page-subtitle">Add a new user to the system</p>

  @if(session('success'))
    <div class="alert alert-success">✅ {{ session('success') }}</div>
  @endif

  @if($errors->any())
    <div class="alert alert-danger">
      <strong>⚠️ Please fix the following errors:</strong>
      <ul>
        @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form action="{{ url('/user-management') }}" method="POST">
    @csrf
    

    <div class="form-section">
      <div class="form-section-title">📦 User Information</div>
      <div class="form-grid">
        <div class="form-row">
          <label>Nama Lengkap</label>
          <input type="text" name="name" value="{{ old('name') }}" required>
        </div>
        @error('name')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Email</label>
          <input type="text" name="email" value="{{ old('email') }}" required>
        </div>
        @error('email')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Password</label>
          <input type="password" name="password" required>
        </div>

        <div class="form-row">
          <label>Confirm Password</label>
          <input type="password" name="password_confirmation" required>
        </div>
        @error('password')<div class="field-error">{{ $message }}</div>@enderror

        <div class="form-row">
          <label>Role</label>
          <select name="role" required>
            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
          </select>
        </div>

      </div>
    </div>



    <div class="form-actions">
      <button type="submit" class="btn-primary">💾 Create</button>
      <a href="{{ url('/user-management') }}" class="btn-secondary">❌ Cancel</a>
    </div>
  </form>
</div>
@endsection

@section('scripts')
<script>
  function updateVisibility() {
    const movement = document.querySelector('input[name="movement"]:checked');
    const masukSection = document.getElementById('masuk-section');
    const keluarSection = document.getElementById('keluar-section');

    if (!movement) {
      if (masukSection) masukSection.style.display = 'none';
      if (keluarSection) keluarSection.style.display = 'none';
      return;
    }
    
    if (movement.value === 'masuk') {
      if (masukSection) masukSection.style.display = 'block';
      if (keluarSection) keluarSection.style.display = 'none';
    } else {
      if (masukSection) masukSection.style.display = 'none';
      if (keluarSection) keluarSection.style.display = 'block';
    }
    updateQuantity();
  }

  function updateQuantity() {
    const safe = (sel) => { 
      const el = document.querySelector(sel); 
      return el ? parseInt(el.value || 0, 10) : 0; 
    };
    
    const stokAwal = safe('input[name="stok_awal"]');
    const stokMasuk = safe('input[name="stok_masuk"]');
    const stokKeluar = safe('input[name="stok_keluar"]');
    const qty = stokAwal + stokMasuk - stokKeluar;
    const qEl = document.querySelector('input[name="quantity"]');
    if (qEl) qEl.value = qty;
  }

  document.addEventListener('change', function (e) {
    if (e.target.name === 'movement') updateVisibility();
    if (['stok_awal','stok_masuk','stok_keluar'].includes(e.target.name)) updateQuantity();
  });

  document.addEventListener('input', function (e) {
    if (['stok_awal','stok_masuk','stok_keluar'].includes(e.target.name)) updateQuantity();
  });

  // Initial setup
  updateVisibility();
  updateQuantity();
</script>
@endsection