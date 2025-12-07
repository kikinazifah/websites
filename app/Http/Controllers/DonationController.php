<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DonationLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DonationController extends Controller
{
    public function donation(Request $request)
    {
        $locationId = $request->query('location');

        $selectedLocation = null;
        if ($locationId) {
            $selectedLocation = DonationLocation::find($locationId);
        }

        return view('pages.donation.index', compact('selectedLocation'));
    }

    public function store(Request $request)
    {
        // Pastikan user login
        if (! Auth::check()) {
            return redirect()
                ->route('login')
                ->with('error', 'Silakan login terlebih dahulu sebelum mengirim donasi.');
        }

        // Validasi input
        $validated = $request->validate([
            'donation_location_id' => ['required', 'exists:donation_locations,id'],
            'donor_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'item_type' => ['required', 'string', 'max:100'],
            'delivery_type' => ['required', 'in:jemput,antar'],
            'item_description' => ['required', 'string'],

            // foto opsional, max 3 file
            'photos' => ['nullable'], // cukup nullable
            'photos.*' => ['nullable', 'image', 'mimes:jpeg,png,jpg', 'max:2048'], // max 2MB per file

        ]);

        // Handle upload foto (kalau ada)
        $photoPaths = [];

        if ($request->hasFile('photos')) {
            $files = $request->file('photos');

            // Kadang bisa berupa single UploadedFile, kadang array
            if (! is_array($files)) {
                $files = [$files];
            }

            foreach ($files as $index => $file) {
                // batas maksimal 3 file
                if ($index >= 3) {
                    break;
                }

                if ($file && $file->isValid()) {
                    $path = $file->store('donations', 'public'); // storage/app/public/donations
                    $photoPaths[] = $path;
                }
            }
        }

        // Simpan ke DB
        $donation = Donation::create([
            'user_id' => Auth::id(),
            'donation_location_id' => $validated['donation_location_id'],
            'donor_name' => $validated['donor_name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'item_type' => $validated['item_type'],
            'delivery_type' => $validated['delivery_type'],
            'item_description' => $validated['item_description'],
            'photos' => $photoPaths, // model Donation sudah di-cast ke array
            'status' => 'pending',   // default
        ]);

        // Redirect + flash message
        return redirect()
            ->route('profile.index')
            ->with('success_donation_id', $donation->id)// Kirim ID ke session
            ->with('success', 'Terima kasih, donasi Anda berhasil dikirim dan akan segera diproses.');
    }

    // TAMBAHAN: Method untuk Upload Bukti Verifikasi
    public function uploadProof(Request $request)
    {
        $request->validate([
            'donation_id' => 'required|exists:donations,id',
            'proof_photo' => 'required|image|max:2048', // Max 2MB
        ]);

        // Cari donasi berdasarkan ID dan pastikan milik user yang sedang login
        $donation = Donation::where('id', $request->donation_id)
            ->where('user_id', Auth::id())
            ->first();

        if (! $donation) {
            return back()->with('error', 'ID Donasi tidak ditemukan atau bukan milik Anda.');
        }

        // Upload File
        if ($request->hasFile('proof_photo')) {
            $path = $request->file('proof_photo')->store('proofs', 'public');

            $donation->update([
                'proof_photo' => $path,
                // Opsional: Langsung ubah status jadi 'diproses' jika mau otomatis
                // 'status' => 'diproses'
            ]);
        }

        return back()->with('success', 'Bukti verifikasi berhasil diunggah! Admin akan segera mengecek.');
    }
}
