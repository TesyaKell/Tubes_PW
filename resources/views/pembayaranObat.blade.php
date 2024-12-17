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
            margin-top: 5rem;
            margin-bottom: 1rem;
        }
    </style>

    <div class="m-0 px-10" style="background-color: #F4F1E3;">
        <div class="container py-5">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mx-5">
                            <h6 class="card-title mx-3 mb-4" style="color:#768A6E;">ID-{{ $data['id'] }}</h6>
                            <div class="d-flex align-items-center mt-4">
                                <h3 class="card-title mx-3" style="color:#768A6E;">PAYMENT</h3>
                                <h3 class="card-title mx-3" id="status"></h3>
                            </div>
                            <h4 class="card-title mx-3 mt-4" style="color:#768A6E;">Virtual Account</h4>
                            <h5 class="card-title mx-3 mt-2" style="color:#768A6E;"><strong>21905028642237874458</strong>
                            </h5>
                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body mx-5">
                            <h3 class="card-title mx-3 mb-4" style="color:#768A6E;">Purchased Products</h3>

                            @if (!empty($data['pembelian']))
                                @foreach ($data['pembelian'] as $item)
                                    <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                        <div style="width: 250px;">
                                            <h6 class="card-title mx-3" style="color:#768A6E;">
                                                {{ $item['nama_obat'] }}
                                            </h6>
                                        </div>
                                        <div style="width: 150px; text-align: right;">
                                            <h6 class="card-title mx-3" style="color:#768A6E;">
                                                Rp {{ number_format($item['harga_obat'], 0, ',', '.') }}
                                            </h6>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <p class="text-center" style="color: #768A6E;">No Details.</p>
                            @endif

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <h6 class="card-title mx-3" style="color:#768A6E;">Total Price</h6>
                                <h6 class="card-title mx-3" style="color:#768A6E;">Rp
                                    {{ number_format($data['total_harga'], 0, ',', '.') }}</h6>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <h6 class="card-title mx-3" style="color:#768A6E;">Total Payment</h6>
                                <h6 class="card-title mx-3" style="color:#768A6E;">Rp
                                    {{ number_format($data['total_harga'], 0, ',', '.') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const statusElement = document.getElementById('status');
            let isConfirmed = localStorage.getItem('isConfirmed');

            if (isConfirmed === 'true') {
                statusElement.textContent = 'CONFIRMED';
                statusElement.style.color = '#45B756';
                localStorage.setItem('isConfirmed', 'false');
            } else {
                statusElement.textContent = 'PENDING';
                statusElement.style.color = '#ED932C';
                localStorage.setItem('isConfirmed', 'true');
            }
        });
    </script>
@endsection
