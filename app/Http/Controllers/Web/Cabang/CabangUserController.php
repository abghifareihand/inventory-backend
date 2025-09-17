<?php

namespace App\Http\Controllers\Web\Cabang;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class CabangUserController extends Controller
{
    // Tampilkan semua sales cabang ini
    public function index()
    {
        $branchId = Auth::user()->branch_id;

        $sales = User::where('role', 'sales')
                    ->where('branch_id', $branchId)
                    ->orderBy('name', 'asc')
                    ->paginate(10);

        return view('pages.cabang.user.index', compact('sales'));
    }

    // Form tambah sales
    public function create()
    {
        return view('pages.cabang.user.create');
    }

    // Simpan sales baru
    public function store(Request $request)
    {
        $branchId = Auth::user()->branch_id;

        $request->validate([
            'name' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username',
            'password' => 'required|string|min:6',
        ], [
            'name.required' => 'Name tidak boleh kosong!',
            'username.required' => 'Username tidak boleh kosong!',
            'password.required' => 'Password tidak boleh kosong!',
            'password.min' => 'Password minimal 6 karakter!',
        ]);

        User::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'branch_id' => $branchId,
            'role' => 'sales',
        ]);

        return redirect()->route('cabang.user.index')
                         ->with('success', 'User sales berhasil dibuat');
    }
}
