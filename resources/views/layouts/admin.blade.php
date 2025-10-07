<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            display: flex;
            min-height: 100vh;
        }

        .sidebar {
            width: 250px;
            background: #343a40;
            color: white;
            min-height: 100vh;
        }

        .sidebar .nav-link {
            color: #adb5bd;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            color: white;
            background-color: #495057;
        }

        .content {
            flex-grow: 1;
            padding: 2rem;
        }
    </style>
</head>

<body>

    <div class="sidebar p-3">
        <h4>Admin Panel</h4>
        <hr class="text-secondary">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('bundles.*') ? 'active' : '' }}"
                    href="{{ route('bundles.index') }}">
                    <i class="fa-solid fa-box-open me-2"></i>Bundles
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('restos.*') ? 'active' : '' }}"
                    href="{{ route('restos.index') }}">
                    <i class="fa-solid fa-utensils me-2"></i>Restoran
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('destinasis.*') ? 'active' : '' }}"
                    href="{{ route('destinasis.index') }}">
                    <i class="fa-solid fa-map-location-dot me-2"></i>Destinasi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('penginapans.*') ? 'active' : '' }}"
                    href="{{ route('penginapans.index') }}">
                    <i class="fa-solid fa-hotel me-2"></i>Penginapan
                </a>
            </li>
            <li>
                <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit">Logout</button>
                </form>
            </li>
        </ul>
    </div>

    <div class="content">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>