<?php

namespace App\Http\Controllers;

use App\Models\DonationLocation;
use App\Models\Donation;
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
            'donation_location_id' => ['required', 'exists:donation_locations,id'], // wajib pilih titik donasi
            'donor_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:50'],
            'address' => ['required', 'string'],
            'item_type' => ['required', 'string', 'max:100'],
            'delivery_type' => ['required', 'in:jemput,antar'],
            'item_description' => ['required', 'string'],

            // foto opsional, max 3 file
            'photos' => ['sometimes', 'array', 'max:3'],
            'photos.*' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'], // max 2MB per file
        ]);

        // Handle upload foto (kalau ada)
        $photoPaths = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $index => $file) {
                // batas ekstra di sisi server (walau sudah divalidate max:3)
                if ($index >= 3) {
                    break;
                }

                // simpan ke storage/app/public/donations
                $path = $file->store('donations', 'public');
                $photoPaths[] = $path;
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
            ->route('donation.index')
            ->with('success', 'Terima kasih, donasi Anda berhasil dikirim dan akan segera diproses.');
    }
}
