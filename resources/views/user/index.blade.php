@extends('layouts.default')

@section('title', 'User Management')

@section('head')
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  .page-container {
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
    align-users: center;
    gap: 8px;
  }

  .filter-form {
    display: flex;
    gap: 15px;
    align-users: flex-end;
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
    align-users: center;
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

  .no-data {
    text-align: center;
    padding: 40px;
    color: #999;
    font-size: 16px;
  }

  @media (max-width: 768px) {
    .page-container {
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
@endsection

@section('content')
<div class="page-container">
  <h1>📦 User Management</h1>
  <p><a href="{{ url('/user-management/create') }}" class="btn-primary">➕ Create New</a></p>


  @if(isset($users) && $users->isEmpty())
    <p class="no-data">📭 No records found.</p>
  @else
    <div class="table-wrapper">
      <table>
        <thead>
          <tr>
            <th>#</th>
            <th>Id</th>
            <th>Nama</th>
            <th>Email</th>
            <th>Password</th>
            <th>Role</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Actions</th>
          </tr>
        </thead>
        <tbody>
        @if(isset($users))
        @foreach($users as $item)
          <tr>
            <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
            <td><strong>{{ $item->id }}</strong></td>
            <td><strong>{{ $item->name }}</strong></td>
            <td>{{ $item->email }}</td>
            <td>{{ $item->password }}</td>
            <td>{{ $item->role }}</td>
            <td>{{ $item->created_at }}</td>
            <td>{{ $item->updated_at }}</td>
            <td class="actions">
              <a href="{{ url('/user-management/'.$item->id) }}" class="icon-btn" title="View">
                <img src="{{ asset('assets/images/svgs/view-icon.png') }}" 
                    data-hover="{{ asset('assets/images/svgs/view-icon-stroke.png') }}"
                    alt="View">
              </a>
              <a href="{{ url('/user-management/'.$item->id.'/edit') }}" class="icon-btn" title="Edit">
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
    @if ($users->hasPages())
    <nav class="pagination-wrapper">
      <ul class="pagination">
        {{-- Previous Page Link --}}
        @if ($users->onFirstPage())
          <li class="page-item disabled">
            <span class="page-link">‹ Previous</span>
          </li>
        @else
          <li class="page-item">
            <a class="page-link" href="{{ $users->appends(request()->query())->previousPageUrl() }}" rel="prev">‹ Previous</a>
          </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($users->getUrlRange(1, $users->lastPage()) as $page => $url)
          @if ($page == $users->currentPage())
            <li class="page-item active">
              <span class="page-link">{{ $page }}</span>
            </li>
          @else
            <li class="page-item">
              <a class="page-link" href="{{ $users->appends(request()->query())->url($page) }}">{{ $page }}</a>
            </li>
          @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($users->hasMorePages())
          <li class="page-item">
            <a class="page-link" href="{{ $users->appends(request()->query())->nextPageUrl() }}" rel="next">Next ›</a>
          </li>
        @else
          <li class="page-item disabled">
            <span class="page-link">Next ›</span>
          </li>
        @endif
      </ul>

      <!-- Pagination Info -->
      <div class="pagination-info">
        Showing <strong>{{ $users->firstItem() }}</strong> to <strong>{{ $users->lastItem() }}</strong> of <strong>{{ $users->total() }}</strong> entries
      </div>
    </nav>
    @endif
  @endif
</div>
@endsection

@section('scripts')
<script>
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
  
  const kodeBarangList = @json($kodeBarangList ?? []);
  const monthYearList = @json($monthYearList ?? []);
  const currentFilterValue = '{{ request("filter_value") }}';

  function updateFilterValueOptions() {
    const selectedFilter = filterBy.value;
    
    filterValue.innerHTML = '<option value="">-- Select Value --</option>';
    
    if (selectedFilter === '') {
      filterValue.disabled = true;
      filterValue.value = '';
    } else {
      filterValue.disabled = false;
      
      if (selectedFilter === 'kode_barang') {
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

  filterBy.addEventListener('change', function() {
    filterValue.value = '';
    updateFilterValueOptions();
  });

  filterValue.addEventListener('change', function() {
    this.form.submit();
  });

  updateFilterValueOptions();
});
</script>
@endsection