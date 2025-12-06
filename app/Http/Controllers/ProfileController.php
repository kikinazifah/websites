<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ProfileController extends Controller
{
    // Menampilkan halaman profile
    public function index()
    {
        $user = Auth::user();
        $totalDonations = Donation::where('user_id', $user->id)->count();
        return view('pages.profile.index', compact('user', 'totalDonations'));
    }

    // Menyimpan perubahan profile
    public function update(Request $request)
    {

        $role = Session::get('role');
        if (!in_array($role, ['user'])) {
            abort(403, 'Akses ditolak');
        }
        $user = Auth::user();

        // 2. Validasi Input
        $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
            'password' => ['nullable', 'min:8'],
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // 5. Simpan ke Database
        $user->save();

        // 6. Kembali ke halaman sebelumnya dengan pesan sukses
        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}