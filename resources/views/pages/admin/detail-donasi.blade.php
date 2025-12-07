<x-admin-layout>
    <div class="min-h-screen bg-[#FBF8F5] p-8">

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Detail Barang Donasi</h1>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm max-w-5xl mx-auto p-8">

            {{-- BAGIAN GAMBAR (GRID 2 KOLOM) --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10 border-b border-gray-100 pb-8">

                <div class="flex flex-col items-center">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4">Foto Barang</h3>

                    @php
                        // Ambil semua path foto (bisa array cast atau string JSON)
                        $photosRaw = $donation->photos;
                        if (is_string($photosRaw)) {
                            $photosRaw = json_decode($photosRaw, true) ?: [];
                        }
                        $photos = is_array($photosRaw) ? array_slice($photosRaw, 0, 3) : [];
                    @endphp

                    @if (count($photos))
                        @php
                            $count = count($photos);

                            // Tentukan jumlah kolom berdasar jumlah foto
                            $gridCols = $count === 1 ? 'grid-cols-1' : ($count === 2 ? 'grid-cols-2' : 'grid-cols-3');
                        @endphp

                        <div class="grid {{ $gridCols }} gap-4 w-full max-w-[300px]">

                            @foreach ($photos as $path)
                                <div
                                    class="aspect-square rounded-2xl overflow-hidden shadow-md border border-gray-200 group relative bg-gray-50">
                                    <img src="{{ asset('storage/' . $path) }}" alt="Foto Barang Donasi"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                                    {{-- overlay tombol lihat --}}
                                    <a href="{{ asset('storage/' . $path) }}" target="_blank"
                                        class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <span
                                            class="bg-white/90 text-gray-800 text-[10px] font-semibold px-2 py-1 rounded-full shadow">
                                            Lihat Gambar
                                        </span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @else
                        {{-- placeholder --}}
                        <div
                            class="w-full aspect-square max-w-[300px] rounded-2xl overflow-hidden shadow-md border border-gray-200 bg-gray-100 flex items-center justify-center text-gray-400 flex-col gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2" />
                                <circle cx="8.5" cy="8.5" r="1.5" />
                                <polyline points="21 15 16 10 5 21" />
                            </svg>
                            <span class="text-xs">Tidak ada foto barang</span>
                        </div>
                    @endif
                </div>


                {{-- 2. FOTO BUKTI (FIXED VERSION) --}}
                <div class="flex flex-col items-center">
                    <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-4 flex items-center gap-2">
                        Bukti Transfer / Serah Terima
                        @if (!$donation->proof_photo)
                            <span class="bg-red-100 text-red-600 text-[10px] px-2 py-0.5 rounded-full">Belum
                                Upload</span>
                        @endif
                    </h3>

                    <div
                        class="w-full aspect-square max-w-[300px] rounded-2xl overflow-hidden shadow-md border border-gray-200 group relative bg-gray-50">
                        @if ($donation->proof_photo)
                            @php
                                // LOGIKA PEMBERSIH PATH:
                                // Menghapus kata 'public/' jika tidak sengaja tersimpan di database
                                // Mengubah: "public/proofs/foto.jpg" -> Menjadi: "proofs/foto.jpg"
                                $cleanProofPath = str_replace('public/', '', $donation->proof_photo);
                            @endphp

                            {{-- Tampilkan Gambar --}}
                            <img src="{{ asset('storage/' . $cleanProofPath) }}" alt="Bukti Donasi"
                                class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">

                            {{-- Tombol Lihat Full (Overlay) --}}
                            <a href="{{ asset('storage/' . $cleanProofPath) }}" target="_blank"
                                class="absolute inset-0 bg-black/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="bg-white/90 text-gray-800 text-xs font-bold px-3 py-1 rounded-full shadow">
                                    Lihat Bukti
                                </span>
                            </a>
                        @else
                            {{-- Placeholder (Jika Kosong) --}}
                            <div
                                class="w-full h-full bg-gray-100 flex items-center justify-center text-gray-400 flex-col gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 mb-2 text-gray-300"
                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <p class="text-sm font-medium">Belum ada bukti.</p>
                                <p class="text-xs mt-1 text-gray-400">User belum upload.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            {{-- FORM DETAIL (READONLY) --}}
            <div class="space-y-6">

                <h2 class="text-lg font-bold text-gray-800 mb-4 border-l-4 border-emerald-500 pl-3">Data Donatur</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NAMA DONATUR --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nama Donatur</label>
                        <input type="text" value="{{ $donation->donor_name }}"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 text-sm font-medium"
                            readonly>
                    </div>

                    {{-- NOMOR TELEPON --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Nomor Telepon</label>
                        <input type="text" value="{{ $donation->phone }}"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 text-sm font-medium"
                            readonly>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Alamat Lengkap</label>
                        <textarea rows="2" readonly
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 text-sm font-medium resize-none">{{ $donation->address }}</textarea>
                    </div>
                </div>

                <h2 class="text-lg font-bold text-gray-800 mt-8 mb-4 border-l-4 border-blue-500 pl-3">Detail Item</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- JENIS BARANG --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Jenis Barang</label>
                        <input type="text" value="{{ $donation->item_type }}"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 text-sm font-medium"
                            readonly>
                    </div>

                    {{-- JENIS PENGANTARAN --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Metode Pengantaran</label>
                        <input type="text"
                            value="{{ $donation->delivery_type === 'jemput' ? 'Jemput Bola (Pick Up)' : 'Diantar Sendiri (Drop Off)' }}"
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 text-sm font-medium"
                            readonly>
                    </div>

                    {{-- DESKRIPSI BARANG --}}
                    <div class="md:col-span-2">
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Deskripsi Barang</label>
                        <textarea rows="3" readonly
                            class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 text-sm font-medium resize-none">{{ $donation->item_description }}</textarea>
                    </div>

                    {{-- STATUS DONASI --}}
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Status Saat Ini</label>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700 border-yellow-200',
                                'diproses' => 'bg-blue-100 text-blue-700 border-blue-200',
                                'selesai' => 'bg-green-100 text-green-700 border-green-200',
                                'dibatalkan' => 'bg-red-100 text-red-700 border-red-200',
                            ];
                            $colorClass = $statusColors[$donation->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <div class="w-full rounded-xl border px-4 py-3 text-sm font-bold {{ $colorClass }}">
                            {{ ucfirst($donation->status) }}
                        </div>
                    </div>

                    {{-- LOKASI TITIK DONASI --}}
                    @if ($donation->donation_location_id)
                        <div>
                            <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Titik Donasi
                                Tujuan</label>
                            <input type="text"
                                value="{{ optional($donation->location)->name ?? 'Lokasi ID: ' . $donation->donation_location_id }}"
                                class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-gray-800 text-sm font-medium"
                                readonly>
                        </div>
                    @endif

                </div>

                {{-- Action Buttons --}}
                <div class="flex justify-between pt-8 border-t border-gray-100 mt-6">
                    <a href="{{ route('admin.donasi') }}"
                        class="px-6 py-2.5 rounded-xl border border-gray-300 text-gray-600 text-sm font-bold hover:bg-gray-50 transition flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <line x1="19" y1="12" x2="5" y2="12"></line>
                            <polyline points="12 19 5 12 12 5"></polyline>
                        </svg>
                        Kembali
                    </a>

                    {{-- Jika ada bukti tapi status masih pending/diproses, tampilkan tombol Verifikasi Cepat (Opsional) --}}
                    @if ($donation->proof_photo && $donation->status != 'selesai')
                        <form action="{{ route('admin.donasi.update-status', $donation->id) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit" onclick="return confirm('Apakah bukti valid dan donasi selesai?')"
                                class="px-6 py-2.5 rounded-xl bg-green text-white text-sm font-bold hover:bg-green/90 transition shadow-lg shadow-green/30 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                                </svg>
                                Verifikasi & Selesai
                            </button>
                        </form>
                    @endif
                </div>

            </div>
        </div>

    </div>
</x-admin-layout>
