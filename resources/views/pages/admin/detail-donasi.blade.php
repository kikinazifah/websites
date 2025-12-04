<x-admin-layout>
    <div class="min-h-screen bg-[#FBF8F5] p-8">

        <h1 class="text-3xl font-bold text-gray-900 mb-8">Detail Barang Donasi</h1>

        <div class="bg-white border border-gray-200 rounded-2xl shadow-sm max-w-4xl mx-auto p-8">

            <h2 class="text-lg font-semibold text-center text-gray-900 mb-8">
                Informasi Donasi
            </h2>

            @php
                $firstPhoto = is_array($donation->photos) ? $donation->photos[0] ?? null : null;
            @endphp

            {{-- wrapper untuk menengahkkan gambar --}}
            <div class="flex justify-center mb-8">
                <div class="w-60 h-60 rounded-2xl overflow-hidden shadow">
                    @if ($firstPhoto)
                        <img src="{{ asset('storage/' . $firstPhoto) }}" alt="Foto Barang Donasi"
                            class="w-full h-full object-cover">
                    @else
                        <img src="{{ asset('images/bg.png') }}" alt="Foto Barang Donasi"
                            class="w-full h-full object-cover">
                    @endif
                </div>
            </div>


            {{-- DETAIL (READONLY) --}}
            <div class="space-y-6">

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- NAMA DONATUR --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Nama Donatur</label>
                        <input type="text" value="{{ $donation->donor_name }}"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm"
                            readonly>
                    </div>

                    {{-- NOMOR TELEPON --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Nomor Telepon</label>
                        <input type="text" value="{{ $donation->phone }}"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm"
                            readonly>
                    </div>

                    {{-- ALAMAT --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Alamat Lengkap</label>
                        <textarea rows="2" readonly
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm resize-none">{{ $donation->address }}</textarea>
                    </div>

                    {{-- JENIS BARANG --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Jenis Barang</label>
                        <input type="text" value="{{ $donation->item_type }}"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm"
                            readonly>
                    </div>

                    {{-- JENIS PENGANTARAN --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Jenis Pengantaran</label>
                        <input type="text"
                            value="{{ $donation->delivery_type === 'jemput' ? 'Jemput Donasi' : 'Antar Donasi' }}"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm"
                            readonly>
                    </div>

                    {{-- DESKRIPSI BARANG --}}
                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Deskripsi Barang</label>
                        <textarea rows="3" readonly
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm resize-none">{{ $donation->item_description }}</textarea>
                    </div>

                    {{-- STATUS DONASI --}}
                    <div>
                        <label class="block text-sm font-semibold text-emerald-800 mb-2">Status</label>
                        @php
                            $statusLabels = [
                                'pending' => 'Pending',
                                'diproses' => 'Diproses',
                                'selesai' => 'Selesai',
                                'dibatalkan' => 'Dibatalkan',
                            ];
                        @endphp
                        <input type="text"
                            value="{{ $statusLabels[$donation->status] ?? ucfirst($donation->status) }}"
                            class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm"
                            readonly>
                    </div>

                    {{-- LOKASI TITIK DONASI (OPSIONAL) --}}
                    @if ($donation->donation_location_id)
                        <div class="md:col-span-2">
                            <label class="block text-sm font-semibold text-emerald-800 mb-2">Titik Donasi Tujuan</label>
                            <input type="text"
                                value="{{ optional($donation->location)->name ?? 'ID: ' . $donation->donation_location_id }}"
                                class="w-full rounded-xl border border-gray-200 bg-[#F7F1E9] px-4 py-2.5 text-gray-800 text-sm"
                                readonly>
                        </div>
                    @endif

                </div>

                <div class="flex justify-end pt-4">
                    <a href="{{ route('admin.donasi') }}"
                        class="px-6 py-2.5 rounded-xl bg-gray-200 text-gray-700 text-sm font-medium hover:bg-gray-300 transition">
                        Kembali
                    </a>
                </div>

            </div>
        </div>

    </div>
</x-admin-layout>
