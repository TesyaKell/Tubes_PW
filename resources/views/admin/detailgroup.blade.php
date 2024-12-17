@extends('IndexAdmin')

@section('content')
    <style>
        /* Mengatur tampilan umum konten */
        body {
            font-family: Poppins, sans-serif;
            background-color: #D8DEC5;
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
        }

        .no-hover:hover {
            background-color: #FFFFFF;
            color: #dc3545;
            border-color: #dc3545;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 30%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>

    <div class="container-fluid">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item d-inline-block w-auto">
                    <a href="{{ url('admin/medicinegroups') }}" class="no-underline" style="color: #888A88">
                        <h3>Medicine Groups</h3>
                    </a>
                </li>
                <li class="breadcrumb-item active d-inline-block w-auto" aria-current="page">
                    <h3>{{ $groupName }}</h3>
                </li>
            </ol>
        </nav>

        <h5>List of medicines in {{ $groupName }}.</h5>

        <div class="d-flex justify-content-between">
            <form action="{{ route('admin.detailgroup', $groupName) }}" method="GET"
                style="position: relative; width: 40%;">
                <input class="form-control" type="search" name="search" placeholder="Search Medicine.."
                    value="{{ request('search') }}" aria-label="Search" style="width: 100%; background-color: #E3EBF3;">
                <button type="submit"
                    style="border: none; background: none; position: absolute; top: 50%; right: 20px; transform: translateY(-50%);">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
            <button type="button" class="btn" style="height: 40px; background-color: #F0483E; color: #FFFFFF"
                id="addGroupBtn">
                <i class="fa-solid fa-plus"></i> Add Medicine
            </button>
        </div>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">Medicine Name</th>
                    <th scope="col">Stock</th>
                    <th scope="col" class="small-width">Action</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @foreach ($obats as $obat)
                    <tr>
                        <td scope="row">{{ $obat->nama_obat }}</td>
                        <td>{{ $obat->stok }}</td>
                        <td class="small-width">
                            <form
                                action="{{ route('admin.removeFromGroup', ['group' => $groupName, 'obat' => $obat->id]) }}"
                                method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn text-danger p-0">
                                    <i class="fa-solid fa-trash"></i> Remove from Group
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Form untuk delete group -->
        <form id="deleteGroupForm" action="{{ route('admin.deleteGroup', $groupName) }}" method="POST"
            style="display: inline">
            @csrf
            @method('DELETE')
            <button type="button" id="deleteGroups" class="btn btn-outline-danger no-hover"
                style="background-color: #FFFFFF">
                <i class="fa-solid fa-trash"></i> Delete Group
            </button>
        </form>

        <!-- Modal untuk menambahkan obat -->
        <div id="addModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeAddModal">&times;</span>
                <h2><strong>Add Medicine</strong></h2>
                <form action="{{ route('admin.addToGroup', $groupName) }}" method="POST">
                    @csrf
                    <label for="medicine_id"><strong>Enter Medicine Name:</strong></label>
                    <input type="text" id="medicine_id" name="medicine_id" class="form-control mt-1"
                        placeholder="Enter Medicine Name or Medicine ID" required list="medicineList">
                    <datalist id="medicineList">
                        @foreach (App\Models\Obat::whereNull('jenis_obat')->get() as $obat)
                            <option value="{{ $obat->nama_obat }}">
                        @endforeach
                    </datalist>
                    <button type="submit" class="btn mt-3" style="height: 40px; background-color: #F0483E; color: #FFFFFF">
                        <i class="fa-solid fa-plus"></i> Add Medicine to Group
                    </button>
                </form>
            </div>
        </div>

        <!-- Modal untuk menghapus grup -->
        <div id="deleteModal" class="modal">
            <div class="modal-content">
                <span class="close" id="closeDeleteModal">&times;</span>
                <h2><strong>Delete Group?</strong></h2>
                <div class="d-flex justify-content-between">
                    <button type="button" id="cancelDelete" class="btn"
                        style="height: 40px; width: 150px; background-color: #8E8E8E; color: #FFFFFF">Cancel</button>
                    <button type="button" id="confirmDelete" class="btn"
                        style="height: 40px; width: 150px; background-color: #F0483E; color: #FFFFFF">Delete</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Modal untuk menambahkan obat
        var addModal = document.getElementById("addModal");
        var addButton = document.getElementById("addGroupBtn");
        var closeAddModal = document.getElementById("closeAddModal");

        addButton.onclick = function() {
            addModal.style.display = "block";
        }

        closeAddModal.onclick = function() {
            addModal.style.display = "none";
        }

        // Modal untuk menghapus grup
        var deleteModal = document.getElementById("deleteModal");
        var deleteButton = document.getElementById("deleteGroups");
        var closeDeleteModal = document.getElementById("closeDeleteModal");
        var cancelButton = document.getElementById("cancelDelete");
        var confirmDeleteButton = document.getElementById("confirmDelete");

        deleteButton.onclick = function() {
            deleteModal.style.display = "block";
        }

        closeDeleteModal.onclick = function() {
            deleteModal.style.display = "none";
        }

        cancelButton.onclick = function() {
            deleteModal.style.display = "none";
        }

        confirmDeleteButton.onclick = function() {
            document.getElementById('deleteGroupForm').submit();
        }

        window.onclick = function(event) {
            if (event.target == addModal || event.target == deleteModal) {
                addModal.style.display = "none";
                deleteModal.style.display = "none";
            }
        }
    </script>
@endsection
