<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Obat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function adminDashboard()
    {
        $totalCustomers = User::where('role', 'customer')->count();

        $totalObat = Obat::all()->count();

        $uniqueGroups = Obat::select('jenis_obat')
            ->whereNotNull('jenis_obat')
            ->groupBy('jenis_obat')
            ->get();

        $totalGroups = $uniqueGroups->count();

        return view('admin.dashboard', compact('totalCustomers', 'totalObat', 'totalGroups'));
    }


    //USER MANAGEMENT
    public function userManagement(Request $request)
    {
        $query = User::where('role', 'customer');

        if ($request->has('search')) {
            $searchTerm = $request->search;
            $query->where('name', 'LIKE', "%{$searchTerm}%");
        }

        $users = $query->paginate(8);
        $totalUsers = $query->count();

        return view('admin.usermanagement', [
            'users' => $users,
            'totalUsers' => $totalUsers
        ]);
    }

    public function editUser(User $user)
    {
        return view('admin.editprofile', compact('user'));
    }


    public function updateUser(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string',
            'address' => 'required|string',
            'password' => 'nullable|min:8',
        ]);

        $userData = $request->except('password');

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        $user->update($userData);

        return redirect()->route('admin.users')->with('success', 'User updated successfully');
    }

    public function deleteUser(User $user)
    {
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted successfully');
    }
    //USER MANAGEMENT



    //OBAT MANAGEMENT
    public function listMedicines(Request $request)
    {
        $query = Obat::query();

        if ($request->has('search')) {
            $search = $request->search;
            $query->where('nama_obat', 'LIKE', "%{$search}%")
                ->orWhere('jenis_obat', 'LIKE', "%{$search}%");
        }

        if ($request->has('jenis') && $request->jenis != '') {
            $query->where('jenis_obat', $request->jenis);
        }

        $obats = $query->paginate(8);
        $jenisObat = Obat::distinct()->pluck('jenis_obat');

        return view('admin.listofmedicines', [
            'obats' => $obats,
            'jenisObat' => $jenisObat
        ]);
    }

    public function detailObat(Obat $obat)
    {
        return view('admin.detail', compact('obat'));
    }

    public function createObat()
    {
        $jenisObat = Obat::distinct()->pluck('jenis_obat');
        return view('admin.addmedicine', compact('jenisObat'));
    }

    public function storeObat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required',
            'stok' => 'required|numeric|min:0',
            'harga_obat' => 'required|numeric|min:0',
            'jenis_obat' => 'required',
            'deskripsi' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);

            $obat = new Obat();
            $obat->nama_obat = $request->nama_obat;
            $obat->stok = $request->stok;
            $obat->harga_obat = $request->harga_obat;
            $obat->jenis_obat = $request->jenis_obat;
            $obat->deskripsi = $request->deskripsi;
            $obat->image = $imageName;
            $obat->save();

            return redirect('/admin/listofmedicines');
        } catch (\Exception $e) {
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat menambahkan obat: ' . $e->getMessage());
        }
    }


    public function editObat(Obat $obat)
    {
        $jenisObat = Obat::distinct()->pluck('jenis_obat');
        return view('admin.editmedicine', compact('obat', 'jenisObat'));
    }

    public function updateObat(Request $request, Obat $obat)
    {
        // Validasi request
        $request->validate([
            'nama_obat' => 'required',
            'stok' => 'required|numeric|min:0',
            'harga_obat' => 'required|numeric|min:0',
            'jenis_obat' => 'required',
            'deskripsi' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        try {
            $obat->nama_obat = $request->nama_obat;
            $obat->stok = $request->stok;
            $obat->harga_obat = $request->harga_obat;
            $obat->jenis_obat = $request->jenis_obat;
            $obat->deskripsi = $request->deskripsi;

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $imageName = time() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('images/'), $imageName);
                $obat->image = $imageName;
            }

            $obat->save();

            return redirect()->route('admin.medicine.detail', $obat->id)
                ->with('success', 'Data obat berhasil diperbarui');
        } catch (\Exception $e) {
            $jenisObat = Obat::distinct()->pluck('jenis_obat');
            return back()->withInput()
                ->with('error', 'Terjadi kesalahan saat memperbarui data')
                ->with(compact('jenisObat'));
        }
    }

    public function deleteObat(Obat $obat)
    {
        try {
            $obat->delete();
            return redirect('/admin/listofmedicines')
                ->with('success', 'Obat berhasil dihapus');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menghapus obat');
        }
    }

    //OBAT MANAGEMENT



    //GROUP MANAGEMENT
    public function medicineGroups(Request $request)
    {
        $query = Obat::select('jenis_obat')
            ->selectRaw('COUNT(*) as total_medicines')
            ->whereNotNull('jenis_obat')
            ->groupBy('jenis_obat');

        // Handle search
        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('jenis_obat', 'LIKE', "%{$search}%");
        }

        $groups = $query->get();
        $uniqueGroups = DB::table('obats')
            ->select('jenis_obat')
            ->whereNotNull('jenis_obat')
            ->distinct()
            ->get()
            ->pluck('jenis_obat');

        $totalGroups = $uniqueGroups->count();

        return view('admin.medicinegroups', compact('groups', 'totalGroups'));
    }

    public function detailGroup($jenis)
    {
        $obats = Obat::where('jenis_obat', $jenis)->get();

        $totalObat = $obats->count();

        $groupName = $jenis;

        return view('admin.detailgroup', compact('obats', 'totalObat', 'groupName'));
    }

    public function storeGroup(Request $request)
    {
        $request->validate([
            'jenis_obat' => [
                'required',
                Rule::unique('obats', 'jenis_obat')->whereNotNull('jenis_obat')
            ]
        ]);

        try {
            DB::table('obats')
                ->insert([
                    'nama_obat' => 'temp',
                    'stok' => 0,
                    'harga_obat' => 0,
                    'jenis_obat' => $request->jenis_obat,
                    'deskripsi' => 'temp',
                    'image' => 'default.jpg',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            return redirect()->route('admin.medicinegroups')
                ->with('success', 'Group baru berhasil ditambahkan');
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan saat menambahkan grup');
        }
    }

    public function deleteGroup($group)
    {
        try {
            Obat::where('jenis_obat', $group)->delete();

            return redirect()->route('admin.medicinegroups')
                ->with('success', 'Group deleted successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to delete group');
        }
    }

    public function removeMedicine($jenis_obat, $obat)
    {
        try {
            $obat = Obat::findOrFail($obat);
            $obat->update(['jenis_obat' => null]);

            return redirect()->back()->with('success', 'Medicine removed from group successfully');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to remove medicine from group');
        }
    }

    public function removeFromGroup($group, $obat)
    {
        try {
            $obat = Obat::findOrFail($obat);
            $obat->delete();

            return redirect()->back()
                ->with('success', 'Medicine removed from group successfully');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Failed to remove medicine from group');
        }
    }

    public function addToGroup(Request $request, $group)
    {
        $request->validate([
            'medicine_id' => 'required'
        ]);

        try {
            $obat = Obat::where('nama_obat', 'LIKE', '%' . $request->medicine_id . '%')
                ->orWhere('id', $request->medicine_id)
                ->first();

            if (!$obat) {
                return back()->with('error', 'Medicine not found');
            }

            $obat->update(['jenis_obat' => $group]);

            return back()->with('success', 'Medicine added to group successfully');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to add medicine to group');
        }
    }

    //GROUP MANAGEMENT


}