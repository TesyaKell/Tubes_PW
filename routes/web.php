<?php

use App\Http\Controllers\ObatController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReservasiKonsultasiController;
use App\Models\PembelianObat;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransaksiController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

//use App\Http\Controllers\ReservasiController;


$user = [
    'profil' => [
        'name' => '',
        'password' => '',
        'phone_number' => '',
        'address' => '',
        'email' => '',
    ]];

session(['user' => $user]);

Route::get('/', function () {
    return redirect('/login');
});

//ROUTE LOGIN 
Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserController::class, 'login'])->name('login');

//ROUTE REGISTER
Route::post('/register', [UserController::class, 'register'])->name('register');
Route::get('/register', [UserController::class, 'showRegistrationForm'])->name('register');

Route::get('/forgotpassword', function () {
    return view('forgotpassword');
});

//ROUTE PROFIL
Route::get('/profil', [UserController::class, 'showProfilForm'])->middleware('auth')->name('profil');
Route::put('/profile/{id}', [UserController::class, 'update'])->name('profile.update');

// Route untuk logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

// ROUTE OBAT
Route::get('/home', [ObatController::class, 'index'])->name('home'); // untuk tampil data di customer
Route::get('/obat/{id}', [ObatController::class, 'show'])->name('detailObat'); // untuk tampil data di customer

Route::post('/obat/store', [ObatController::class, 'store']);// untuk admin


// Route::get('/obat/{id}', [ObatController::class, 'show']);// tampil satu data obat
Route::put('/obat/update/{id}', [ObatController::class, 'update'])->name('obat.update');// untuk admin
Route::delete('/obat/delete/{id}', [ObatController::class, 'delete'])->name('obat.delete'); // untuk admin



//ROUTE RESERVASI

//Session
Route::post('/consultation/store', [ReservasiKonsultasiController::class, 'storeConsultation'])->name('consultation.store');

// Tampilkan semua reservasi
Route::get('/reservasi', [ReservasiKonsultasiController::class, 'index'])->name('reservasi.index');

// Form tambah reservasi
Route::get('/reservasi/create', [ReservasiKonsultasiController::class, 'create'])->name('reservasi.create');

// Simpan data reservasi
Route::post('/reservasi', [ReservasiKonsultasiController::class, 'store'])->name('reservasi.store');
Route::post('/reservasi/store', [ReservasiKonsultasiController::class, 'store'])->name('reservasi.store');
Route::post('/reservasi/store', [ReservasiKonsultasiController::class, 'store'])->middleware('auth')->name('reservasi.store');


// Tampilkan detail reservasi
Route::get('/reservasi/{id}', [ReservasiKonsultasiController::class, 'show'])->name('reservasi.show');
Route::get('/historyreservasi', [ReservasiKonsultasiController::class, 'history'])->name('reservasi.history');

// Form edit reservasi
Route::get('/reservasi/{id}/edit', [ReservasiKonsultasiController::class, 'edit'])->name('reservasi.edit');

// Update data reservasi
Route::put('/reservasi/{id}', [ReservasiKonsultasiController::class, 'update'])->name('reservasi.update');

// Hapus reservasi
Route::delete('/reservasi/{id}', [ReservasiKonsultasiController::class, 'destroy'])->name('reservasi.destroy');


Route::get('/reservation', function () {
    return view('reservation');
})->name('reservation'); 

Route::get('/obat', function () {
    return view('obat');
})->name('obat');

Route::get('/listObat', [ObatController::class, 'showKatalog'])->name('listObat');
Route::get('/jenisObat/{jenis}', [ObatController::class, 'getAllObatByJenis'])->name('jenisObat');

// Route::get('/detailObat', function () {
//     return view('detailObat');
// })->name('detailObat');

Route::get('/cart', function(){
    return view('cart');
})->name('cart');


Route::get('/about', function () {
    return view('about');
})->name('about');

// Route::get('/pembelianObat/{id}', function (int $id) {
//     // return view('obat');
//     $data = PembelianObat::where('id_transaksi' ,$id)->get();
//     return response()->json($data);
// })->name('pembelianObat.showByIdTransaksi');

// Route::post('/pembelianObat/store', [PembelianObatController::class, 'storeToCart'] 
// )->name('pembelianObat.storeToCart');

Route::post('/obat/store/{id}', function(Request $request, $id){
    $validatedData = $request->validate([
        'jumlah_obat' => 'required|integer',
    ]);

    // Prepare item data
    $item = [
        'id_obat' => $id,
        'jumlah_obat' => $validatedData['jumlah_obat'],
    ];

    // Add or create cart items array in session
    $cart = Session::get('cart.items', []);
    $cart[] = $item;
    Session::put('cart.items', $cart);
    
    return back()->with('success', 'Item ditambahkan ke keranjang');
}
    // return response()->json($item);
// [ObatController::class, 'store'] 
)->name('obat.store');

Route::put('/obat/update/{id}', [ObatController::class, 'update']
    // return response()->json($item);
// [ObatController::class, 'store'] 
)->name('obat.update');

Route::middleware('auth')->group(
    function () {
        Route::get('/obat', [ObatController::class, 'index'])->name('getObat');
        Route::get('/detail-obat/{id}', [ObatController::class, 'detail'])->name('getDetailObat');
        Route::post('/add-to-cart/{id}', [TransaksiController::class, 'addToCart'])->name('addToCart');
        Route::get('/cart', [TransaksiController::class, 'getCart'])->name('getCart');
        Route::post('/cart/{id}/{value}', [TransaksiController::class, 'setValueCart'])->name('setValueCart');
        Route::post('/checkout', [TransaksiController::class, 'checkout'])->name('checkout');
        Route::post('/active-item/{id}', [TransaksiController::class, 'activeItem'])->name('activeItem');
        Route::post('/payment-obat', [TransaksiController::class, 'storePembelianObat'])->name('paymentObat');
    }
);

/////
Route::get('/transaksiCheckout',function(){
    return view('/transaksiCheckout');
})->name('transaksiCheckout');

Route::get('/transaksiCheckoutKonsul',function(){
    return view('/transaksiCheckoutKonsul');
})->name('transaksiCheckoutKonsul');

Route::get('/pembayaranObat',function(){
    return view('/pembayaranObat');
})->name('pembayaranObat');

Route::get('/pembayaranKonsul',function(){
    return view('/pembayaranKonsul');
})->name('pembayaranKonsul');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::get('/admin/listofmedicines', function () {
    return view('admin.listofmedicines');
});
Route::get('/admin/medicinegroups', function () {
    return view('admin.medicinegroups');
});
Route::get('/admin/usermanagement', function () {
    return view('admin.usermanagement');
});


Route::get('/admin/detail', function () {
    return view('admin.detail');
});
Route::get('/admin/detailgroup', function () {
    return view('admin.detailgroup');
});
Route::get('/admin/editmedicine', function () {
    return view('admin.editmedicine');
});
Route::get('/admin/addmedicine', function () {
    return view('admin.addmedicine');
});
Route::get('/admin/editprofile', function () {
    return view('admin.editprofile');
});