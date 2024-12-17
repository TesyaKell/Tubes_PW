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

    <body>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item d-inline-block w-auto"><a href="{{ url('admin/listofmedicines') }}"
                            class="no-underline" style="color: #888A88">
                            <h3>List of Medicines</h3>
                        </a></li>
                    <li class="breadcrumb-item active d-inline-block w-auto" aria-current="page">
                        <h3>Add New Medicine</h3>
                    </li>
                </ol>
            </nav>
            <p><small>*All fields are mandatory, except mentioned as (optional).</small></p>
            <form action="{{ route('admin.storeObat') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image" class="form-label">Medicine Image</label>
                    <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
                </div>

                <div class="mb-3">
                    <label for="nama_obat" class="form-label">Medicine Name</label>
                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                </div>

                <div class="mb-3">
                    <label for="jenis_obat" class="form-label">Medicine Group</label>
                    <select class="form-select" id="jenis_obat" name="jenis_obat" required>
                        <option selected disabled>- Select Group -</option>
                        @foreach ($jenisObat as $jenis)
                            <option value="{{ $jenis }}">{{ $jenis }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="stok" class="form-label">Quantity in Number</label>
                    <input type="number" class="form-control" id="stok" name="stok" required>
                </div>

                <div class="mb-3">
                    <label for="harga_obat" class="form-label">Price</label>
                    <input type="number" class="form-control" id="harga_obat" name="harga_obat" required>
                </div>

                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Description</label>
                    <textarea class="form-control" id="deskripsi" name="deskripsi" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-danger mb-3">Save Details</button>
            </form>
        </div>
    </body>
@endsection
