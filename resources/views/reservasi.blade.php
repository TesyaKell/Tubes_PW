@extends('navbar')

@section('content')
    <style>
        .card {
            border: none;
            width: 1000px;
            border-radius: 15px;
            height: auto;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            padding: 30px;
        }

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-label {
            color: black;
            font-weight: bold;
        }
    </style>

    <div class="center-container">
        <div class="card mt-5 mb-5">
            <div class="card-body">
                <h3 class="card-title mb-5 text-center fw-bold">Consultation Registration Form</h3>

                <form action="{{ route('consultation.store') }}" method="POST">
                    @csrf
                    <div class="container">
                        <div class="row">
                            <div class="col-6">
                                <!-- Nama -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" required>
                                </div>

                                <!-- Umur -->
                                <div class="mb-3">
                                    <label for="age" class="form-label">Age</label>
                                    <input type="number" class="form-control" id="age" name="age" required
                                        min="0">
                                </div>

                                <!-- Gender -->
                                <div class="mb-3">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" required>
                                        <option selected disabled>Select Gender</option>
                                        <option value="Laki-laki">Male</option>
                                        <option value="Perempuan">Female</option>
                                    </select>
                                </div>

                                <!-- Berat Badan -->
                                <div class="mb-3">
                                    <label for="weight" class="form-label">Weight (kg)</label>
                                    <input type="number" class="form-control" id="weight" name="weight" required
                                        min="0">
                                </div>

                                <!-- Alergi -->
                                <div class="mb-3">
                                    <label for="allergies" class="form-label">Alergy</label>
                                    <input type="text" class="form-control" id="allergies" name="allergies">
                                </div>
                            </div>

                            <div class="col-6">
                                <!-- Tanggal Konsultasi -->
                                <div class="mb-3">
                                    <label for="date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="date" name="consultation_date"
                                        required>
                                </div>

                                <script>
                                    var today = new Date().toISOString().split('T')[0];
                                    document.getElementById('date').setAttribute('min', today);
                                </script>

                                <!-- Jam Konsultasi -->
                                <div class="mb-3">
                                    <label for="time" class="form-label">Time</label>
                                    <select class="form-select" id="time" name="consultation_time" required>
                                        <option selected disabled>Select Time</option>
                                        <option value="09:00">09:00</option>
                                        <option value="11:00">11:00</option>
                                        <option value="13:00">13:00</option>
                                        <option value="15:00">15:00</option>
                                    </select>
                                </div>

                                <!-- Keluhan -->
                                <div class="mb-3">
                                    <label for="complaint" class="form-label">Sympthoms or Health Concerns</label>
                                    <textarea class="form-control" id="complaint" name="complaint" rows="3" required></textarea>
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid gap-2 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success w-auto px-4">BOOK NOW</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
