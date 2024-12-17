@extends('IndexAdmin')

@section('content')
    @php
        // Debug untuk cek variable
        var_dump(isset($totalCustomers));
        var_dump($totalCustomers ?? 'tidak ada');
    @endphp

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
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="dashboard-header mb-5">
                <h1>Dashboard</h1>
                <h5>A quick data overview of the inventory</h5>
            </div>

            <!-- Bagian Kartu Data Utama -->
            <div class="d-flex">
                <div class="card-custom d-flex align-items-center p-3">
                    <i class="fa-solid fa-user"></i>
                    <div>
                        <h4>Total Customer</h4>
                        <h5>{{ $totalCustomers }}</h5>
                    </div>
                </div>
                <div class="card-custom d-flex align-items-center p-3">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <div>
                        <h4>Total Sales</h4>
                        <h5>536</h5>
                    </div>
                </div>
                <div class="card-custom d-flex align-items-center p-3">
                    <i class="fa-solid fa-money-bill"></i>
                    <div>
                        <h4>Total Profit</h4>
                        <h5>220</h5>
                    </div>
                </div>
            </div>

            <!-- Bagian Inventory & Customers -->
            <div class="row mt-5">
                <div class="col-md-6">
                    <div class="inventory-section p-3">
                        <div class="d-flex justify-content-between">
                            <h6>Inventory</h6>
                            <div class="go-link">
                                <a href="{{ url('admin/listofmedicines') }}">Go to Configuration >></a>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card text-center p-2">
                                    <p class="fs-4">{{ $totalObat }}</p>
                                    <p>Total no of Medicines</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card text-center p-2">
                                    <p class="fs-4">{{ $totalGroups }}</p>
                                    <p>Medicine Groups</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="inventory-section p-3">
                        <div class="d-flex justify-content-between">
                            <h6>Customers</h6>
                            <div class="go-link"><a href="{{ url('admin/usermanagement') }}">Go to Customers Page &gt;&gt;</a></div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="card text-center p-2">
                                    <p class="fs-4">845</p>
                                    <p>Total no of Customers</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card text-center p-2">
                                    <p class="fs-4">Adalimumab</p>
                                    <p>Frequently bought item</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
