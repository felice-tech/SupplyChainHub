<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>@yield('title', 'Laravel App')</title>
	<link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}">
	<link rel="stylesheet" href="{{ asset('assets/css/sidebar-styles.css') }}">
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
			max-width: 1400px; 
			margin: 0 auto;
		}

		.flash { 
			padding: 15px 20px; 
			border-radius: 8px; 
			margin-bottom: 20px;
			font-weight: 500;
		}
		
		.flash-success { 
			background: #d4edda; 
			border: 1px solid #c3e6cb;
			color: #155724;
		}
		
		.flash-error { 
			background: #f8d7da; 
			border: 1px solid #f5c6cb;
			color: #721c24;
		}
	</style>
	@yield('head')
</head>
<body>
	<!-- Sidebar Component -->
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
			@if(session('success'))
				<div class="flash flash-success">✓ {{ session('success') }}</div>
			@endif
			@if(session('error'))
				<div class="flash flash-error">✗ {{ session('error') }}</div>
			@endif

			@yield('content')
		</div>
	</div>

	<script src="{{ asset('assets/js/custom.js') }}"></script>
	@yield('scripts')
</body>
</html>