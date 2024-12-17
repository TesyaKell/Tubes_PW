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
    </style>

    <div class="content">
        <div class="container-fluid">
            <div class="dashboard-header mb-5">
                <div class="d-flex justify-content-between">
                    <h1>List of Medicines ({{ $obats->count() }})</h1>
                    <a href="{{ url('admin/addmedicine') }}" type="button" class="btn"
                        style="height: 40px; background-color: #F0483E; color: #FFFFFF">
                        <i class="fa-solid fa-plus"></i> Add New Item
                    </a>
                </div>
                <h5>List of medicines available for sales.</h5>

                <div class="d-flex justify-content-between">
                    <form action="{{ url('admin/listofmedicines') }}" method="GET" style="width: 40%;">
                        <div style="position: relative;">
                            <input class="form-control" type="search" name="search"
                                placeholder="Search Medicine Inventory.." value="{{ request('search') }}"
                                aria-label="Search" style="width: 100%; background-color: #E3EBF3;">
                        </div>
                    </form>

                    <form action="{{ url('admin/listofmedicines') }}" method="GET">
                        <select name="jenis" class="form-select" onchange="this.form.submit()"
                            style="background-color: #FFFFFF; border: 1px solid #1D242E; min-width: 200px;">
                            <option value="">- Select Group -</option>
                            @foreach ($jenisObat as $jenis)
                                <option value="{{ $jenis }}" {{ request('jenis') == $jenis ? 'selected' : '' }}>
                                    {{ $jenis }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
                <table class="table mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Medicine Name</th>
                            <th scope="col">Medicine ID</th>
                            <th scope="col">Group Name</th>
                            <th scope="col">Stock in Qty</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @forelse ($obats as $obat)
                            <tr>
                                <td scope="row">{{ $obat->nama_obat }}</td>
                                <td>D06ID{{ $obat->id }}</td>
                                <td>{{ $obat->jenis_obat }}</td>
                                <td>{{ $obat->stok }}</td>
                                <td class="small-width">
                                    <a href="{{ url('admin/detail/' . $obat->id) }}" class="no-underline">View Full Detail
                                        <i class="fa-solid fa-angles-right"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Tidak ada data obat</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="d-flex justify-content-between mt-3">
                    <p><strong>Showing {{ $obats->firstItem() ?? 0 }} - {{ $obats->lastItem() ?? 0 }} result of
                            {{ $obats->total() }}</strong></p>
                    <div class="d-flex justify-content-between">
                        <a class="badge" style="background-color: #FFFFFF; color: #1D242E"
                            href="{{ $obats->appends(request()->query())->previousPageUrl() }}">
                            <i class="fa-solid fa-chevron-left"></i>
                        </a>
                        <p><strong>Page {{ $obats->currentPage() }}</strong></p>
                        <a class="badge" style="background-color: #FFFFFF; color: #1D242E"
                            href="{{ $obats->appends(request()->query())->nextPageUrl() }}">
                            <i class="fa-solid fa-chevron-right"></i>
                        </a>
                    </div>
                </div>
            </div>



        </div>
    </div>
@endsection
