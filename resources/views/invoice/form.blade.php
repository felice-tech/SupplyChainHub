@extends('layouts.default')

@section('title', 'Create Invoice')

@section('head')
<style>
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

  .btn-danger {
    padding: 10px 20px;
    background: #dc3545;
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

  .btn-danger:hover {
    background: #c82333;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(220,53,69,0.3);
  }

  .alert {
    padding: 15px;
    border-radius: 8px;
    margin-bottom: 20px;
    font-weight: 500;
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

  .current-values-info {
    background: #e7f3ff;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
    border-left: 4px solid #007bff;
  }

  .current-values-info p {
    margin: 5px 0;
    font-size: 14px;
    color: #333;
  }

  .current-values-info strong {
    color: #007bff;
  }

  .delete-section {
    display: flex;
    justify-content: flex-end;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 2px solid #e0e0e0;
  }

  .admin-note {
    flex-grow: 1;
    text-align: right;
    color: #888;
    font-size: 12px;
    padding-top: 10px;
  }

  @media (max-width: 768px) { 
    .form-grid { 
      grid-template-columns: 1fr;
      gap: 10px;
    }

    .field-error {
      grid-column: 1;
    }

    .page-container {
      padding: 15px;
    }

    .form-section {
      padding: 15px;
    }

    .form-actions {
      flex-direction: column;
    }

    .form-actions button,
    .form-actions a {
      width: 100%;
      text-align: center;
    }

    .admin-note {
      text-align: center;
    }
  }
</style>
@endsection


@section('content')
<div class="page-container">
    <div class="max-w-4xl mx-auto bg-white rounded-lg shadow-md p-6">
        <h1 class="text-3xl font-bold text-gray-800 mb-6">Invoice Generator</h1>
        
        <form action="{{ route('invoice.generate') }}" method="POST" id="invoiceForm">
            @csrf
            
            <!-- Informasi Tujuan -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Informasi Tujuan</h2>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_tujuan">
                        Nama Tujuan *
                    </label>
                    <input type="text" name="nama_tujuan" id="nama_tujuan" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Contoh: Estelle Darcy">
                </div>
                
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="alamat_tujuan">
                        Alamat Tujuan *
                    </label>
                    <textarea name="alamat_tujuan" id="alamat_tujuan" rows="3" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Contoh: 123 Anywhere St., Any City, ST 12345"></textarea>
                </div>
            </div>

            <!-- Items -->
            <div class="mb-6">
                <h2 class="text-xl font-semibold text-gray-700 mb-4">Item</h2>
                
                <div id="itemsContainer">
                    <div class="item-row mb-4 p-4 border rounded bg-gray-50">
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                            <div class="md:col-span-2">
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Nama Item *
                                </label>
                                <input type="text" name="items[0][name]" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                                    placeholder="Contoh: Pipa Galon">
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Quantity *
                                </label>
                                <input type="number" name="items[0][quantity]" min="1" value="1" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                            
                            <div>
                                <label class="block text-gray-700 text-sm font-bold mb-2">
                                    Unit Price (Rp) *
                                </label>
                                <input type="number" name="items[0][unit_price]" min="0" step="0.01" required
                                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                            </div>
                        </div>
                    </div>
                </div>
                
                <button type="button" onclick="addItem()" 
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    + Tambah Item
                </button>
            </div>

            <!-- Tax -->
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="tax">
                    Tax (%) *
                </label>
                <input type="number" name="tax" id="tax" value="10" min="0" max="100" step="0.01" required
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    placeholder="Contoh: 10">
            </div>

            <!-- Submit Button -->
            <div class="flex items-center justify-between">
                <button type="submit" 
                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded focus:outline-none focus:shadow-outline text-lg">
                    📄 Compress to PDF
                </button>
            </div>
        </form>
        <form>

        </form>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.tailwindcss.com">
    let itemCount = 1;

    function addItem() {
        const container = document.getElementById('itemsContainer');
        const newItem = document.createElement('div');
        newItem.className = 'item-row mb-4 p-4 border rounded bg-gray-50 relative';
        newItem.innerHTML = `
            <button type="button" onclick="removeItem(this)" 
                class="absolute top-2 right-2 bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded text-sm">
                X
            </button>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Nama Item *
                    </label>
                    <input type="text" name="items[${itemCount}][name]" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        placeholder="Contoh: Pipa Galon">
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Quantity *
                    </label>
                    <input type="number" name="items[${itemCount}][quantity]" min="1" value="1" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
                
                <div>
                    <label class="block text-gray-700 text-sm font-bold mb-2">
                        Unit Price (Rp) *
                    </label>
                    <input type="number" name="items[${itemCount}][unit_price]" min="0" step="0.01" required
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                </div>
            </div>
        `;
        container.appendChild(newItem);
        itemCount++;
    }

    function removeItem(button) {
        button.parentElement.remove();
    }
</script>
@endsection