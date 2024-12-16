<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin')</title>

    <style>
        body {
            font-family: "Poppins", sans-serif;
            color: #4F4F4F;
            background-color: ;
        }

        .main-sidebar {
            background: #4F4F4F;
            width: 250px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            overflow-y: auto;
        }

        .main-header {
            background-color: #ffffff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: calc(100% - 250px);
            /* Mengurangi lebar sidebar */
            position: fixed;
            left: 250px;
            top: 0;
            height: 70px;
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
            align-items: center;
        }

        .main-content {
            margin-left: 250px;
            padding-top: 20px;
            padding-left: 20px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.02);
        }


        .modal-content {
            border-radius: 10px;
        }

        .modal-header {
            background-color: #3498db;
            color: white;
        }

        .btn-close {
            background-color: white;
        }

        .main-footer {
            background-color: #f8f9fa;
            border-top: 1px solid #dee2e6;
            padding: 10px;
            text-align: center;
        }

        /* Mengatur background dan padding pada navbar */
        .custom-navbar {
            background-color: #d8e3d4;
            padding: 10px 20px;
            height: 70px;
            position: fixed;
            top: 0;
            width: calc(100% - 250px);
            left: 250px;
        }

        /* Mengatur teks hari ("Monday") */
        .custom-navbar .day {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        /* Mengatur teks tanggal dan waktu */
        .custom-navbar .date-time {
            font-size: 0.9rem;
            color: #333;
        }

        .sidebar a:hover {
            background-color: #A3B18A;
            /* Hover efek warna sage green */
            border-radius: 5px;
        }

        .nav-link.active {
            background-color: #A3B18A;
            /* Warna sage green */
            color: white;
        }

        .nav-link i {
            margin-right: 8px;
        }

        .sidebar-menu a:hover {
            background-color: #A3B18A;
            /* Hover efek warna sage green */
            color: white;
            /* Tetap warna putih saat di hover */
        }

        .nav-link:hover {
            color: white;
            /* Warna tetap putih saat di hover */
        }

        .nav-item a {
            color: white;
            /* Warna teks default untuk "Admin" */
        }

        .nav-item a:hover {
            color: white;
            /* Tetap putih saat di-hover */
        }

        .nav-sidebar .nav-item .nav-link {
            border-radius: 10px;
            transition: background-color 0.3s ease;
            color: white;
        }

        .sidebar-menu a {
            color: white;
        }

        .small-width {
            width: 200px;
            /* Sesuaikan dengan lebar yang kamu inginkan */
        }

        .no-underline {
            color: black;
            /* Warna hitam */
            text-decoration: none;
            /* Menghilangkan underline */
        }

        .no-underline:hover {
            color: black;
            /* Warna tetap hitam saat hover */
            text-decoration: none;
            /* Tetap tanpa underline saat hover */
        }

        .breadcrumb-item h3 {
            display: inline;
            margin: 0;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: ">";
        }

        .breadcrumb-item h3 {
            display: inline;
            margin: 0;
        }
    </style>

    <!-- Google Font: Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('css/adminlte.min.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="hold-transition sidebar-mini" style="background-color: #F4F1E3;">

    <aside class="main-sidebar" style="">
        <div class="d-flex justify-content-center align-items-center p-1"
            style="background-color: #9CAD8A; padding: 10px 20px; height: 70px;">
            <div class="logo-placeholder"></div>
            <img class="p--5" src="{{ asset('images/Logo.png') }}" alt="Logo Apotek" style="width: 70%">
        </div>

        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="#" class="nav-link my-4 d-flex justify-content-between align-items-center">
                    <span><i class="fa fa-user"></i> Admin</span>
                    <!-- Hanya ikon ini yang bisa diklik -->
                    <i class="fa-solid fa-ellipsis-vertical" id="popoverIcon" data-bs-toggle="popover"
                        data-bs-placement="bottom"></i>
                </a>
            </li>
        </ul>


        <nav class="sidebar-menu">
            <ul class="nav flex-column h-100">
                <li class="nav-item">
                    <a href="{{ url('admin/dashboard') }}"
                        class="nav-link {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                        <i class="fa fa-chart-line"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/listofmedicines') }}"
                        class="nav-link {{ request()->is('admin/listofmedicines') ? 'active' : '' }}">
                        <i class="fa fa-list"></i> List of Medicines
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/medicinegroups') }}"
                        class="nav-link {{ request()->is('admin/medicinegroups') ? 'active' : '' }}">
                        <i class="fa fa-medkit"></i> Medicine Groups
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('admin/usermanagement') }}"
                        class="nav-link {{ request()->is('admin/usermanagement') ? 'active' : '' }}">
                        <i class="fa fa-users-cog"></i> User Management
                    </a>
                </li>
            </ul>
            <ul class="nav flex-column mt-auto">
                <li class="nav-item">
                    <a href="/login" class="nav-link">
                        <i class="fa fa-sign-out-alt"></i> Logout
                    </a>
                </li>
            </ul>
        </nav>

    </aside>

    <nav class="navbar navbar-expand-lg custom-navbar">
        <div class="container-fluid justify-content-end">
            <div class="text-end">
                <div class="day" id="day">Monday</div>
                <div class="date-time" id="date-time">14 October 2024 - 23:04:23</div>
            </div>
        </div>
    </nav>


    <div class="main-content">
        <div class="content-wrapper">
            @yield('content')
        </div>
    </div>

    <!-- Scripts -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function updateTime() {
            var now = new Date();
            var days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];
            var day = days[now.getDay()];
            var date = now.toLocaleDateString('en-GB', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            });
            var time = now.toLocaleTimeString('en-GB');
            document.getElementById('day').innerText = day;
            document.getElementById('date-time').innerText = `${date} - ${time}`;
        }
        setInterval(updateTime, 1000);
        updateTime();
    </script>

</body>

</html>
