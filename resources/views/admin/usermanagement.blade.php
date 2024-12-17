
@extends('IndexAdmin')

@section('content')
    <style>
        /* Mengatur tampilan umum konten */
        body {
            font-family: Poppins, sans-serif;
            background-color: #D8DEC5;
            /* Warna sage green */
        }

        .content {
            padding: 20px;
        }

        /* Header Dashboard */
        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .dashboard-header h5 {
            font-weight: bold;
        }

        /* Kartu Data Utama */
        .card-custom {
            border: 1px solid #A3B18A;
            /* Warna sage untuk border */
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            margin-right: 20px;
            width: 300px;
        }

        .card-custom h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .card-custom h5 {
            font-size: 24px;
            font-weight: bold;
        }

        .card-custom i {
            font-size: 40px;
            margin-right: 15px;
        }

        /* Atur layout menjadi lebih fleksibel */
        .d-flex {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Inventory & Customers Section */
        .inventory-section {
            background-color: #A3B18A;
            padding: 20px;
            border-radius: 10px;
            margin-top: 40px;
        }

        .inventory-section h6 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .inventory-section .card {
            border-radius: 10px;
        }

        .go-link {
            text-align: right;
            font-size: 12px;
        }

        .go-link a {
            color: black;
            text-decoration: none;
        }

        p {
            margin: 0;
        }

        .small-width {
            width: 200px;
            /* Sesuaikan dengan lebar yang kamu inginkan */
        }

        .no-underline {
            color: #03A9F5;
            /* Warna biru */
            text-decoration: none;
            /* Menghilangkan underline */
        }

        .no-underline:hover {
            color: #03A9F5;
            /* Warna tetap biru saat hover */
            text-decoration: none;
            /* Tetap tanpa underline saat hover */
        }
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="dashboard-header mb-5">
                <h1>User Management</h1>
                <h5>List of User.</h5>

                <form action="{{ route('admin.users') }}" method="GET">
                    <div style="position: relative; width: 40%;">
                        <input class="form-control" type="search" name="search" 
                               placeholder="Search User By Name.." 
                               value="{{ request('search') }}"
                               aria-label="Search" 
                               style="width: 100%; background-color: #E3EBF3;">
                    </div>
                </form>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Costumer Id</th>
                            <th scope="col">Name</th>
                            <th scope="col">Address</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td scope="row">C{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->address }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone_number }}</td>
                                <td class="small-witdh">
                                    <a href="{{ url('admin/editprofile/' . $user->id) }}" class="no-underline">
                                        <i class="fa-solid fa-pencil"></i> Edit Profile
                                        <i class="fa-solid fa-angles-right"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <p><strong>Showing {{ $users->firstItem() }} - {{ $users->lastItem() }} result of
                            {{ $totalUsers }}</strong></p>
                    <div class="d-flex justify-content-between">
                        <a class="badge" style="background-color: #FFFFFF; color: #1D242E"
                            href="{{ $users->previousPageUrl() }}">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                        <p><strong>Page {{ $users->currentPage() }}</strong></p>
                        <a class="badge" style="background-color: #FFFFFF; color: #1D242E"
                            href="{{ $users->nextPageUrl() }}">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>


            </div>
        </div>
    @endsection
