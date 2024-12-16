@extends('navbar')

@section('content')
    <style>
        .card-body-2 {
            background-color: #304D30;
            height: 295px;
        }

        .card-2 {
            border: none;
        }

        p {
            color: #CCE5FF;
        }

        .col-md-3 {
            margin: 15px;
        }

        .col-md-3 img {
            width: 100%;
            height: auto;
        }

        body .carousel-indicators li {}

        body .carousel-control-prev-icon,
        body .carousel-control-next-icon {}

        body .no-padding {
            padding-left: 0;
            padding-right: 0;
        }

        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        }

        .card {
            border: none;
            width: 240px;
            border-radius: 30px;
            height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card-body {
            display: flex;
            flex-direction: column;
            justify-content: center;
            flex-grow: 1;
        }

        .card img {
            height: 300px;
            border-radius: 30px 30px 0 0;
            width: 100%;
            object-fit: cover;
            margin-top: 8px;
        }

        .card-text {
            color: #373D45;
        }

        .card-4 {
            border: none;
            background-color: #F6FAFF;
            width: 360px;
            height: 420px;
        }
    </style>

    <!-- Bagian atas -->
    <div class="card-2">
        <div class="card-body-2">
            <div class="row">
                <div class="col-5 ms-5 ps-5">
                    <h1 class="text-white mt-3 fw-bold">Your Prescription for Affordable Health Solutions!</h1>
                    <p class="fs-5">Elevate your health journey with exclusive discounts and unparalleled convenience.
                        Your path to well-being starts here, where every purchase is a prescription for savings.</p>
                    <a href="{{ url('listObat') }}" class="btn btn-light text-success">Start Shopping
                        <img src="{{ asset('images/beli.png') }}" alt="Atma" width="21" height="21">
                    </a>
                </div>
                <div class="col-2"></div>
                <div class="col-4">
                    <img src="{{ asset('images/doctor.png') }}" alt="Atma" width="345" class="ms-5 mt-3"
                        height="279">
                </div>
            </div>
        </div>
    </div>

    <div class="me-5 mt-3">
        <h4 class="d-flex justify-content-end fw-bold">Book a consultation?
            <a href="{{ route('reservasi.index') }}" class="btn btn-primary text-light fw-bold ms-2 mb-3">BOOK NOW</a>
        </h4>
    </div>

    <!-- Bagian 1: Shop by Categories -->
    <div class="ms-5 mt-5">
        <h3 class="d-flex justify-content-start fw-bold text-black-50">Shop by Categories</h3>
    </div>

    <div class="owl-carousel owl-theme mt-4">

        @foreach ($jenisObat as $obat)
            <a href="{{ route('jenisObat', ['jenis' => $obat->jenis_obat]) }}" class="flex flex-col items-center">
                <div class="card flex flex-col justify-between items-center p-3 bg-white shadow-lg rounded-lg">
                    <img src="{{ asset('images/' . $obat->image) }}" alt="{{ $obat->jenis_obat }}"
                        class="h-48 w-full object-cover rounded-t-lg">
                    <div class="mt-2">
                        <h5 class="text-center text-lg font-semibold text-gray-800">{{ $obat->jenis_obat }}</h5>
                    </div>
                </div>
            </a>
        @endforeach
    </div>

    <!-- Bagian 2: New Launches -->
    <div class="ms-5 mt-5">
        <h3 class="d-flex justify-content-start fw-bold text-black-50">New Launches</h3>
    </div>
    <div class="owl-carousel owl-theme mt-4">
        @foreach ($data as $obat)
            @if ($obat)
                <div class="flex flex-col items-center">
                    <div class="card flex flex-col justify-between items-center p-3 bg-white shadow-lg rounded-lg">
                        <img class="h-48 w-full object-cover rounded-t-lg" src="{{ asset('images/' . $obat->image) }}"
                            alt="{{ $obat->nama_obat }}">
                        <div class="mt-2 text-center">
                            <h5 class="text-lg font-semibold text-gray-800">{{ $obat->nama_obat }}</h5>
                            <h6 class="text-sm text-gray-500">Rp.{{ $obat->harga_obat }}</h6>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>

    <!-- Bagian bawah -->
    <div class="d-flex justify-content-center" style="min-height: 100vh;">
        <div class="card-4 mt-5" style="width: 100rem;">
            <div class="card-body">
                <div class="container">
                    <div class="row">
                        <div class="col-6">
                            <h6 class="card-subtitle mt-5 mb-2 fw-bold">Todays Hot Offer</h6>
                            <h1 class="fw-bold">Unlock 50% Off on Essential Medicines!</h1>
                            <p class="card-text fs-5 mt-3">Embrace wellness without breaking the bank! Enjoy a generous
                                25% discount on a wide range of vital medicines at our online pharmacy. Your health matters,
                                and so does your budget.</p>
                            <button type="button" class="btn btn-primary text-light fw-bold mt-3">Place An Order Now
                                <img src="{{ asset('images/arrow.png') }}" alt="Atma" width="21" height="15"
                                    class="ms-2">
                            </button>
                        </div>
                        <div class="col-6">
                            <img src="{{ asset('images/fotoBawah.png') }}" alt="Atma" width="442" class="ms-5 mt-4"
                                height="352">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Owl Carousel Scripts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                nav: false,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 3
                    },
                    1000: {
                        items: 5
                    }
                }
            });
        });
    </script>
@endsection
