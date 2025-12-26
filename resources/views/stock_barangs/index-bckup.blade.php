<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock Barangs</title>
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />
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

    /* Sidebar Styles */
    .sidebar {
      position: fixed;
      left: 0;
      top: 0;
      width: 260px;
      height: 100vh;
      background: #2c3e50;
      color: #ecf0f1;
      overflow-y: auto;
      z-index: 1000;
      display: flex;
      flex-direction: column;
    }

    .sidebar-header {
      padding: 20px;
      background: #1a252f;
      border-bottom: 1px solid #34495e;
    }

    .sidebar-header h2 {
      color: #fff;
      font-size: 22px;
      font-weight: 600;
    }

    .sidebar-menu {
      flex: 1;
      padding: 20px 0;
    }

    .sidebar-menu ul {
      list-style: none;
    }

    .sidebar-menu li {
      margin: 5px 0;
    }

    .sidebar-menu a {
      display: flex;
      align-items: center;
      padding: 12px 20px;
      color: #ecf0f1;
      text-decoration: none;
      transition: all 0.3s ease;
      border-left: 3px solid transparent;
    }

    .sidebar-menu a:hover {
      background: #34495e;
      border-left-color: #3498db;
      padding-left: 25px;
    }

    .sidebar-menu a.active {
      background: #34495e;
      border-left-color: #3498db;
      font-weight: 600;
    }

    .sidebar-menu a i {
      margin-right: 12px;
      width: 20px;
      text-align: center;
    }

    .sidebar-footer {
      padding: 20px;
      background: #1a252f;
      border-top: 1px solid #34495e;
    }

    .user-profile {
      display: flex;
      align-items: center;
      gap: 12px;
    }

    .user-avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      background: #3498db;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: 600;
      font-size: 16px;
    }

    .user-info p {
      margin: 0;
      font-size: 14px;
    }

    .user-info .user-name {
      font-weight: 600;
      color: #fff;
    }

    .user-info .user-email {
      font-size: 12px;
      color: #95a5a6;
    }

    /* Main Content with Sidebar */
    .main-wrapper {
      margin-left: 260px;
      min-height: 100vh;
      padding: 20px;
    }

    .container { 
      max-width: 1400px; 
      margin: 0 auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    h1 {
      color: #333;
      margin-bottom: 20px;
      font-size: 28px;
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
      margin-left: 10px;
    }

    .btn-secondary:hover {
      background: #545b62;
    }

    /* Filter Section Styles */
    .filter-section {
      background: #f8f9fa;
      padding: 20px;
      border-radius: 8px;
      margin: 20px 0;
      border: 1px solid #e0e0e0;
    }

    .filter-title {
      font-size: 18px;
      font-weight: 600;
      color: #333;
      margin-bottom: 15px;
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .filter-form {
      display: flex;
      gap: 15px;
      align-items: flex-end;
      flex-wrap: wrap;
    }

    .filter-group {
      flex: 1;
      min-width: 200px;
    }

    .filter-label {
      display: block;
      font-size: 14px;
      font-weight: 500;
      color: #555;
      margin-bottom: 8px;
    }

    .filter-select {
      width: 100%;
      padding: 10px 12px;
      border: 2px solid #e0e0e0;
      border-radius: 5px;
      font-size: 14px;
      color: #333;
      background: #fff;
      transition: all 0.3s ease;
      cursor: pointer;
    }

    .filter-select:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
    }

    .filter-select:disabled {
      background: #f5f5f5;
      cursor: not-allowed;
      opacity: 0.6;
    }

    .filter-buttons {
      display: flex;
      gap: 10px;
    }

    .active-filter {
      background: #e7f3ff;
      padding: 10px 15px;
      border-radius: 5px;
      margin-top: 15px;
      border-left: 4px solid #007bff;
    }

    .active-filter-text {
      font-size: 14px;
      color: #333;
    }

    .active-filter-text strong {
      color: #007bff;
    }

    .table-wrapper {
      overflow-x: auto;
      margin-top: 20px;
    }

    table { 
      width: 100%; 
      border-collapse: collapse;
      background: #fff;
    }

    th, td { 
      padding: 12px 15px; 
      border: 1px solid #e0e0e0;
      text-align: left;
    }

    th { 
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      font-weight: 600;
      text-transform: uppercase;
      font-size: 12px;
      letter-spacing: 0.5px;
    }

    tbody tr {
      transition: all 0.3s ease;
    }

    tbody tr:nth-child(even) {
      background: #f8f9fa;
    }

    tbody tr:hover {
      background: #e3f2fd;
      transform: scale(1.01);
      box-shadow: 0 2px 5px rgba(0,0,0,0.1);
    }

    td {
      color: #555;
      font-size: 14px;
    }

    .actions {
      text-align: center;
      white-space: nowrap;
    }

    .icon-btn {
      display: inline-block;
      margin: 0 5px;
      transition: transform 0.3s ease;
    }

    .icon-btn:hover {
      transform: scale(1.2);
    }

    .icon-btn img {
      display: block;
      width: 24px;
      height: 24px;
      transition: all 0.3s ease;
    }

    /* Custom Pagination Styles */
    .pagination-wrapper {
      display: flex;
      flex-direction: column;
      align-items: center;
      margin-top: 30px;
      gap: 15px;
    }

    .pagination {
      display: flex;
      list-style: none;
      padding: 0;
      margin: 0;
      gap: 5px;
    }

    .page-item {
      display: inline-block;
    }

    .page-link {
      display: flex;
      align-items: center;
      justify-content: center;
      min-width: 40px;
      height: 40px;
      padding: 0 12px;
      text-decoration: none;
      color: #333;
      background: #fff;
      border: 2px solid #e0e0e0;
      border-radius: 8px;
      transition: all 0.3s ease;
      font-size: 14px;
      font-weight: 500;
    }

    .page-link:hover {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      border-color: #667eea;
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .page-item.active .page-link {
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: #fff;
      border-color: #667eea;
      font-weight: bold;
      box-shadow: 0 4px 12px rgba(102, 126, 234, 0.4);
    }

    .page-item.disabled .page-link {
      color: #999;
      background: #f5f5f5;
      border-color: #e0e0e0;
      cursor: not-allowed;
      opacity: 0.6;
    }

    .page-item.disabled .page-link:hover {
      background: #f5f5f5;
      color: #999;
      transform: none;
      box-shadow: none;
    }

    .pagination-info {
      text-align: center;
      color: #666;
      font-size: 14px;
      padding: 10px;
      background: #f8f9fa;
      border-radius: 5px;
      width: 100%;
      max-width: 400px;
    }

    /* No Data Message */
    .no-data {
      text-align: center;
      padding: 40px;
      color: #999;
      font-size: 16px;
    }

    /* Responsive */
    @media (max-width: 768px) {
      .sidebar {
        width: 100%;
        height: auto;
        position: relative;
      }

      .main-wrapper {
        margin-left: 0;
        padding: 10px;
      }

      .container {
        padding: 15px;
      }

      .filter-form {
        flex-direction: column;
      }

      .filter-group {
        width: 100%;
      }

      .filter-buttons {
        width: 100%;
      }

      .filter-buttons button {
        flex: 1;
      }

      table {
        font-size: 12px;
      }

      th, td {
        padding: 8px;
      }

      .pagination {
        flex-wrap: wrap;
        justify-content: center;
      }

      .page-link {
        min-width: 35px;
        height: 35px;
        font-size: 12px;
      }
    }
  </style>
</head>
<body>
  <!-- Sidebar -->
  <div class="sidebar">
    <div class="sidebar-header">
      <h2>PT XYZ</h2>
    </div>

    <nav class="sidebar-menu">
      <ul>
        <li>
          <a href="{{ url('/home') }}">
            <i>🏠</i>
            <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{ url('/home/stock-barangs') }}" class="active">
            <i>📦</i>
            <span>Stock Barang</span>
          </a>
        </li>
        <li>
          <a href="{{ url('/invoice/view') }}">
            <i>📊</i>
            <span>Invoice</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i>👥</i>
            <span>Users</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i>⚙️</i>
            <span>Settings</span>
          </a>
        </li>
      </ul>
    </nav>

    <div class="sidebar-footer">
      <div class="user-profile">
        <div class="user-avatar">A</div>
        <div class="user-info">
          <p class="user-name">Admin User</p>
          <p class="user-email">admin@example.com</p>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content -->
  <div class="main-wrapper">
    <div class="container">
      
      <h1>📦 Stock Barangs</h1>
      <p><a href="{{ url('/home/stock-barangs/create') }}" class="btn-primary">➕ Create New</a></p>

      <!-- Filter Section -->
      <div class="filter-section">
        <div class="filter-title">
          🔍 Filter Data
        </div>
        <form method="GET" action="{{ url('/home/stock-barangs') }}" class="filter-form">
          <div class="filter-group">
            <label class="filter-label" for="filter_by">Filter By</label>
            <select name="filter_by" id="filter_by" class="filter-select">
              <option value="">-- Select Filter Type --</option>
              <option value="kode_barang" {{ request('filter_by') == 'kode_barang' ? 'selected' : '' }}>Kode Barang</option>
              <option value="tanggal" {{ request('filter_by') == 'tanggal' ? 'selected' : '' }}>Tanggal (Bulan)</option>
            </select>
          </div>

          <div class="filter-group">
            <label class="filter-label" for="filter_value">Filter Value</label>
            <select name="filter_value" id="filter_value" class="filter-select" {{ !request('filter_by') ? 'disabled' : '' }}>
              <option value="">-- Select Value --</option>
              
              @if(request('filter_by') == 'kode_barang' && isset($kodeBarangList))
                @foreach($kodeBarangList as $kode)
                  <option value="{{ $kode }}" {{ request('filter_value') == $kode ? 'selected' : '' }}>
                    {{ $kode }}
                  </option>
                @endforeach
              @endif
              
              @if(request('filter_by') == 'tanggal' && isset($monthYearList))
                @foreach($monthYearList as $monthYear)
                  <option value="{{ $monthYear->month_year }}" {{ request('filter_value') == $monthYear->month_year ? 'selected' : '' }}>
                    {{ $monthYear->month_year_formatted }}
                  </option>
                @endforeach
              @endif
            </select>
          </div>

          <div class="filter-buttons">
            <button type="submit" class="btn-primary">🔍 Apply Filter</button>
            <a href="{{ url('/home/stock-barangs') }}" class="btn-secondary">🔄 Reset</a>
          </div>
        </form>

        @if(request('filter_by') && request('filter_value'))
        <div class="active-filter">
          <p class="active-filter-text">
            ✅ Active Filter: <strong>{{ ucfirst(str_replace('_', ' ', request('filter_by'))) }}</strong> = 
            <strong>
              @if(request('filter_by') == 'tanggal')
                {{ \Carbon\Carbon::parse(request('filter_value') . '-01')->format('F Y') }}
              @else
                {{ request('filter_value') }}
              @endif
            </strong>
          </p>
        </div>
        @endif
      </div>

      @if(isset($items) && $items->isEmpty())
        <p class="no-data">📭 No records found.</p>
      @else
        <div class="table-wrapper">
          <table>
            <thead>
              <tr>
                <th>#</th>
                <th>Kode</th>
                <th>Nama</th>
                <th>Satuan</th>
                <th>Harga Beli</th>
                <th>Harga Jual</th>
                <th>Stok Masuk</th>
                <th>Stok Keluar</th>
                <th>Tanggal</th>
                <th class="actions">Actions</th>
              </tr>
            </thead>
            <tbody>
            @if(isset($items))
            @foreach($items as $item)
              <tr>
                <td>{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                <td><strong>{{ $item->kode_barang }}</strong></td>
                <td>{{ $item->nama_barang }}</td>
                <td>{{ $item->satuan }}</td>
                <td>Rp {{ number_format($item->harga_beli_satuan ?? 0, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($item->harga_jual_satuan ?? 0, 0, ',', '.') }}</td>
                <td>{{ $item->stok_masuk }}</td>
                <td>{{ $item->stok_keluar }}</td>
                <td>{{ optional($item->tanggal)->format('d/m/Y H:i') }}</td>
                <td class="actions">
                  <a href="{{ url('/home/stock-barangs/'.$item->id) }}" class="icon-btn" title="View">
                    <img src="{{ asset('assets/images/svgs/view-icon.png') }}" 
                        data-hover="{{ asset('assets/images/svgs/view-icon-stroke.png') }}"
                        alt="View">
                  </a>
                  <a href="{{ url('/home/stock-barangs/'.$item->id.'/edit') }}" class="icon-btn" title="Edit">
                    <img src="{{ asset('assets/images/svgs/edit-icon.png') }}" 
                        data-hover="{{ asset('assets/images/svgs/edit-icon-stroke.png') }}"
                        alt="Edit">
                  </a>
                </td>
              </tr>
            @endforeach
            @endif
            </tbody>
          </table>
        </div>

        <!-- Custom Pagination -->
        @if ($items->hasPages())
        <nav class="pagination-wrapper">
          <ul class="pagination">
            {{-- Previous Page Link --}}
            @if ($items->onFirstPage())
              <li class="page-item disabled">
                <span class="page-link">‹ Previous</span>
              </li>
            @else
              <li class="page-item">
                <a class="page-link" href="{{ $items->appends(request()->query())->previousPageUrl() }}" rel="prev">‹ Previous</a>
              </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($items->getUrlRange(1, $items->lastPage()) as $page => $url)
              @if ($page == $items->currentPage())
                <li class="page-item active">
                  <span class="page-link">{{ $page }}</span>
                </li>
              @else
                <li class="page-item">
                  <a class="page-link" href="{{ $items->appends(request()->query())->url($page) }}">{{ $page }}</a>
                </li>
              @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($items->hasMorePages())
              <li class="page-item">
                <a class="page-link" href="{{ $items->appends(request()->query())->nextPageUrl() }}" rel="next">Next ›</a>
              </li>
            @else
              <li class="page-item disabled">
                <span class="page-link">Next ›</span>
              </li>
            @endif
          </ul>

          <!-- Pagination Info -->
          <div class="pagination-info">
            Showing <strong>{{ $items->firstItem() }}</strong> to <strong>{{ $items->lastItem() }}</strong> of <strong>{{ $items->total() }}</strong> entries
          </div>
        </nav>
        @endif
      @endif
    </div>
  </div>

  <script>
  // Icon Hover Effect
  document.addEventListener('DOMContentLoaded', function() {
    // Icon hover effect
    document.querySelectorAll('.icon-btn img').forEach(function(img) {
      const originalSrc = img.src;
      const hoverSrc = img.getAttribute('data-hover');
      
      img.addEventListener('mouseenter', function() {
        this.src = hoverSrc;
      });
      
      img.addEventListener('mouseleave', function() {
        this.src = originalSrc;
      });
    });

    // Filter dropdown logic
    const filterBy = document.getElementById('filter_by');
    const filterValue = document.getElementById('filter_value');
    
    // Data from PHP
    const kodeBarangList = @json($kodeBarangList ?? []);
    const monthYearList = @json($monthYearList ?? []);
    const currentFilterValue = '{{ request("filter_value") }}';

    function updateFilterValueOptions() {
      const selectedFilter = filterBy.value;
      
      // Clear existing options
      filterValue.innerHTML = '<option value="">-- Select Value --</option>';
      
      if (selectedFilter === '') {
        filterValue.disabled = true;
        filterValue.value = ''; // Clear the value
      } else {
        filterValue.disabled = false;
        
        if (selectedFilter === 'kode_barang') {
          // Add ALL kode barang options
          if (kodeBarangList && kodeBarangList.length > 0) {
            kodeBarangList.forEach(function(kode) {
              const option = document.createElement('option');
              option.value = kode;
              option.textContent = kode;
              if (kode === currentFilterValue) {
                option.selected = true;
              }
              filterValue.appendChild(option);
            });
          }
        } else if (selectedFilter === 'tanggal') {
          // Add ALL month-year options
          if (monthYearList && monthYearList.length > 0) {
            monthYearList.forEach(function(item) {
              const option = document.createElement('option');
              option.value = item.month_year;
              option.textContent = item.month_year_formatted;
              if (item.month_year === currentFilterValue) {
                option.selected = true;
              }
              filterValue.appendChild(option);
            });
          }
        }
      }
    }

    // Listen to filter_by changes - clear filter_value when changing filter type
    filterBy.addEventListener('change', function() {
      // If user changes filter type, reset filter_value
      filterValue.value = '';
      updateFilterValueOptions();
    });

    // Listen to filter_value changes to auto-submit or reload
    filterValue.addEventListener('change', function() {
      // Auto-submit the form when a value is selected
      this.form.submit();
    });

    // Initialize on page load
    updateFilterValueOptions();
  });
  </script>
</body>
</html>