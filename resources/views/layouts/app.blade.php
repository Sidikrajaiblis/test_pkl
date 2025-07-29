<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Master Data</title>

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 220px;
            background-color: #343a40;
            color: white;
            padding-top: 60px;
        }
        .sidebar a {
            color: #fff;
            display: block;
            padding: 10px 20px;
            text-decoration: none;
        }
        .sidebar a:hover, .sidebar .active {
            background-color: #495057;
        }
        .content {
            margin-left: 220px;
            padding: 20px;
        }
    </style>

    @stack('styles')
</head>
<body>

    {{-- Sidebar --}}
    <div class="sidebar">
        <h5 class="text-center mb-4">Menu</h5>
        <a href="{{ route('wilayah.index') }}" class="{{ request()->is('wilayah*') ? 'active' : '' }}">Master wilayah</a>
        <a href="{{ route('kabupaten.index') }}" class="{{ request()->is('kabupaten*') ? 'active' : '' }}">Kabupaten</a>
        <a href="{{ route('kecamatan.index') }}" class="{{ request()->is('kecamatan*') ? 'active' : '' }}">Kecamatan</a>
        <a href="{{ route('logika.index') }}" class="{{ request()->is('logika*') ? 'active' : '' }}">Logika</a>
    </div>

    {{-- Konten --}}
    <div class="content">
        @yield('content')
    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html>
