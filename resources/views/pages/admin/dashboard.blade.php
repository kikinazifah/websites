<x-admin-layout>

    <div class="min-h-screen bg-[#FBF8F5] p-8">

        {{-- Judul --}}
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Dashboard</h1>
            <p class="text-gray-500 text-sm mt-1">Ringkasan aktivitas donasi terkini.</p>
        </div>

        {{-- GRID SUMMARY (4 KARTU ATAS) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

            {{-- Kartu 1: Total Donasi Masuk --}}
            <div
                class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:shadow-md transition-shadow">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-emerald-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-emerald-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 font-medium">Total Donasi Masuk</p>
                <p class="text-3xl font-bold mt-1 text-gray-800">{{ $totalDonasi }}</p>
            </div>

            {{-- Kartu 2: Barang Tersalurkan --}}
            <div
                class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:shadow-md transition-shadow">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-blue-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 font-medium">Barang Tersalurkan</p>
                <p class="text-3xl font-bold mt-1 text-gray-800">{{ $barangTersalurkan }}</p>
            </div>

            {{-- Kartu 3: Donatur Aktif --}}
            <div
                class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:shadow-md transition-shadow">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-purple-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 font-medium">Donatur Aktif</p>
                <p class="text-3xl font-bold mt-1 text-gray-800">{{ $donaturAktif }}</p>
            </div>

            {{-- Kartu 4: Penerima Manfaat --}}
            <div
                class="bg-white border border-gray-100 rounded-2xl shadow-sm p-6 text-center hover:shadow-md transition-shadow">
                <div class="inline-flex items-center justify-center w-12 h-12 rounded-full bg-orange-50 mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-orange-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <p class="text-sm text-gray-500 font-medium">Penerima Manfaat</p>
                <p class="text-3xl font-bold mt-1 text-gray-800">{{ $penerimaManfaat }}</p>
            </div>

        </div>

        {{-- GRID BAWAH (TABLE & MAP) --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- TABEL DONASI TERBARU (Mengambil 2 kolom grid) --}}
            <div class="lg:col-span-2 p-5 bg-white border border-gray-200 rounded-2xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-800">Donasi Terbaru</h3>
                    <a href="{{ route('admin.donasi') }}"
                        class="text-sm text-emerald-600 hover:text-emerald-700 font-medium">Lihat Semua</a>
                </div>

                <div class="overflow-x-auto">
                    {{-- Tambahkan 'border border-gray-200' di tabel utama --}}
                    <table class="w-full text-sm text-left border-collapse border border-gray-200">

                        {{-- Header Tabel --}}
                        <thead>
                            <tr class="bg-card text-slate-900 text-center font-semibold">
                                {{-- Tambahkan class 'border' di setiap TH --}}
                                <th class="border px-4 py-3">No</th>
                                <th class="border px-4 py-3">Tanggal</th>
                                <th class="border px-4 py-3">Donatur</th>
                                <th class="border px-4 py-3">Barang</th>
                                <th class="border px-4 py-3">Status</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white">
                            @forelse($latestDonations as $index => $donation)
                                <tr class="hover:bg-gray-50 transition-colors">

                                    {{-- Kolom No --}}
                                    <td class="border  px-4 py-3 text-center text-gray-500">
                                        {{ $index + 1 }}
                                    </td>

                                    {{-- Kolom Tanggal --}}
                                    <td class="border px-4 py-3 font-medium text-gray-700">
                                        {{ $donation->created_at->format('d M Y') }}
                                        <span class="block text-xs text-gray-400 font-normal">
                                            {{ $donation->created_at->format('H:i') }} WIB
                                        </span>
                                    </td>

                                    {{-- Kolom Donatur --}}
                                    <td class="border px-4 py-3">
                                        <div class="flex items-center gap-3">
                                            <div
                                                class="w-8 h-8 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-xs shrink-0">
                                                {{ substr($donation->donor_name, 0, 1) }}
                                            </div>
                                            <span class="text-gray-700 truncate max-w-[150px]">
                                                {{ $donation->donor_name }}
                                            </span>
                                        </div>
                                    </td>

                                    {{-- Kolom Barang --}}
                                    <td class="border  px-4 py-3 text-gray-600">
                                        {{ $donation->item_type }}
                                    </td>

                                    {{-- Kolom Status --}}
                                    <td class="border  px-4 py-3 text-center">
                                        @php
                                            $statusClass = match ($donation->status) {
                                                'pending' => 'bg-amber-100 text-amber-700 border-amber-200',
                                                'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                                'selesai' => 'bg-emerald-100 text-emerald-700 border-emerald-200',
                                                'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                                                default => 'bg-gray-100 text-gray-700 border-gray-200',
                                            };
                                            $statusLabel = ucfirst($donation->status);
                                        @endphp
                                        <span
                                            class="px-3 py-1 rounded-full text-xs font-semibold border {{ $statusClass }}">
                                            {{ $statusLabel }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                {{-- State Kosong --}}
                                <tr>
                                    <td colspan="5"
                                        class="border border-gray-200 px-6 py-12 text-center text-gray-400">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 text-gray-300"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                            </svg>
                                            <p>Belum ada data donasi masuk.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            {{-- MAP LOCATION (Mengambil 1 kolom grid) --}}
            <div class="bg-white border border-gray-200 rounded-2xl shadow-sm p-4 h-fit">
                <div class="flex justify-between items-center mb-4 px-2">
                    <h3 class="text-lg font-bold text-gray-800">Sebaran Lokasi</h3>
                    <button
                        class="text-xs bg-gray-100 hover:bg-gray-200 px-3 py-1 rounded-full transition">Refresh</button>
                </div>

                <div class="w-full aspect-square rounded-xl overflow-hidden border border-gray-100 relative group">
                    {{-- Placeholder Map --}}
                    <img src="https://visgl.github.io/react-google-maps/images/examples/basic-map.jpg"
                        class="w-full h-full object-cover group-hover:scale-105 transition duration-500"
                        alt="Map Placeholder">

                    {{-- Overlay interaktif sederhana --}}
                    <div
                        class="absolute inset-0 bg-black/5 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center pointer-events-none">
                        <span class="bg-white/90 px-3 py-1 rounded-md text-xs font-bold shadow-sm">Lihat Detail</span>
                    </div>
                </div>

                <div class="mt-4 px-2">
                    <div class="flex items-center justify-between text-sm text-gray-600 mb-2">
                        <span>Titik Donasi Aktif</span>
                        <span class="font-bold text-emerald-600">{{ $totalTitikDonasi }} Lokasi</span>
                    </div>
                    {{-- LOGIKA PERSENTASE EUY --}}
                    @php
                        // 1. Tentukan target (Misalnya target kita ingin punya 50 titik donasi)
                        $targetLokasi = 50;

                        // 2. Hitung persentase (Jumlah Sekarang / Target * 100)
                        $persentase = $totalTitikDonasi > 0 ? ($totalTitikDonasi / $targetLokasi) * 100 : 0;

                        // 3. Batasi maksimal 100% (supaya tidak bablas keluar bar)
                        if ($persentase > 100) {
                            $persentase = 100;
                        }

                        // 4. Batasi minimal 5% (supaya bar-nya tetap kelihatan sedikit walau data 0/sedikit, opsi visual)
                        if ($persentase < 5 && $totalTitikDonasi > 0) {
                            $persentase = 5;
                        }
                    @endphp

                    <div class="w-full bg-gray-100 rounded-full h-2">
                        {{-- Masukkan variabel $persentase ke dalam style width --}}
                        <div class="bg-emerald-500 h-2 rounded-full transition-all duration-1000 ease-out"
                            style="width: {{ $persentase }}%">
                        </div>
                    </div>

                    {{-- Opsional: Menampilkan teks target di bawah bar --}}
                    <p class="text-xs text-gray-400 mt-2 text-right">Target: {{ $targetLokasi }} Lokasi</p>
                </div>
            </div>

        </div>

    </div>

</x-admin-layout>
