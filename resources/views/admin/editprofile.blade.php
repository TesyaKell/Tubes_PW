@extends('IndexAdmin')

@section('content')
    <style>
        /* Mengatur tampilan umum konten */
        body {
            font-family: Poppins, sans-serif;
            background-color: #D8DEC5;
            /* Warna sage green */
        }

        .content {
            padding: 20px;
        }

        /* Header Dashboard */
        .dashboard-header h1 {
            font-size: 2.5rem;
            font-weight: bold;
        }

        .dashboard-header h5 {
            font-weight: bold;
        }

        /* Kartu Data Utama */
        .card-custom {
            border: 1px solid #A3B18A;
            /* Warna sage untuk border */
            border-radius: 10px;
            padding: 20px;
            background-color: white;
            margin-right: 20px;
            width: 300px;
        }

        .card-custom h4 {
            font-size: 18px;
            margin-bottom: 5px;
        }

        .card-custom h5 {
            font-size: 24px;
            font-weight: bold;
        }

        .card-custom i {
            font-size: 40px;
            margin-right: 15px;
        }

        /* Atur layout menjadi lebih fleksibel */
        .d-flex {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        /* Inventory & Customers Section */
        .inventory-section {
            background-color: #A3B18A;
            padding: 20px;
            border-radius: 10px;
            margin-top: 40px;
        }

        .inventory-section h6 {
            font-size: 18px;
            margin-bottom: 15px;
        }

        .inventory-section .card {
            border-radius: 10px;
        }

        .go-link {
            text-align: right;
            font-size: 12px;
        }

        .go-link a {
            color: black;
            text-decoration: none;
        }

        p {
            margin: 0;
        }

        .no-hover {
            transition: none;
            /* Nonaktifkan transisi untuk hover */
        }

        .no-hover:hover {
            background-color: #FFFFFF;
            /* Tetap warna latar belakang putih saat hover */
            color: #dc3545;
            /* Pastikan warna teks tetap sesuai */
            border-color: #dc3545;
            /* Pastikan warna border tetap sesuai */
        }
    </style>

    <body>
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item d-inline-block w-auto">
                        <a href="{{ route('admin.users') }}" class="no-underline" style="color: #888A88">
                            <h3>User Management</h3>
                        </a>
                    </li>
                    <li class="breadcrumb-item active d-inline-block w-auto" aria-current="page">
                        <h3>Edit Profile</h3>
                    </li>
                </ol>
            </nav>

            <p><small>*Feel free to update any fields as needed.</small></p>

            <form action="{{ route('admin.updateUser', $user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="d-flex justify-content-between">
                    <div class="mb-3" style="flex: 1; margin-right: 10px;">
                        <label for="userID" class="form-label">User ID</label>
                        <input type="text" class="form-control" id="userID"
                            value="C{{ str_pad($user->id, 3, '0', STR_PAD_LEFT) }}" disabled>
                    </div>
                    <div class="mb-3" style="flex: 1;">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{ $user->name }}" required>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <div class="mb-3" style="flex: 1; margin-right: 10px;">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3" style="flex: 1;">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone_number" value="{{ $user->phone_number }}"
                            required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea class="form-control" name="address" rows="3" required>{{ $user->address }}</textarea>
                </div>

                <div class="d-flex align-items-end">
                    <div class="mb-3" style="flex: 1;">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password"
                            placeholder="Leave blank to keep current password">
                    </div>
                </div>

                <div class="d-flex">
                    <button type="submit" class="btn mb-3 me-2" style="background-color: #F0483E; color: white;">Save Details</button>
                    <button type="button" class="btn btn-secondary mb-3" data-bs-toggle="modal" data-bs-target="#deleteModal"> Delete User </button>
                </div>
            </form>

            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content" style="border-radius: 15px;">
                        <div class="modal-body p-4">
                            <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                data-bs-dismiss="modal" aria-label="Close"></button>

                            <h3 class="text-center mb-4 mt-2">Delete User?</h3>

                            <div class="d-flex justify-content-between gap-3">
                                <button type="button" class="btn flex-grow-1 py-2"
                                    style="background-color: #808080; color: white; border-radius: 8px;"
                                    data-bs-dismiss="modal">
                                    Cancel
                                </button>

                                <form action="{{ route('admin.deleteUser', $user->id) }}" method="POST"
                                    class="flex-grow-1">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn w-100 py-2"
                                        style="background-color: #F0483E; color: white; border-radius: 8px;">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <script>
            document.getElementById('resetPasswordBtn').addEventListener('click', function() {
                document.getElementById('password').value = '';
                document.getElementById('password').focus();
            });
        </script>
    </body>
@endsection