@extends('navbar')

@section('content')
    <style>
        .card {
            border: none;
            width: 1350px;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
        }

        .p-2,
        .card-title-2 {
            color: #4F4F4F;
        }

        .price-btn-container {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
        }

        .price-btn-container h1 {
            margin-right: 20px;
        }

        .btn-primary {
            width: 200px;
            height: 50px;
            font-size: 1.1em;
        }
    </style>

    <div class="center-container mt-3 mb-3">
        <div class="card">
            <div class="card-body">
                <div class="row justify-content-center">
                    <div class="col-md-4">
                        <img src="{{ asset('images/' . $product['image']) }}" class="card-img-top"
                            alt="{{ $product['nama_obat'] }}">
                    </div>

                    <div class="col-md-8">
                        <h2 class="card-title-2 fw-bold">{{ $product['nama_obat'] }}</h2>

                        <!-- Kontainer harga dan tombol -->
                        <div class="price-btn-container">
                            <h1 class="text-success fw-bold">{{ $product['harga_obat'] }}</h1>
                            <form action="{{ route('addToCart', ['id' => $product->id]) }}" method="POST">
                                @csrf
                                <input type="numeric" name="jumlah_obat" value="{{ 1 }}">
                                <input type="hidden" name="id_obat" value="{{ 1 }}">
                                <button type="submit" class="btn btn-primary fw-bold">Add To Cart</button>
                            </form>
                        </div>

                        <div class=" p-2 fw-bold mt-3">
                            <img src="{{ asset('images/tas.png') }}" alt="Atma" width="21" height="21">
                            Stock Available
                        </div>
                        <div class="p-2 fw-bold">
                            <img src="{{ asset('images/mobil.png') }}" alt="Atma" width="21" height="21">
                            Send Fast Arrive
                        </div>
                        <h5 class=" mt-5">Deskripsi</h5>
                        <p class="card-text">{{ $product['deskripsi'] }}</p>
                        <h5 class=" mt2">Jenis Obat</h5>
                        <p class="card-text">{{ $product['jenis_obat'] }}</p>
                        <h5 class=" mt-2">Stok</h5>
                        <p class="card-text">{{ $product['stok'] }}</p>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection