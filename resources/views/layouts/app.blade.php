<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'PPDB Online') - SMK ANNUR</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            /* Warna utama dari logo SMK */
            --primary-color: #157e3a;      /* Hijau dari logo */
            --primary-light: #25b053;      /* Hijau terang */
            --primary-dark: #0a5525;       /* Hijau gelap */
            
            /* Warna aksen dari logo */
            --secondary-color: #ffd700;    /* Kuning emas dari logo */
            --secondary-light: #ffe347;    /* Kuning terang */
            --secondary-dark: #e0bc00;     /* Kuning gelap */
            
            /* Warna netral */
            --dark-color: #111111;         /* Hitam dari logo */
            --light-color: #ffffff;        /* Putih untuk kontras */
            --gray-light: #f4f6f8;         /* Abu-abu terang */
            --gray-medium: #e9ecef;        /* Abu-abu sedang */
            
            /* Warna tambahan modern */
            --accent-teal: #18bc9c;        /* Teal/turquoise */
            --accent-purple: #8e44ad;      /* Ungu */
            --accent-orange: #e67e22;      /* Oranye */
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gray-light);
            color: var(--dark-color);
        }

        .navbar {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1);
            padding: 0.8rem 1rem;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--light-color) !important;
            font-size: 1.3rem;
            letter-spacing: 0.5px;
        }
        
        .navbar-brand i {
            color: var(--secondary-color);
            margin-right: 8px;
        }
        
        .navbar-dark .navbar-nav .nav-link {
            color: var(--light-color);
            font-weight: 500;
            position: relative;
            padding: 0.5rem 1rem;
            margin: 0 0.2rem;
            transition: all 0.3s ease;
        }
        
        .navbar-dark .navbar-nav .nav-link:before {
            content: "";
            position: absolute;
            bottom: 0;
            left: 50%;
            right: 50%;
            height: 3px;
            background: var(--secondary-color);
            transition: all 0.3s ease;
            opacity: 0;
        }
        
        .navbar-dark .navbar-nav .nav-link:hover:before,
        .navbar-dark .navbar-nav .nav-link.active:before {
            left: 1rem;
            right: 1rem;
            opacity: 1;
        }
        
        .navbar-dark .navbar-nav .nav-link:hover {
            color: var(--secondary-light);
        }
        
        .navbar-dark .navbar-nav .nav-link.active {
            color: var(--secondary-color);
        }

        .footer {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            color: var(--light-color);
            padding: 2rem 0;
            margin-top: 3rem;
            box-shadow: 0 -4px 10px rgba(0, 0, 0, 0.1);
            position: relative;
        }
        
        .footer:before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary-color), var(--primary-light), var(--secondary-color));
        }

        .card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            margin-bottom: 20px;
            border: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }
        
        .card-header {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            padding: 1.2rem 1.5rem;
            font-weight: 600;
        }
        
        .card-header i {
            color: var(--secondary-color);
            margin-right: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border: none;
            box-shadow: 0 4px 10px rgba(21, 126, 58, 0.2);
            border-radius: 10px;
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary-color) 100%);
            box-shadow: 0 6px 15px rgba(21, 126, 58, 0.3);
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary-color) 0%, var(--secondary-dark) 100%);
            border: none;
            color: var(--dark-color);
            box-shadow: 0 4px 10px rgba(255, 215, 0, 0.2);
            border-radius: 10px;
            font-weight: 500;
            padding: 0.6rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, var(--secondary-dark) 0%, var(--secondary-color) 100%);
            box-shadow: 0 6px 15px rgba(255, 215, 0, 0.3);
            transform: translateY(-2px);
        }
        
        .btn-outline-primary {
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 10px;
            font-weight: 500;
            background-color: transparent;
            transition: all 0.3s ease;
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0 4px 10px rgba(21, 126, 58, 0.2);
        }
        
        .text-primary {
            color: var(--primary-color) !important;
        }
        
        .text-secondary {
            color: var(--secondary-color) !important;
        }
        
        .alert {
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
            border: none;
        }
        
        .alert-success {
            background-color: rgba(21, 126, 58, 0.1);
            border-left: 4px solid var(--primary-color);
            color: var(--primary-dark);
        }
        
        .alert-danger {
            background-color: rgba(231, 76, 60, 0.1);
            border-left: 4px solid #e74c3c;
            color: #c0392b;
        }
        
        .form-control {
            border-radius: 10px;
            padding: 0.6rem 1rem;
            border: 1px solid #e0e0e0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }
        
        .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(21, 126, 58, 0.15);
            border-color: var(--primary-light);
        }
        
        .form-label {
            font-weight: 500;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }
        
        a {
            color: var(--primary-color);
            transition: all 0.3s ease;
            text-decoration: none;
        }
        
        a:hover {
            color: var(--primary-dark);
            text-decoration: underline;
        }
        
        /* Scrollbar custom styling */
        ::-webkit-scrollbar {
            width: 10px;
        }
        
        ::-webkit-scrollbar-track {
            background: var(--gray-light);
        }
        
        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 5px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>
    @yield('styles')
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-school"></i>PPDB SMK ANNUR
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}"
                            href="{{ route('home') }}">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pendaftaran.create') ? 'active' : '' }}"
                            href="{{ route('pendaftaran.create') }}">Pendaftaran</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('pendaftaran.cek-status-form') ? 'active' : '' }}"
                            href="{{ route('pendaftaran.cek-status-form') }}">Cek Status</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">Login Admin</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <main class="py-4">
        <div class="container">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p class="mb-2">&copy; {{ date('Y') }} PPDB SMK ANNUR. Hak Cipta Dilindungi.</p>
                    <p class="small mb-0">PASIRPUTIH - SAWANGAN - KOTA DEPOK</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('scripts')
</body>

</html>