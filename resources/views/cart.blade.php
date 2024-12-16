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

        .my-12-1 {
            margin-top: 12rem;
            margin-bottom: 1rem;
        }
    </style>
    <div class="m-0 px-10" style="background-color: #F4F1E3;">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mx-5">
                            @if (session('success'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    {{ session('success') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ session('error') }}
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <h2 class="card-title mb-4" style="color:#768A6E;">Keranjang:</h2>
                            @if (!empty($cart))
                                @foreach ($cart as $item)
                                    <div class="d-flex justify-content-between align-items-center mb-4 mt-4">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input mt-0" type="checkbox" name="selected_items[]"
                                                value="{{ $item['id'] }}"
                                                aria-label="Checkbox for following text input"
                                                {{ $item['selected'] ? 'checked' : '' }}
                                                onclick="toggleItemStatus({{ $item['id'] }})">
                                            <img src="{{ asset('images/' . $item['image']) }}"
                                                alt="{{ $item['nama_obat'] }}"
                                                style="width: 50px; height: auto; margin-right: 10px;">
                                            <div>
                                                <h6 class="mb-0" style="color: #304D30;">{{ $item['nama_obat'] }}</h6>
                                                <small class="text-muted" style="color: #304D30;">Rp
                                                    {{ number_format($item['harga_obat'], 0, ',', '.') }}</small>
                                            </div>
                                        </div>
                                        <div>
                                            <h6 class="mb-2" style="color: #304D30;">Rp
                                                {{ number_format($item['harga_obat'] * $item['jumlah_obat'], 0, ',', '.') }}
                                            </h6>
                                            <div style="width: 120px;">
                                                <div class="input-group mb-3">
                                                    <form
                                                        action="{{ route('setValueCart', ['id' => $item['id'], 'value' => -1]) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        <button class="btn btn-outline-secondary btn-decrease"
                                                            type="submit">-</button>
                                                    </form>
                                                    <input type="text" class="form-control text-center"
                                                        value="{{ $item['jumlah_obat'] }}" disabled>
                                                    <form
                                                        action="{{ route('setValueCart', ['id' => $item['id'], 'value' => 1]) }}"
                                                        method="POST" style="display:inline;">
                                                        @csrf
                                                        <button class="btn btn-outline-secondary btn-increase"
                                                            type="submit">+</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="d-flex justify-content-end"
                                    style="border-bottom: 1px solid black; padding-bottom: 10px;">
                                    <a type="button" class="btn text-white" style="background-color: #768A6E;"
                                        href="{{ route('getObat') }}">Tambah Obat</a>
                                </div>
                                <!-- Checkout Button -->
                                <form action="{{ route('checkout') }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-end my-5">
                                        <button type="submit" class="btn text-white" style="background-color: #768A6E;">
                                            CHECK OUT
                                        </button>
                                    </div>
                                </form>
                            @else
                                <p class="text-center" style="color: #768A6E;">Keranjang kosong.</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleItemStatus(id) {
            $.ajax({
                url: '{{ route('activeItem', ':id') }}'.replace(':id', id),
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                },
                success: function(response) {
                    console.log(response.status);
                },
                error: function(xhr, status, error) {
                    console.error("Terjadi kesalahan: " + error);
                }
            });
        }
    </script>
@endsection
