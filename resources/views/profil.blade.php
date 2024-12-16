@extends('navbar')

@section('content')
    <style>
        body {
            height: 100vh;
            margin: 0;
        }

        .card {
            border: none;
            width: 900px;
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

        .form-label {
            color: black;
            font-weight: bold;
        }

        .profile-picture {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            cursor: pointer;
            margin-top: 20px;
        }

        .btn-edit-profile,
        .btn-cancel-profile {
            margin-top: 20px;
            display: block;
        }

        .profile-col {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
    </style>

    <form id="logout" action="logout" method="POST">
        @csrf
    </form>
    <form id="profile-form" action="{{ route('profile.update', $user->id) }}" enctype='multipart/form-data' method="POST">
        @csrf
        @method('PUT')
    </form>

    <div class="center-container">

        <div class="card mt-4 mb-4">
            <div class="container">

                <div class="row">
                    <div class="col-5 profile-col">
                        <!-- Profile Picture -->
                        <div class="text-center">
                            <img src="{{ $user->profile_photo_path ? url('storage/' . $user->profile_photo_path) : asset('images/user.png') }}"
                                alt="Profile Picture" id="profile-pic" class="profile-picture">
                            <input type="file" name="profile_photo" id="profile-pic-input" accept="image/*"
                                style="display: none;" form="profile-form" />
                            <button type="submit" class="btn btn-danger w-100 fw-bold mt-3" form="logout" id="logout-btn">
                                Logout
                            </button>
                        </div>
                    </div>
                    <div class="col-7">
                        <!-- Profil Info -->
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" disabled required
                                value="{{ $user->name }}" form="profile-form" />
                        </div>

                        <div class="mb-3">
                            <label for="phone_number" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" disabled
                                required value="{{ $user->phone_number }}" form="profile-form" />
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" disabled required
                                value="{{ $user->email }}" form="profile-form" />
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" name="address" disabled required
                                value="{{ $user->address }}" form="profile-form" />
                        </div>

                        <!-- Tombol Edit -->
                        <button type="button" class="btn btn-success w-100 btn-edit-profile fw-bold" id="edit-profile-btn">
                            Edit Profile
                        </button>

                        <!-- Tombol Simpan -->
                        <button type="submit" class="btn btn-success w-100 btn-save-profile d-none fw-bold"
                            id="save-profile-btn" form="profile-form">
                            Save Changes
                        </button>

                        <!-- Tombol Cancel -->
                        <button type="button" class="btn btn-danger w-100 btn-cancel-profile d-none fw-bold"
                            id="cancel-profile-btn">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Ganti profil picture -->
    <script>
        let simpan = {
            'name': document.getElementById('name').value,
            'phone': document.getElementById('phone_number').value,
            'email': document.getElementById('email').value,
            'address': document.getElementById('address').value
        };

        document.getElementById('profile-pic').addEventListener('click', function() {
            document.getElementById('profile-pic-input').click();
        });

        document.getElementById('profile-pic-input').addEventListener('change', function(e) {
            const file = e.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('profile-pic').src = e.target.result;
            };
            reader.readAsDataURL(file);
        });

        // untuk mengaktifkan edit
        document.getElementById('edit-profile-btn').addEventListener('click', function() {
            document.getElementById('name').disabled = false;
            document.getElementById('phone_number').disabled = false;
            document.getElementById('email').disabled = false;
            document.getElementById('address').disabled = false;
            document.getElementById('save-profile-btn').classList.remove('d-none');
            document.getElementById('cancel-profile-btn').classList.remove('d-none');
            this.classList.add('d-none');
            simpan = {
                'name': document.getElementById('name').value,
                'phone': document.getElementById('phone_number').value,
                'email': document.getElementById('email').value,
                'address': document.getElementById('address').value
            };
        });

        // untuk membatalkan edit
        document.getElementById('cancel-profile-btn').addEventListener('click', function() {
            document.getElementById('name').disabled = true;
            document.getElementById('phone_number').disabled = true;
            document.getElementById('email').disabled = true;
            document.getElementById('address').disabled = true;

            document.getElementById('name').value = simpan.name;
            document.getElementById('phone_number').value = simpan.phone;
            document.getElementById('email').value = simpan.email;
            document.getElementById('address').value = simpan.address;

            document.getElementById('save-profile-btn').classList.add('d-none');
            this.classList.add('d-none');
            document.getElementById('edit-profile-btn').classList.remove('d-none');
        });
    </script>
@endsection
