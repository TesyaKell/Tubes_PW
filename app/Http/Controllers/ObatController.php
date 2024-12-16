<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use Exception;
use Illuminate\Http\Request;

class ObatController extends Controller
{
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nama_obat' => 'required|string|max:255',
                'stok' => 'required|integer',
                'harga_obat' => 'required|integer',
                'jenis_obat' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
                // 'image' => 'required|string', 
            ]);

            $user = Obat::create([
                'nama_obat' => $request->nama_obat,
                'stok' => $request->stok,
                'harga_obat' => $request->harga_obat,
                'jenis_obat' => $request->jenis_obat,
                'deskripsi' => $request->deskripsi,
            ]);

            return response()->json([
                'user' => $user,
                'message' => 'Obat registered successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'user' => null,
                'message' => 'error occured'
            ], 500);
        }
    }

    public function index()
    {
        try {
            $data = Obat::all();
            $jenisObat = Obat::all()->unique('jenis_obat');
            return view('home', [
                "data" => $data,
                "jenisObat" => $jenisObat
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage(),
            ], 400);
        }
    }

    public function showKatalog()
    {
        try {
            $data = Obat::all();
            return view('jenisObat', [
                "data" => $data,
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage(),
            ], 400);
        }
    }
    public function getAllObatByJenis(String $jenis)
    {
        $jenisObat = Obat::where('jenis_obat', $jenis)->get();
        return view('jenisObat', [
            "data" => $jenisObat,
        ]);
    }
    public function show($id)
    {
        try {
            $data = Obat::find($id);
            return view('detailObat', [
                'product' => $data
            ]);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage(),
            ], 400);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = Obat::findOrFail($id);
            $validData = $request->validate([
                'nama_obat' => 'required|string|max:255',
                'stok' => 'required|integer',
                'harga_obat' => 'required|integer',
                'jenis_obat' => 'required|string|max:255',
                'deskripsi' => 'required|string|max:255',
            ]);

            $data->update($validData);
            return response()->json([
                "status" => true,
                "message" => "Update Data Successful",
                "data" => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage(),
            ], 400);
        }
    }


    public function destroy($id)
    {
        try {
            $data = Obat::findOrFail($id);
            $data->delete();
            return response()->json([
                "status" => true,
                "message" => "Delete Successful",
                "data" => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage(),
            ], 400);
        }
    }
    public function search($nama)
    {
        try {
            // Menggunakan where untuk mencari berdasarkan nama
            $data = Obat::where('nama_obat', 'like', '%' . $nama . '%')->get();

            if ($data->isEmpty()) {
                return response()->json([
                    "status" => false,
                    "message" => "Obat not found",
                    "data" => [],
                ], 404);
            }

            return response()->json([
                "status" => true,
                "message" => "Get Successful",
                "data" => $data,
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "status" => false,
                "message" => "Something went wrong",
                "data" => $e->getMessage(),
            ], 400);
        }
    }
}
