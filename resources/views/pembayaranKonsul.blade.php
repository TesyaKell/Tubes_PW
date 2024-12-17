@extends('navbar')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.min.js"></script>
    <style>
        /* #F4F1E3 */
        /* #304D30 */
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
        <div class="container py-5 ">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body mx-5">
                            <h6 class="card-title mx-3 mb-4" style="color:#768A6E;">
                                ID-RYpCwOsMu6A7IN5WZpE7nrDpMZGd8cnyCSYU46smJP7XnvtOVj</h6>
                            <div class="d-flex align-items-center mt-4">
                                <h3 class="card-title mx-3" style="color:#768A6E;">PEMBAYARAN</h3>
                                <h3 class="card-title mx-3" id="status"></h3>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <h6 class="card-title mx-3 mb-4" style="color:#768A6E;">time remaining</h6>
                                <h6 class="card-title mx-3 mb-4" style="color:#768A6E;">xx:xx:xx</h6>
                            </div>
                            <h4 class="card-title mx-3 mt-4" style="color:#768A6E;">Virtual Account</h4>
                            <h5 class="card-title mx-3 mt-2" style="color:#768A6E;"><strong>21905028642237874458</strong>
                            </h5>

                        </div>
                    </div>
                    <div class="card mt-5">
                        <div class="card-body mx-5">
                            <h3 class="card-title mx-3 mb-4" style="color:#768A6E;">konsultasi</h3>
                            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                <div style="width: 250px;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;">Id antrian</h6>
                                </div>
                                <div style="width: 250px;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;">ID-fc37a79e7f</h6>
                                </div>
                                <div style="width: 150px; text-align: right;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;"></h6>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                <div style="width: 250px;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;">Tanggal</h6>
                                </div>
                                <div style="width: 250px;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;">xx-xx-xxxx xx:xx</h6>
                                </div>
                                <div style="width: 150px; text-align: right;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;">Rp 150.000</h6>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center mb-3 mt-4">
                                <div style="width: 250px;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;">Nama</h6>
                                </div>
                                <div style="width: 250px;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;">John Doe</h6>
                                </div>
                                <div style="width: 150px; text-align: right;">
                                    <h6 class="card-title mx-3" style="color:#768A6E;"></h6>
                                </div>

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
