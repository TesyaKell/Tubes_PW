<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\PembelianObat;
use App\Models\transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class TransaksiController extends Controller
{
    //
    public function storePembelianObat(Request $request)
    {
        $data = $request->all();
        $cart = session()->get('cart', []);
        $userId = Auth::user()->id;

        $validate = Validator::make($data, [
            'bayarwoi' => 'required',
        ]);

        if ($validate->fails()) {
            return redirect()->back()->with('errorToast', 'Transaction failed: ' . $validate->errors()->first());
        }

        $data_transaksi = [
            'id_user' => $userId,
            'status_pengiriman' => 'Pending',
            'total_harga' => 0,
            'metode_transaksi' => $data['bayarwoi'],
            'total_bayar' => 0,
            'status_transaksi' => 'Pending',
        ];

        DB::beginTransaction();
        try {
            $total_harga = 0;

            // Validasi stok sebelum melanjutkan transaksi
            foreach ($cart as $obat) {
                if ($obat['selected']) {
                    $currentObat = Obat::find($obat['id']);
                    if (!$currentObat || $currentObat->stok < $obat['jumlah_obat']) {
                        throw new \Exception('Stok obat ' . $obat['nama_obat'] . ' tidak mencukupi');
                    }
                }
            }

            foreach ($cart as $obat) {
                if ($obat['selected']) {
                    $harga_obat = Obat::where('id', $obat['id'])->value('harga_obat');
                    $total_harga += $harga_obat * $obat['jumlah_obat'];
                }
            }

            $data_transaksi['total_harga'] = $total_harga;
            $transaksi = transaksi::create($data_transaksi);

            $pembelian_data = [];
            $index = 0;
            foreach ($cart as $obat) {
                if ($obat['selected']) {
                    $harga_obat = Obat::where('id', $obat['id'])->value('harga_obat');
                    $pembelian_data[$index] = [
                        'id_transaksi' => $transaksi->id_transaksi,
                        'id_obat' => $obat['id'],
                        'harga_obat' => $harga_obat,
                        'jumlah_obat' => $obat['jumlah_obat'],
                    ];

                    // Update stok obat
                    $currentObat = Obat::find($obat['id']);
                    $currentObat->stok -= $obat['jumlah_obat'];
                    $currentObat->save();

                    $index++;
                }
            }

            PembelianObat::insert($pembelian_data);

            DB::commit();

            // Persiapkan data untuk view
            $index = 0;
            foreach ($cart as $obat) {
                if ($obat['selected']) {
                    $harga_obat = Obat::where('id', $obat['id'])->value('harga_obat');
                    $pembelian_data[$index] = [
                        'id_transaksi' => $transaksi->id_transaksi,
                        'id_obat' => $obat['id'],
                        'harga_obat' => $harga_obat,
                        'jumlah_obat' => $obat['jumlah_obat'],
                        'nama_obat' => $obat['nama_obat'],
                    ];
                    $index++;
                }
            }

            $data_transaksi['pembelian'] = $pembelian_data;
            $lastId = transaksi::latest()->first();
            $data_transaksi['id'] = $lastId['id_transaksi'];

            session()->forget('cart');

            return view('pembayaranObat')->with([
                'successToast' => 'Transaction successful!',
                'data' => $data_transaksi
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return view('home')->with('errorToast', 'Transaction failed: ' . $e->getMessage());
        }
    }

    public function addToCart($id, Request $request)
    {
        $obat = Obat::find($id);
        $jumlah = $request->input('jumlah_obat', 1);

        if (!$obat) {
            return redirect()->back()->with('errorToast', 'Obat tidak ditemukan.');
        }

        // Validasi stok
        if ($jumlah > $obat->stok) {
            return redirect()->back()->with('errorToast', 'Jumlah melebihi stok yang tersedia. Stok tersisa: ' . $obat->stok);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            // Jika obat sudah ada di cart, validasi total jumlah
            $newTotal = $cart[$id]['jumlah_obat'] + $jumlah;
            if ($newTotal > $obat->stok) {
                return redirect()->back()->with('errorToast', 'Total jumlah melebihi stok yang tersedia. Stok tersisa: ' . $obat->stok);
            }
            $cart[$id]['jumlah_obat'] = $newTotal;
        } else {
            $cart[$id] = [
                'selected' => false,
                'id' => $obat->id,
                'nama_obat' => $obat->nama_obat,
                'harga_obat' => $obat->harga_obat,
                'image' => $obat->image,
                'jumlah_obat' => $jumlah,
            ];
        }

        session()->put('cart', $cart);
        return back()->with('successToast', 'Successfully added to the cart.');
    }

    public function getCart()
    {
        $cart = session()->get('cart', []);
        // dd(count($cart));
        return view('cart', ['cart' => $cart]);
    }

    public function setValueCart($id, $value)
    {
        $cart = session()->get('cart', []);

        if (!isset($cart[$id])) {
            return redirect('cart')->with('errorToast', 'Item tidak ditemukan dalam keranjang.');
        }

        // Ambil data obat untuk cek stok
        $obat = Obat::find($id);
        if (!$obat) {
            return redirect('cart')->with('errorToast', 'Obat tidak ditemukan.');
        }

        $newQuantity = $cart[$id]['jumlah_obat'] + $value;

        // Validasi jumlah tidak boleh negatif
        if ($newQuantity < 0) {
            return redirect('cart')->with('errorToast', 'Jumlah obat tidak boleh negatif.');
        }

        // Validasi jumlah tidak boleh melebihi stok
        if ($newQuantity > $obat->stok) {
            return redirect('cart')->with('errorToast', 'Jumlah melebihi stok yang tersedia. Stok tersisa: ' . $obat->stok);
        }

        if ($newQuantity == 0) {
            unset($cart[$id]);
        } else {
            $cart[$id]['jumlah_obat'] = $newQuantity;
        }

        session()->put('cart', $cart);

        return redirect('cart')->with('successToast', 'Keranjang berhasil diperbarui.');
    }

    public function checkout()
    {
        $cart = session()->get('cart', []);

        $dataObat = [];
        $sum = 0;

        foreach ($cart as $item) {
            if ($item['selected']) {
                $dataObat[$item['id']] = [
                    'id' => $item['id'],
                    'nama_obat' => $item['nama_obat'],
                    'jumlah_obat' => $item['jumlah_obat'],
                    'harga_obat' => $item['harga_obat'],
                    'total_harga' => $item['jumlah_obat'] * $item['harga_obat'],
                    'image' => $item['image']
                ];
                $sum += $item['jumlah_obat'] * $item['harga_obat'];
            }
        }

        if ($sum == 0) {
            return redirect('cart')->with('error', 'Tidak ada item yang dipilih.');
        }

        $dataReturn = [
            'data_obat' => $dataObat,
            'total_harga' => $sum,
            'total_pembayaran' => $sum
        ];

        return view('transaksiCheckout', ['data' => $dataReturn]);
    }

    public function activeItem($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['selected'] = !$cart[$id]['selected'];
        }

        session()->put('cart', $cart);

        return response()->json(['status' => 'success']);
    }
}
