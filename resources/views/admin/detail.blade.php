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

        .no-hover {
            transition: none;
            /* Nonaktifkan transisi untuk hover */
        }

        .no-hover:hover {
            background-color: #FFFFFF;
            /* Tetap warna latar belakang putih saat hover */
            color: #dc3545;
            /* Pastikan warna teks tetap sesuai */
            border-color: #dc3545;
            /* Pastikan warna border tetap sesuai */
        }
    </style>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item d-inline-block w-auto"><a href="{{ url('admin/listofmedicines') }}"
                        class="no-underline" style="color: #888A88">
                        <h3>List of Medicines</h3>
                    </a></li>
                <li class="breadcrumb-item active d-inline-block w-auto" aria-current="page">
                    <h3>{{ $obat->nama_obat }}</h3>
                </li>
            </ol>
        </nav>

        <table class="table mt-4" style="width: 48%; height: 80%; border-collapse: collapse;">
            <thead>
                <tr>
                    <td scope="col" colspan="1" style="">Image</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th>
                        <img src="{{ asset('images/' . $obat->image) }}" alt="{{ $obat->nama_obat }}" class="img-fluid"
                            style="width: 30%">
                    </th>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-between" style="width: 100%;">
            <table class="table mt-4" style="width: 48%; height: 80%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <td scope="col" colspan="2" style="">Medicine</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" style="border: none;">{{ $obat->id }}</th>
                        <th scope="row" style="border: none; ">{{ $obat->jenis_obat }}</th>
                    </tr>
                    <tr>
                        <td scope="row" style="border: none;">Medicine ID</td>
                        <td scope="row" style="border: none;">Medicines Group</td>
                    </tr>
                </tbody>
            </table>


            <table class="table mt-4" style="width: 48%; height: 80%; border-collapse: collapse;">
                <thead>
                    <tr>
                        <td scope="col" colspan="3">Inventory in Qty</td>

                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row" style="border: none;">{{ $obat->stok }}</th>
                    </tr>
                    <tr>
                        <td scope="row" style="border: none;">Lifetime Supply</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="">
            <table class="table mt-4">
                <thead>
                    <tr>
                        <td scope="col">How to Use</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td scope="row" style="height: 60px">{{ $obat->deskripsi }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="d-flex" style="gap: 20px">
            <button type="button" class="btn btn-outline-danger no-hover" style="background-color: #FFFFFF"
                data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="fa-solid fa-trash"></i> Delete Medicine
            </button>
            <a href="{{ url('admin/editmedicine/' . $obat->id) }}" class="btn"
                style="background-color: #03A9F5; color: #FFFFFF"><i class="fa-solid fa-pencil"></i> Edit Details</a>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px;">
                <div class="modal-body p-4">
                    <button type="button" class="btn-close position-absolute top-0 end-0 m-3" data-bs-dismiss="modal"
                        aria-label="Close"></button>

                    <h3 class="text-center mb-4 mt-2">Delete Medicine?</h3>

                    <div class="d-flex justify-content-between gap-3">
                        <button type="button" class="btn flex-grow-1 py-2"
                            style="background-color: #808080; color: white; border-radius: 8px;" data-bs-dismiss="modal">
                            Cancel
                        </button>

                        <form action="{{ route('admin.deletemedicine', $obat->id) }}" method="POST" class="flex-grow-1">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn w-100 py-2"
                                style="background-color: #F0483E; color: white; border-radius: 8px;">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
