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
            margin-top: 3rem;
            margin-bottom: 1rem;
        }

        .container-card {
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
            padding: 1rem;
            border-radius: 15px;
        }

        .payment-background {
            background-color: #F4F1E3;
            padding: 10px;
        }

        h6 {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .d-flex {
            gap: 1rem;
        }

        .btn-custom {
            background-color: green;
            color: white;
        }
    </style>

    <form action="{{ route('reservasi.store') }}" method="POST">
        @csrf
        <div class="m-0 px-10" style="background-color: #F4F1E3;">
            <div class="container py-3 pt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="card container-card">
                            <div class="card-body mx-5">
                                <h2 class="card-title mb-4 mt-1 text-center fw-bold" style="color:black;">Booking</h2>

                                <!-- Row 1: Nama Lengkap -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-4">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Name</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                {{ session('name') }} <!-- Access session data -->
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 2: Usia -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Age</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                {{ session('age') }} <!-- Access session data -->
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 3: Jenis Kelamin -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Gender</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                {{ session('gender') }} <!-- Access session data -->
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 4: Berat Badan -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Weight (kg)</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                {{ session('weight') }} <!-- Access session data -->
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 6: Tanggal Konsultasi -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Date</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                {{ session('consultation_date') }} <!-- Access session data -->
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 5: Jam Konsultasi -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Time</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                {{ session('consultation_time') }} <!-- Access session data -->
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 7: Alergi -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Alergy</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                @if (session('allergies'))
                                                    {{ session('allergies') }}
                                                @else
                                                    No allergies
                                                @endif
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Row 8: Keluhan -->
                                <div class="d-flex justify-content-between align-items-center mb-2 mt-2">
                                    <div class="col-3">
                                        <h6 class="mb-0" style="color:#304D30;">Health Concerns</h6>
                                    </div>
                                    <div class="col-9">
                                        <div class="card border border-dark rounded m-2 p-2" style="width: 100%;">
                                            <h6 class="mx-2 mb-0" style="color:#304D30;">
                                                {{ session('complaint') }} <!-- Access session data -->
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Payment section -->
        <div class="payment-background">
            <div class="container py-3 pt-1">
                <div class="row">
                    <div class="col-12">
                        <div class="card container-card">
                            <div class="card-body mx-5">
                                <h2 class="card-title mb-4 text-center fw-bold" style="color: black;">Payment</h2>

                                <!-- Cost Section -->
                                <div class="mb-4">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 fw-bold fs-5" style="color:green;">Cost</h6>
                                        <h6 class="mx-2 mb-0 fw-bold fs-5" style="color:green;">
                                            @if (session('harga_reservasi_konsultasi'))
                                                {{ 'Rp. ' . number_format(session('harga_reservasi_konsultasi'), 0, ',', '.') }}
                                            @else
                                                Tidak ada harga
                                            @endif
                                        </h6>
                                    </div>
                                </div>

                                <!-- E-wallet options -->
                                <div class="mb-4">
                                    <h6 class="mt-3 mb-2 fw-bold" style="color:black;">e-wallet</h6>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input mt-0 mx-1" name="metode_transaksi_reservasi"
                                                type="radio" value="Gopay" aria-label="Gopay">
                                            <h6 class="mb-0" style="color:black;">Gopay</h6>
                                        </div>
                                        <div class="d-flex align-items-center mb-2">
                                            <input class="form-check-input mt-0 mx-1" name="metode_transaksi_reservasi"
                                                type="radio" value="DANA" aria-label="DANA">
                                            <h6 class="mb-0" style="color:black;">DANA</h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Virtual account options -->
                                <div class="mb-4">
                                    <h6 class="mt-3 mb-2 fw-bold" style="color:black;">Virtual Account</h6>
                                    <div class="d-flex flex-column">
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input mt-0 mx-1" name="metode_transaksi_reservasi"
                                                type="radio" value="BCA" aria-label="BCA">
                                            <h6 class="mb-0" style="color:black;">BCA</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input mt-0 mx-1" name="metode_transaksi_reservasi"
                                                type="radio" value="BNI" aria-label="BNI">
                                            <h6 class="mb-0" style="color:black;">BNI</h6>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <input class="form-check-input mt-0 mx-1" name="metode_transaksi_reservasi"
                                                type="radio" value="Mandiri" aria-label="Mandiri">
                                            <h6 class="mb-0" style="color:black;">Mandiri</h6>
                                        </div>
                                    </div>
                                </div>

                                <!-- Checkout Button -->
                                <div class="d-flex justify-content-end my-12-1">
                                    <button type="submit" class="btn btn-custom fw-bold fs-6">PAYMENT</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
