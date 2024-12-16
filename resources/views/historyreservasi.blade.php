@extends('navbar')

@section('content')
    <div class="container py-5">
        <h2 class="text-center fw-bold mb-4">Consultation Reservation History</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Tabel Data Reservasi -->
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="thead-dark">
                    <tr class="text-center">
                        <th>No.</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Weight</th>
                        <th>Complaint</th>
                        <th>Allergy</th>
                        <th>Consultation Date</th>
                        <th>Consultation Time</th>
                        <th>Transaction Method</th>
                        <th>Status</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($reservasi as $item)
                        <tr>
                            <td>{{ $item->id_reservasi_konsultasi }}</td>
                            <td>{{ $item->nama_lengkap_pasien }}</td>
                            <td>{{ $item->usia_pasien }}</td>
                            <td>{{ $item->jenis_kelamin }}</td>
                            <td>{{ $item->berat_badan_pasien }}</td>
                            <td>{{ $item->alergi_pasien ?? 'No allergies' }}</td>
                            <td>{{ $item->keluhan }}</td>
                            <td>{{ $item->tanggal_reservasi_konsultasi }}</td>
                            <td>{{ $item->jam_reservasi_konsultasi }}</td>
                            <td>{{ $item->metode_transaksi_reservasi }}</td>
                            <td>{{ $item->status_reservasi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="10" class="text-center">No reservation data available.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
