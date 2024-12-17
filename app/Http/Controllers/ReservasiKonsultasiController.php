<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\ReservasiKonsultasi;
use Illuminate\Http\Request;

class ReservasiKonsultasiController extends Controller
{

    public function index()
    {
        $reservasi = ReservasiKonsultasi::with('user')->get();
        return view('reservasi', compact('reservasi'));

    }

    public function create()
    {
        return view('reservasi');
    }

    public function store(Request $request) {
        $request->validate([
            'metode_transaksi_reservasi' => 'required|string',
        ]);

        ReservasiKonsultasi::create([
            'id_user' => Auth::id(),
            'nama_lengkap_pasien' => session('name'),
            'keluhan' => session('complaint'),
            'usia_pasien' => session('age'),
            'jenis_kelamin' => session('gender'),
            'berat_badan_pasien' => session('weight'),
            'alergi_pasien' => session('allergies'),
            'tanggal_reservasi_konsultasi' => session('consultation_date'),
            'jam_reservasi_konsultasi' => session('consultation_time'),
            'harga_reservasi_konsultasi' => session('harga_reservasi_konsultasi'),
            'metode_transaksi_reservasi' => $request->metode_transaksi_reservasi,
            'status_reservasi' => 'Completed',
        ]);
        
        return redirect()->route('reservasi.history')->with('success', 'Reservation successfully made.');
    }

    public function storeConsultation(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:0',
            'gender' => 'required|string',
            'weight' => 'required|numeric|min:0',
            'allergies' => 'nullable|string',
            'consultation_date' => 'required|date|after_or_equal:today',
            'consultation_time' => 'required|string',
            'complaint' => 'required|string',
        ]);

        // Simpan data ke session
        session([
            'name' => $request->name,
            'age' => $request->age,
            'gender' => $request->gender,
            'weight' => $request->weight,
            'allergies' => $request->allergies,
            'consultation_date' => $request->consultation_date,
            'consultation_time' => $request->consultation_time,
            'complaint' => $request->complaint,
            'harga_reservasi_konsultasi' => 35000,
        ]);

        // Redirect ke halaman checkout
        return redirect()->route('transaksiCheckoutKonsul');
    }

    public function history() {
        $reservasi = ReservasiKonsultasi::where('id_user', Auth::id())->get();
        return view('historyreservasi', compact('reservasi'));
    }



    public function show($id)
    {
        $reservasi = ReservasiKonsultasi::findOrFail($id);
        return view('reservasi', compact('reservasi'));
    }

    public function edit($id)
    {
        $reservasi = ReservasiKonsultasi::findOrFail($id);
        return view('reservasi', compact('reservasi'));
    }


    public function destroy($id)
    {
        $reservasi = ReservasiKonsultasi::findOrFail($id);
        $reservasi->delete();
        return redirect()->route('reservasi.index')->with('success', 'Reservasi berhasil dihapus.');
    }
}
