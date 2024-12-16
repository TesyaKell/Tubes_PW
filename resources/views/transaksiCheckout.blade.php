@extends('navbar')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
<style>
    .body {
        background-color: #F4F1E3;
    }

    .container-full-height {
        min-height: 65vh;
        display: flex;
        flex-direction: column;
    }

    .px-10 {
        padding-left: 10rem;
        padding-right: 10rem;
    }

    .my-12-1 {
        margin-top: 5rem;
        margin-bottom: 1rem;
    }

    .vertical-separator {
        border-right: 2px solid #768A6E;
        padding-right: 100px;
    }
</style>
<div class="m-0 px-10" style="background-color: #F4F1E3;">
    <div class="container pt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body mx-5">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-start align-items-center mb-4 mt-4">
                                <img src="{{ asset('images/IconSearch.png') }}" alt="search">
                                <h3 class="card-title" style="color:#768A6E;">Alamat Pengiriman</h3>
                            </div>
                            <div class="d-flex justify-content-end align-items-center mb-4 mt-4">
                                <a class="card-title" style="color:blue;" id="change" href="#">Ubah</a>
                            </div>
                        </div>
                        <div class="d-flex justify-content-start">
                            <input type="text" class="px-4 py-2 mx-0" id="catatan" name="catatan" placeholder="catatan" required>
                            <input type="text" class="px-10 py-2 mr-3" id="alamat" name="alamat" placeholder="alamat" required>
                        </div>
                        <div class="px-auto py-1">
                            <hr>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container pt-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body mx-5">
                        <h2 class="card-title mb-4" style="color:#768A6E;">Keranjang:</h2>
                        @if (!empty($data))
                        @foreach($data['data_obat'] as $item)
                        <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/' . $item['image']) }}" alt="{{ $item['nama_obat'] }}" style="width: 50px; height: auto; margin-right: 10px;">
                                <div>
                                    <h6 class="mb-0" style="color:#304D30;">{{ $item['nama_obat'] }}</h6>
                                    <small class="text-muted" style="color:#304D30;">Rp {{ number_format($item['harga_obat'], 0, ',', '.') }} (x{{ $item['jumlah_obat'] }})</small>
                                </div>
                            </div>
                            <h6 class="mb-0" style="color:#304D30;">Rp {{ number_format($item['total_harga'], 0, ',', '.') }}</h6>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body mx-5">
                        <form action="{{ route('paymentObat') }}" method="POST">
                            @csrf
                            <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                                <!-- Metode Pembayaran -->
                                <div class="align-items-center vertical-separator">
                                    <h6 class="mb-0" style="color:#304D30;">METODE PEMBAYARAN</h6>
                                    <h6 class="mt-3 mb-3" style="color:#304D30;">E-Wallet</h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input mt-0 mx-1" name="bayarwoi" type="radio" value="Gopay" aria-label="Checkbox for following text input" required>
                                        <h6 class="mb-0" style="color:#304D30;">Gopay</h6>
                                    </div>
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input mt-0 mx-1" name="bayarwoi" type="radio" value="OVO" aria-label="Checkbox for following text input" required>
                                        <h6 class="mb-0" style="color:#304D30;">OVO</h6>
                                    </div>
                                    <h6 class="mt-3 mb-3" style="color:#304D30;">Virtual Account</h6>
                                    <div class="d-flex align-items-center mb-2">
                                        <input class="form-check-input mt-0 mx-1" name="bayarwoi" type="radio" value="BCA" aria-label="Checkbox for following text input" required>
                                        <h6 class="mb-0" style="color:#304D30;">BCA</h6>
                                    </div>
                                </div>
                                <!-- Summary -->
                                <div class="justify-content-between align-items-center mb-4 mt-4">
                                    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                                        <h6 class="mx-3 mb-0" style="color:#304D30;">Subtotal untuk Produk</h6>
                                        @if (!empty($data))
                                        <h6 class="mx-3 mb-0" style="color:#304D30;">Rp {{ number_format($data['total_harga'], 0, ',', '.') }}</h6>
                                        @endif
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                                        <h6 class="mx-3 mb-0" style="color:#304D30;">Total Pembayaran</h6>
                                        @if (!empty($data))
                                        <h6 class="mx-3 mb-0" style="color:#304D30;">Rp {{ number_format($data['total_pembayaran'], 0, ',', '.') }}</h6>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex justify-content-end my-12-1">
                                <button type="submit" class="btn" style="background-color: #768A6E;">Proses Pembayaran</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
